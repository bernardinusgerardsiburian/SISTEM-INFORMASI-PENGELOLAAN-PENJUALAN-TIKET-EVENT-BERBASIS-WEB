<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function detailTransaksi(int $id){
        $details = $this
            ->select('transaksi_detail.*,tiket_event.*')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->where('transaksi.id',$id)
            ->findAll();

        $results = $this->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->where('transaksi.id',$id)->first();

        $results['details'] = $details;

        return $results;
    }

    function detailTransaksiByKode(string $kode){
        $details = $this
            ->select('transaksi_detail.*,tiket_event.*')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->where('transaksi.kode',$kode)
            ->findAll();

        $results = $this->select('*,pembayaran.status as status_pembayaran,pembayaran.id as pembayaran_id')
            ->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->join('pembayaran','pembayaran.transaksi_id=transaksi.id','left')
            ->join('metode_pembayaran','pembayaran.metode_pembayaran_id=metode_pembayaran.id','left')
            ->where('transaksi.kode',$kode)->first();

        $event = $this->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->join('event','event.id=tiket_event.event_id')
            ->where('transaksi.id',$results['transaksi_id'])
            ->first();

        $refund = $this->select('transaksi_refund.*')
            ->join('transaksi_refund','transaksi_refund.transaksi_id=transaksi.id')
            ->where('transaksi.id',$results['transaksi_id'])
            ->first();

        $results['event'] = $event;
        $results['details'] = $details;
        $results['refund'] = $refund;

        return $results;
    }

    function getListTransaksi()
    {
        $this->select('transaksi.*,event.nama as nama_event,pembeli.nama,SUM(transaksi_detail.sub_total) as total')
            ->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->join('transaksi_detail','transaksi.id=transaksi_detail.transaksi_id')
            ->join('tiket_event','transaksi_detail.tiket_event_id=tiket_event.id')
            ->join('event','event.id=tiket_event.event_id')
            ->groupBy('transaksi.id');

        return $this;
    }

    function getListEventTransaksi()
    {
        $this->select('event.*,kategori_event.nama AS nama_kategori,SUM(transaksi_detail.sub_total) AS total_penjualan')
            ->join('transaksi_detail','transaksi.id=transaksi_detail.transaksi_id')
            ->join('tiket_event','transaksi_detail.tiket_event_id=tiket_event.id')
            ->join('event','event.id=tiket_event.event_id')
            ->join('kategori_event','event.kategori_event_id=kategori_event.id')
            ->groupBy('event.id');

        return $this;
    }

    function getChartByJenisKelaminPembeli(){
        $p = $this->select('transaksi.*')->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->where('pembeli.jenis_kelamin','P')->where('transaksi.status','paid')
            ->groupBy('transaksi.id')->countAllResults();
        $l = $this->select('transaksi.*')->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->where('pembeli.jenis_kelamin','L')->where('transaksi.status','paid')
            ->groupBy('transaksi.id')->countAllResults();

        return [
            'labels'=>['Laki - laki','Perempuan'],
            'data'=>[$l,$p]
        ];
    }

    function getChartJumlahTransaksi(int $tahun){
        $res = $this->select('MONTH(transaksi.waktu) as bulan,SUM(transaksi_detail.quantity) as jumlah_transaksi')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->where('transaksi.status','paid')->where('YEAR(transaksi.waktu)',$tahun)
            ->groupBy('MONTH(transaksi.waktu)')->findAll();

        $return = [
            'labels'=>['',],
            'series'=>[0,]
        ];

        foreach($res as $row){
            $return['labels'] []= bulan_indo($row['bulan']);
            $return['series'] []= $row['jumlah_transaksi'];
        }

        return $return;
    }

    function getChartTransaksiEvent(){
        $res = $this->select('event.nama,SUM(transaksi_detail.sub_total) AS penjualan')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id','left')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id','left')
            ->join('event','event.id=tiket_event.event_id','left')
            ->groupBy('event.id')
            ->where('transaksi.status','paid')
            ->findAll();

        $return = [
            'labels'=>[],
            'series'=>[]
        ];

        $penjualan = [];
        $tiket = [];

        foreach($res as $row){
            $return['labels'] []= $row['nama'];
            $return['series'] []= (int)$row['penjualan'];
        }

        return $return;
    }
}

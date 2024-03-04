<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori_event';
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

    function getJumlahEventPerKategori(){
        return $this->select('kategori_event.*,COUNT(DISTINCT event.id) as jumlah_event,SUM(transaksi_detail.quantity) as jumlah_tiket, SUM(transaksi_detail.sub_total) as jumlah_pendapatan')
            ->join('event','event.kategori_event_id=kategori_event.id')
            ->join('tiket_event','event.id=tiket_event.event_id')
            ->join('transaksi_detail','transaksi_detail.tiket_event_id=tiket_event.id')
            ->join('transaksi','transaksi.id=transaksi_detail.transaksi_id')
            ->groupBy('kategori_event.id');
    }
}

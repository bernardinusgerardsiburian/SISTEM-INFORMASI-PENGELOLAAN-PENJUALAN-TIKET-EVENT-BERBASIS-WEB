<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\pdf;
use App\Models\Feedback;
use App\Models\Kategori;
use App\Models\Transaksi;

class LaporanController extends BaseController
{
    protected $model;
    protected $transaksi;
    protected $endpoint;
    protected $pdf;
    protected $kategori;
    protected $feedback;

    function __construct()
    {
        $this->transaksi = new Transaksi();
        $this->kategori = new Kategori();
        $this->feedback = new Feedback();
        $this->pdf = new pdf();
        $this->endpoint = base_url('laporan');

    }

    public function transaksi()
    {
        $data['title'] = 'Laporan Transaksi';
        $data['content'] = 'laporan/transaksi/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->getListTransaksi()->where(['transaksi.waktu>='=>$data['daritanggal'],'transaksi.waktu<='=>$data['sampaitanggal']])->findAll();
        }


        return view('layout/index',$data);
    }

    public function transaksiCetak()
    {
        $data['title'] = 'Laporan Transaksi';
        $data['content'] = 'laporan/transaksi/cetak';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->getListTransaksi()->where(['transaksi.waktu>='=>$data['daritanggal'],'transaksi.waktu<='=>$data['sampaitanggal']])->findAll();
        }

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function event()
    {
        $data['title'] = 'Laporan Event';
        $data['content'] = 'laporan/event/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->getListEventTransaksi()
                ->where(['transaksi.status'=>'paid'])
                ->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        return view('layout/index',$data);
    }

    public function eventCetak()
    {
        $data['title'] = 'Laporan Event';
        $data['content'] = 'laporan/event/cetak';
        $id = $this->request->getGet('id');
        $data['event'] = $this->transaksi->getListEventTransaksi()
            ->where(['transaksi.status'=>'paid'])
            ->where(['event.id'=>$id])->first();
        $data['transaksi'] = $this->transaksi->select('pembeli.*,SUM(transaksi_detail.sub_total) as total_pembelian,SUM(transaksi_detail.quantity) as total_tiket,transaksi.waktu')
            ->join('pembeli','pembeli.id=transaksi.pembeli_id')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->where('transaksi.status','paid')
            ->where('tiket_event.event_id',$id)
            ->groupBy(['transaksi.id','pembeli.id'])->findAll();
        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function kategori()
    {
        $data['title'] = 'Laporan Kategori';
        $data['content'] = 'laporan/kategori/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['kategori'] = $this->kategori->getJumlahEventPerKategori()->where('transaksi.status','paid')->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        return view('layout/index',$data);
    }

    public function kategoriCetak()
    {
        $data['title'] = 'Laporan Kategori';
        $data['content'] = 'laporan/kategori/cetak';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['kategori'] = $this->kategori->getJumlahEventPerKategori()->where('transaksi.status','paid')->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function Feedback()
    {
        $data['title'] = 'Laporan Feedback';
        $data['content'] = 'laporan/feedback/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['feedback'] = $this->feedback->getResumeEventFeedback()->where('transaksi.status','paid')->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        return view('layout/index',$data);
    }

    public function FeedbackCetak()
    {
        $data['title'] = 'Laporan Feedback';
        $data['content'] = 'laporan/feedback/cetak';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['feedback'] = $this->feedback->getResumeEventFeedback()->where('transaksi.status','paid')->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function TiketEvent()
    {
        $data['title'] = 'Laporan Tiket Event';
        $data['content'] = 'laporan/tiket_event/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->select('pembeli.nama,pembeli.email,transaksi.*,event.nama as nama_event,SUM(transaksi_detail.sub_total) as total_pembelian,SUM(transaksi_detail.quantity) as total_tiket,transaksi.waktu')
                ->join('pembeli','pembeli.id=transaksi.pembeli_id')
                ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
                ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
                ->join('event','event.id=tiket_event.event_id')
                ->where('transaksi.status','paid')->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])
                ->groupBy(['transaksi.id','pembeli.id'])->findAll();
        }

        return view('layout/index',$data);
    }

    public function TiketEventCetak()
    {
        $data['title'] = 'Laporan Tiket Event';
        $data['content'] = 'laporan/tiket_event/cetak';
        $transaksi_code = $this->request->getGet('kode');
        $data['transaksi'] = $this->transaksi->detailTransaksiByKode($transaksi_code);

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function TransaksiBulanan()
    {
        $data['title'] = 'Laporan Transaksi Bulanan';
        $data['content'] = 'laporan/transaksi_bulanan/index';
        $data['tahun'] = $this->request->getGet('tahun');
        if($data['tahun']){
            $data['transaksi'] = $this->transaksi->select('MONTH(transaksi.waktu) as bulan,SUM(transaksi_detail.sub_total) as total_pendapatan,COUNT(DISTINCT event.id) as total_event')
                ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
                ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
                ->join('event','event.id=tiket_event.event_id')
                ->where('transaksi.status','paid')->where(['YEAR(transaksi.waktu)'=>$data['tahun']])
                ->groupBy('MONTH(transaksi.waktu)')->findAll();
        }

        return view('layout/index',$data);
    }

    public function TransaksiBulananCetak()
    {
        $data['title'] = 'Laporan Transaksi_bulanan';
        $data['content'] = 'laporan/transaksi_bulanan/cetak';
        $data['tahun'] = $this->request->getGet('tahun');
        $data['transaksi'] = $this->transaksi->select('MONTH(transaksi.waktu) as bulan,SUM(transaksi_detail.sub_total) as total_pendapatan,COUNT(DISTINCT event.id) as total_event')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->join('event','event.id=tiket_event.event_id')
            ->where('transaksi.status','paid')->where(['YEAR(transaksi.waktu)'=>$data['tahun']])
            ->groupBy('MONTH(transaksi.waktu)')->findAll();

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function EventBulanan()
    {
        $data['title'] = 'Laporan Event Bulanan';
        $data['content'] = 'laporan/event_bulanan/index';
        $data['tahun'] = $this->request->getGet('tahun');
        if($data['tahun']){
            $data['transaksi'] = $this->transaksi->select('MONTH(transaksi.waktu) as bulan,SUM(transaksi_detail.quantity) as total_tiket,COUNT(DISTINCT event.id) as total_event')
                ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
                ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
                ->join('event','event.id=tiket_event.event_id')
                ->where('transaksi.status','paid')->where(['YEAR(transaksi.waktu)'=>$data['tahun']])
                ->groupBy('MONTH(transaksi.waktu)')->findAll();
        }

        return view('layout/index',$data);
    }

    public function EventBulananCetak()
    {
        $data['title'] = 'Laporan Event Bulanan';
        $data['content'] = 'laporan/event_bulanan/cetak';
        $data['tahun'] = $this->request->getGet('tahun');
        $data['transaksi'] = $this->transaksi->select('MONTH(transaksi.waktu) as bulan,SUM(transaksi_detail.quantity) as total_tiket,COUNT(DISTINCT event.id) as total_event')
            ->join('transaksi_detail','transaksi_detail.transaksi_id=transaksi.id')
            ->join('tiket_event','tiket_event.id=transaksi_detail.tiket_event_id')
            ->join('event','event.id=tiket_event.event_id')
            ->where('transaksi.status','paid')->where(['YEAR(transaksi.waktu)'=>$data['tahun']])
            ->groupBy('MONTH(transaksi.waktu)')->findAll();

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function rangkumanEvent()
    {
        $data['title'] = 'Laporan Rangkuman Event';
        $data['content'] = 'laporan/rangkuman_event/index';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->getListEventTransaksi()
                ->where(['transaksi.status'=>'paid'])
                ->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        return view('layout/index',$data);
    }


    public function rangkumanEventCetak()
    {
        $data['title'] = 'Laporan Rangkuman Event';
        $data['content'] = 'laporan/rangkuman_event/cetak';
        $data['daritanggal'] = $this->request->getGet('daritanggal');
        $data['sampaitanggal'] = ($this->request->getGet('sampaitanggal') ? $this->request->getGet('sampaitanggal'):false);
        if($data['sampaitanggal']){
            $data['transaksi'] = $this->transaksi->getListEventTransaksi()
                ->where(['transaksi.status'=>'paid'])
                ->where(['event.tanggal>='=>$data['daritanggal'],'event.tanggal<='=>$data['sampaitanggal']])->findAll();
        }

        $html = view('layout/paper',$data);
        $this->pdf->generate($html,'laporan.pdf','A4','landscape');
    }

    public function grafik()
    {
        $data['title'] = 'Laporan Grafik Penjualan';
        $data['content'] = 'laporan/grafik/index';


        return view('layout/index',$data);
    }
}

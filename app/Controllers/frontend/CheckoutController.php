<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Kategori;
use App\Models\MetodePembayaran;
use App\Models\Pembayaran;
use App\Models\Pembeli;
use App\Models\Ticket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use CodeIgniter\I18n\Time;

class CheckoutController extends BaseController
{
    private Event $event;
    private Ticket $tiket;

    public function __construct()
    {
        $this->event = new Event();
        $this->tiket = new Ticket();
        $this->metode_pembayaran = new MetodePembayaran();
        $this->pembeli = new Pembeli();
        $this->transaksi = new Transaksi();
        $this->detail = new TransaksiDetail();
        $this->pembayaran = new Pembayaran();
    }

    public function index()
    {
        $data['title'] = 'Event';
        $data['content'] = 'frontend/transaksi/checkout';
        $chart = $this->request->getGet('chart');
        $datachart = session()->get($chart);
        $data['event'] = $this->event->find($datachart['event_id']);
        $where = [];
        foreach($datachart['tiket'] as $row){
            $where []= $row['tiket_event_id'];
        }
        $data['tiket'] = $this->tiket->whereIn('id',$where)->findAll();
        foreach($data['tiket'] as $i => $t){
            $quantity = 0;
            $sub_total = 0;
            foreach($datachart['tiket'] as $row){
                if($t['id']==$row['tiket_event_id']){
                    $quantity = $row['quantity'];
                    $sub_total = $row['sub_total'];
                }
            }
            $data['tiket'][$i]['quantity'] = $quantity;
            $data['tiket'][$i]['sub_total'] = $sub_total;
        }
        $data['chart'] = $chart;
        $data['metode_pembayaran'] = $this->metode_pembayaran->findAll();
        return view('frontend/layout/index',$data);
    }

    public function addChart(){
        $quantity = $this->request->getPost('quantity[]');
        $tiket = $this->request->getPost('tiket[]');
        $chart = [
            'event_id'=>$this->request->getPost('event_id'),
            'tiket'=>[],
        ];
        foreach($quantity as $i => $v){
            if($v>=1){
                $datatiket = $this->tiket->where(['id'=>$tiket[$i]])->first();
                $chart['tiket'] []= ['quantity'=>$v,'tiket_event_id'=>$tiket[$i],'sub_total'=>$datatiket['harga']*$v];
            }
        }
        $chartName = random_string('alnum',8);
        $session = session();
        $session->set($chartName,$chart);
        return redirect()->to('checkout'.'?chart='.$chartName);
    }

    public function store(){
        $arrPembeli = [
            'nama'=>$this->request->getPost('nama'),
            'no_hp'=>$this->request->getPost('no_hp'),
            'email'=>$this->request->getPost('email'),
            'jenis_kelamin'=>$this->request->getPost('jenis_kelamin'),
            'tanggal_lahir'=>$this->request->getPost('tanggal_lahir'),
        ];
        $this->db->transBegin();
            $this->pembeli->insert($arrPembeli);
            $pembeli_id = $this->pembeli->getInsertID();
            $kode = random_string('alnum',8);
            $arrTransaksi = [
                'pembeli_id'=>$pembeli_id,
                'kode'=>$kode,
                'waktu'=>Time::now(),
                'status'=>'wait_for_payment',
            ];
            $this->transaksi->insert($arrTransaksi);
            $transaksi_id = $this->transaksi->getInsertID();
            $chart = $this->request->getPost('chart');
            $arrDetail = session()->get($chart);
            $detail = [];
            foreach($arrDetail['tiket'] as $i => $row){
                $arrDetail['tiket'][$i]['transaksi_id'] = $transaksi_id;
                $row = $arrDetail['tiket'][$i];
                $detail []= $row;
            }
            $this->detail->insertBatch($detail);
            $this->pembayaran->insert([
                'transaksi_id'=>$transaksi_id,
                'status'=>'wait_for_payment',
                'metode_pembayaran_id'=>$this->request->getPost('metode_pembayaran_id'),
            ]);

        if($this->db->transStatus() === false){
            $this->db->transRollback();
            return redirect()->to('checkout'.'?chart='.$chart);
        }else{
            $this->db->transCommit();
            session()->remove($chart);
            return redirect()->to('transaksi'.'?kode='.$kode);
        }
    }
}

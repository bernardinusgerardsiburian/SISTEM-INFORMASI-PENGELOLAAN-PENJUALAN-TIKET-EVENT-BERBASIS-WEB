<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\MetodePembayaran;
use App\Models\Pembayaran;
use App\Models\Pembeli;
use App\Models\Ticket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiRefund;
use CodeIgniter\I18n\Time;

class TransaksiController extends BaseController
{
    public function __construct()
    {
        $this->event = new Event();
        $this->tiket = new Ticket();
        $this->metode_pembayaran = new MetodePembayaran();
        $this->pembeli = new Pembeli();
        $this->transaksi = new Transaksi();
        $this->detail = new TransaksiDetail();
        $this->pembayaran = new Pembayaran();
        $this->feedback = new Feedback();
        $this->refund = new TransaksiRefund();
        $this->endpoint = base_url('transaksi');
    }

    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['content'] = 'frontend/transaksi/index';
        $transaksi_code = $this->request->getGet('kode');
        $data['transaksi'] = $this->transaksi->detailTransaksiByKode($transaksi_code);
        $data['feedback'] = ($data['transaksi']['status']=='paid' ? $this->feedback->where('transaksi_id',$data['transaksi']['transaksi_id'])->first():null);

        return view('frontend/layout/index',$data);
    }

    public function storeFeedback()
    {
        $post = $this->request->getPost();
        $transaksi = $this->transaksi->where(['id'=>$this->request->getPost('transaksi_id')])->first();
        if($this->feedback->insert($post)){
            return $this->sendNotifikasi('success','Berhasil Menambahkan Feedback',$this->endpoint.'?kode='.$transaksi['kode']);
        }
        return $this->sendNotifikasi('danger','Gagal Menambahkan Feedback',$this->endpoint.'?kode='.$transaksi['kode']);
    }

    public function storePembayaran()
    {
        $post = $this->request->getPost();
        if($img = $this->request->getFile('image')){
            $rules = [
                'file' => [
                    'rules' => 'mime_in[image,image/jpeg,image/png,image/svg+xml]|max_size[image,5120]',
                    'errors' => [
                        'mime_in' => 'File yang dipilih bukan gambar',
                        'max_size' => 'Size Melebihi maksimum 5120 KB (5 MB)'
                    ]
                ]
            ];
            if (!$this->validation->setRules($rules)->run()) {
                return $this->sendNotifikasi('danger',json_encode($this->validation->getErrors()),$this->endpoint);
            }
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();

                $filepath = ROOTPATH . 'public/uploads/images/';
                $path = 'public/uploads/images/'.$newName;
                $img->move($filepath,$newName);
                $post['bukti_pembayaran'] = $path;
            }
        }
        $post['status'] = 'wait_for_confirmation';
        $post['waktu_pembayaran'] = Time::now();

        unset($post['image']);
        unset($post['transaksi_id']);
        unset($post['pembayaran_id']);
        $transaksi = $this->transaksi->where(['id'=>$this->request->getPost('transaksi_id')])->first();
        if($this->pembayaran->update($this->request->getPost('pembayaran_id'),$post)){
            $this->transaksi->update($this->request->getPost('transaksi_id'),['status'=>'wait_for_confirmation']);
            return $this->sendNotifikasi('success','Berhasil Menambahkan Data',$this->endpoint.'?kode='.$transaksi['kode']);
        }
        return $this->sendNotifikasi('danger','Gagal Menambahkan Data',$this->endpoint.'?kode='.$transaksi['kode']);
    }

    public function refund()
    {
        $post = $this->request->getPost();
        $transaksi = $this->transaksi->where(['id'=>$this->request->getPost('transaksi_id')])->first();
        $pembayaran = $this->pembayaran->where(['transaksi_id'=>$this->request->getPost('transaksi_id')])->first();
        $post['status'] = 'req_refund';
        if($this->refund->insert($post)){
            $this->transaksi->update($this->request->getPost('transaksi_id'),['status'=>'req_refund']);
            $this->pembayaran->update($pembayaran['id'],['status'=>'req_refund']);
            return $this->sendNotifikasi('success','Berhasil Menambahkan Feedback',$this->endpoint.'?kode='.$transaksi['kode']);
        }
        return $this->sendNotifikasi('danger','Gagal Menambahkan Feedback',$this->endpoint.'?kode='.$transaksi['kode']);
    }
}

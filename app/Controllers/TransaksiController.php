<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pembayaran;
use App\Models\Pembeli;
use App\Models\Ticket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiRefund;

class TransaksiController extends BaseController
{
    protected $model;
    protected $pembayaran;
    protected $endpoint;
    protected $pembeli;
    protected $tiketevent;
    protected $detailTransaksi;
    protected $refund;

    function __construct()
    {
        $this->model = new Transaksi();
        $this->endpoint = base_url('admin/transaksi');
        $this->pembayaran = new Pembayaran();
        $this->detailTransaksi = new TransaksiDetail();
        $this->pembeli = new Pembeli();
        $this->tiketevent = new Ticket();
        $this->refund = new TransaksiRefund();
    }

    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['content'] = 'transaksi/index';
        if(session()->get('role') == 'admin') {
            $data['transaksi'] = $this->model->getListTransaksi()->findAll();
        }else{
            $data['transaksi'] = $this->model->getListTransaksi()
                ->where('event.petugas_id',session()->get('petugas_id'))
                ->findAll();
        }

        return view('layout/index',$data);
    }

    public function detail()
    {
        $data['title'] = 'Transaksi Detail';
        $data['content'] = 'transaksi/detail';

        $transaksi_code = $this->request->getGet('kode');
        $data['transaksi'] = $this->model->detailTransaksiByKode($transaksi_code);

        return view('layout/index',$data);
    }

    public function updateStatus(){
        $data = ['status'=>($this->request->getPost('status')=='Terima' ? 'paid':'cancel')];
        $transaksi_id = $this->request->getPost('transaksi_id');
        $pembayaran_id = $this->request->getPost('pembayaran_id');
        if($this->model->update($transaksi_id,$data)){
            $this->pembayaran->update($pembayaran_id,$data);
            if($data['status']==='paid'){
                $detail = $this->detailTransaksi->where('transaksi_id',$transaksi_id)->findAll();
                foreach($detail as $row){
                    $tiket = $this->tiketevent->where('id',$row['tiket_event_id'])->first();
                    $this->tiketevent->update($row['tiket_event_id'],['stok'=>(int)$tiket['stok']-$row['quantity']]);
                }
            }
            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint);
    }

    public function updateRefund(){
        $data = ['status'=>($this->request->getPost('status')=='Refund' ? 'refund':'paid')];
        $transaksi_id = $this->request->getPost('transaksi_id');
        $pembayaran_id = $this->request->getPost('pembayaran_id');
        if($this->model->update($transaksi_id,$data)){
            $refund = $this->refund->where('transaksi_id',$transaksi_id)->first();
            $this->refund->update($refund['id'],['status'=>($data['status']=='refund' ? 'refund':'reject')]);
            $this->pembayaran->update($pembayaran_id,$data);

                $detail = $this->detailTransaksi->where('transaksi_id',$transaksi_id)->findAll();
                foreach($detail as $row){
                    $tiket = $this->tiketevent->where('id',$row['tiket_event_id'])->first();
                    $this->tiketevent->update($row['tiket_event_id'],['stok'=>(int)$tiket['stok']+$row['quantity']]);
                }

            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint);
    }

    function delete(){
        $id = $this->request->getPost('id');
        $dataimg = $this->model
            ->join('pembayaran','pembayaran.transaksi_id=transaksi.id','left')
            ->where(['transaksi.id'=>$id])->first();
        if($this->model->where(['id'=>$id])->delete()){
            $this->pembeli->where(['id'=>$dataimg['pembeli_id']])->delete();
            @unlink(ROOTPATH.$dataimg['bukti_pembayaran']);
            return $this->sendNotifikasi('success','Berhasil Menghapus Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Menghapus Data',$this->endpoint);
    }
}

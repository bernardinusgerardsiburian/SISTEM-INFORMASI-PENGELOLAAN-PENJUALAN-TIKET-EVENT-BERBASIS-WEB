<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Kategori;
use App\Models\Petugas;

class EventController extends BaseController
{
    protected $model;
    protected $kategori;
    protected $petugas;
    protected $endpoint;

    function __construct()
    {
        $this->model = new Event();
        $this->kategori = new Kategori();
        $this->petugas = new Petugas();
        $this->endpoint = base_url('admin/event');
    }

    public function index()
    {
        $data['title'] = 'Event';
        $data['content'] = 'event/index';
        if(session()->get('role') == 'admin') {
            $data['event'] = $this->model->orderBy('tanggal')->findAll();
        }else{
            $data['event'] = $this->model
                ->where('petugas_id',session()->get('petugas_id'))
                ->orderBy('tanggal')->findAll();
        }

        return view('layout/index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create Event';
        $data['content'] = 'event/create';
        $data['kategori'] = $this->kategori->findAll();
        if(session()->get('role') == 'admin') {
            $data['petugas'] = $this->petugas->findAll();
        }else{
            $data['petugas'] = $this->petugas->where('id',session()->get('petugas_id'))->findAll();
        }

        return view('layout/index',$data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Event';
        $data['content'] = 'event/edit';
        $data['kategori'] = $this->kategori->findAll();
        if(session()->get('role') == 'admin') {
            $data['petugas'] = $this->petugas->findAll();
        }else{
            $data['petugas'] = $this->petugas->where('id',session()->get('petugas_id'))->findAll();
        }
        if(!$data['event'] = $this->model->where(['id'=>$this->request->getGet('id')])->first()){
            return ;
        }
        return view('layout/index',$data);
    }

    public function store()
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
                $post['gambar'] = $path;
            }
        }
        $post['status'] = 'Y';
        unset($post['image']);
        if($this->model->insert($post)){
            return $this->sendNotifikasi('success','Berhasil Menambahkan Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Menambahkan Data',$this->endpoint);
    }

    public function update()
    {
        $post = $this->request->getPost();
        $id = $post['id'];
        unset($post['id']);
        if($img = $this->request->getFile('image')){
            $dataimg = $this->model->where(['id'=>$id])->first();
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
                $post['gambar'] = $path;
                @unlink(ROOTPATH.$dataimg['gambar']);
            }
        }
        if($this->model->update($id,$post)){
            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint);
    }

    function delete(){
        $id = $this->request->getPost('id');
        $dataimg = $this->model->where(['id'=>$id])->first();
        if($this->model->where(['id'=>$id])->delete()){
            @unlink(ROOTPATH.$dataimg['gambar']);
            return $this->sendNotifikasi('success','Berhasil Menghapus Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Menghapus Data',$this->endpoint);
    }
}

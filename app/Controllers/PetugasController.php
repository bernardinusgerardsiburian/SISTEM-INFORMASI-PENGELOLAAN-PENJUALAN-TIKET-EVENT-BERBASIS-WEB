<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Petugas;

class PetugasController extends BaseController
{
    protected $model;
    protected $endpoint;

    function __construct()
    {
        $this->model = new Petugas();
        $this->endpoint = base_url('admin/petugas');
    }

    public function index()
    {
        $data['title'] = 'Petugas';
        $data['content'] = 'petugas/index';

        $data['petugas'] = $this->model->findAll();

        return view('layout/index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create Petugas';
        $data['content'] = 'petugas/create';

        return view('layout/index',$data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Petugas';
        $data['content'] = 'petugas/edit';
        if(!$data['petugas'] = $this->model->where(['id'=>$this->request->getGet('id')])->first()){
            return ;
        }
        return view('layout/index',$data);
    }

    public function store()
    {
        $post = $this->request->getPost();
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
        if($this->model->update($id,$post)){
            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint);
    }

    function delete(){
        $id = $this->request->getPost('id');
        if($data = $this->model->where(['id'=>$id])->delete()){
            return $this->sendNotifikasi('success','Berhasil Menghapus Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Menghapus Data',$this->endpoint);
    }
}

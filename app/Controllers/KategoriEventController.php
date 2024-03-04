<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kategori;

class KategoriEventController extends BaseController
{

    protected $model;
    protected $endpoint;

    function __construct()
    {
        $this->model = new Kategori();
        $this->endpoint = base_url('admin/kategori-event');
    }

    public function index()
    {
        $data['title'] = 'Kategori Event';
        $data['content'] = 'kategori/index';

        $data['kategori'] = $this->model->paginate(5);
        $data['pager'] = $this->model->pager;

        return view('layout/index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create Kategori Event';
        $data['content'] = 'kategori/create';

        return view('layout/index',$data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Kategori Event';
        $data['content'] = 'kategori/edit';
        if(!$data['kategori'] = $this->model->where(['id'=>$this->request->getGet('id')])->first()){
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

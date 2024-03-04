<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Petugas;
use App\Models\User;

class UsersController extends BaseController
{
    protected $model;
    protected $endpoint;
    protected $petugas;

    function __construct()
    {
        $this->model = new User();
        $this->petugas = new Petugas();
        $this->endpoint = base_url('admin/user');
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['content'] = 'user/index';

        $data['user'] = $this->model->withPetugas()->paginate(10);
        $data['pager'] = $this->model->pager;
        
        return view('layout/index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['content'] = 'user/create';
        $data['petugas'] = $this->petugas->findAll();
        return view('layout/index',$data);
    }

    public function edit()
    {
        $data['title'] = 'Edit User';
        $data['content'] = 'user/edit';
        $data['petugas'] = $this->petugas->findAll();
        if(!$data['user'] = $this->model->where(['user_id'=>$this->request->getGet('id')])->first()){
            return ;
        }
        return view('layout/index',$data);
    }

    public function store()
    {
        $post = $this->request->getPost();
        $post['password'] = password_hash($post['password'],PASSWORD_DEFAULT);
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
        if(isset($post['password']) && $post['password']!=''){
            $post['password'] = password_hash($post['password'],PASSWORD_DEFAULT);
        }else{
            unset($post['password']);
        }
        if($this->model->update($id,$post)){
            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint);
    }

    function delete(){
        $id = $this->request->getPost('id');
        if($data = $this->model->where(['user_id'=>$id])->delete()){
            return $this->sendNotifikasi('success','Berhasil Menghapus Data',$this->endpoint);
        }
        return $this->sendNotifikasi('danger','Gagal Menghapus Data',$this->endpoint);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Ticket;

class TiketEventController extends BaseController
{
    protected $model;
    protected $event;
    protected $endpoint;

    function __construct()
    {
        $this->model = new Ticket();
        $this->event = new Event();
        $this->endpoint = base_url('admin/tiket');
    }

    public function index(int $event_id)
    {
        $data['title'] = 'Tiket Event';
        $data['content'] = 'tiket-event/index';
        $data['event'] = $this->event->find($event_id);
        $data['tiket'] = $this->model->where(['event_id'=>$event_id])->findAll();

        return view('layout/index',$data);
    }

    public function create(int $event_id)
    {
        $data['title'] = 'Create Tiket Event';
        $data['content'] = 'tiket-event/create';
        $data['event_id'] = $event_id;

        return view('layout/index',$data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Tiket Event';
        $data['content'] = 'tiket-event/edit';
        if(!$data['tiket'] = $this->model->where(['id'=>$this->request->getGet('id')])->first()){
            return ;
        }

        return view('layout/index',$data);
    }

    public function store()
    {
        $post = $this->request->getPost();
        if($this->model->insert($post)){
            return $this->sendNotifikasi('success','Berhasil Menambahkan Data',$this->endpoint.'/'.$post['event_id']);
        }
        return $this->sendNotifikasi('danger','Gagal Menambahkan Data',$this->endpoint.'/'.$post['event_id']);
    }

    public function update()
    {
        $post = $this->request->getPost();
        $id = $post['id'];
        unset($post['id']);
        if($this->model->update($id,$post)){
            return $this->sendNotifikasi('success','Berhasil Mengubah Data',$this->endpoint.'/'.$post['event_id']);
        }
        return $this->sendNotifikasi('danger','Gagal Mengubah Data',$this->endpoint.'/'.$post['event_id']);
    }
}

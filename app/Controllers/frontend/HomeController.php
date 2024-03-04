<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Libraries\Mailer;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Kategori;
use App\Models\Ticket;

class HomeController extends BaseController
{
    private Kategori $kategori;

    public function __construct()
    {
        $this->kategori = new Kategori();
        $this->event = new Event();
        $this->tiket = new Ticket();
        $this->feedback = new Feedback();
        $this->mail = new Mailer();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['content'] = 'frontend/home/index';
        $data['kategori'] = $this->kategori->findAll();
        $data['kategori_event'] = null;
        $data['cari_event'] = null;
        if($this->request->getGet('kategori')){
            $data['event'] = $this->event->where('kategori_event_id',$this->request->getGet('kategori'))->orderBy('tanggal')->findAll();
            $data['kategori_event'] = $this->kategori->where('id',$this->request->getGet('kategori'))->first();
        }else if($this->request->getGet('judul')){
            $data['cari_event'] = $this->request->getGet('judul');
            $data['event'] = $this->event->like('nama',$this->request->getGet('judul'))->orderBy('tanggal')->findAll();
        }else{
            $data['event'] = $this->event->orderBy('tanggal')->findAll();
        }



        $feedback = $this->feedback->getFeedback()->findAll(10);
        $feedback = array_chunk($feedback,6);
        $data['feedback'] = array_values($feedback);
        return view('frontend/layout/index',$data);
    }


    public function event(int $id)
    {
        $data['title'] = 'Event';
        $data['content'] = 'frontend/event/index';
        $data['event'] = $this->event->find($id);
        $data['tiket'] = $this->tiket->where(['event_id'=>$id])->findAll();
        return view('frontend/layout/index',$data);
    }

    public function mail(){
        $message = "<b>Coba saja</b><a href='#'>Link</a><p>judul</p>";
        $coba = $this->mail->sendMail('coba',$message,'ahmadsuryani11@gmail.com');
        return 'ok';
    }
}

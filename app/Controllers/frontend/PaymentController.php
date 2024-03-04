<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Transaksi;

class PaymentController extends BaseController
{

    public function __construct()
    {
        $this->transaksi = new Transaksi();
    }

    public function index(int $id)
    {
        $data['title'] = 'Payment';
        $data['content'] = 'frontend/transaksi/payment';
        $data['transaksi'] = $this->transaksi->detailTransaksi($id);
        return view('frontend/layout/index',$data);
    }
}

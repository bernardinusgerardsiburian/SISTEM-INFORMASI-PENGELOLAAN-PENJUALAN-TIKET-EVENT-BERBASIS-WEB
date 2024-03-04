<?php

namespace App\Controllers;

use App\Models\Transaksi;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new Transaksi();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'index';

        return view('layout/index',$data);
    }

    public function getDataChartPembeliByJenisKelamin()
    {
        return json_encode($this->transaksi->getChartByJenisKelaminPembeli());
    }

    public function getChartJumlahTransaksi(){
        return json_encode($this->transaksi->getChartJumlahTransaksi($this->request->getGet('tahun')));
    }

    public function getChartTransaksiEvent(){
        return json_encode($this->transaksi->getChartTransaksiEvent());
    }
}

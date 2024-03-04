<?php

namespace Config;


$routes = Services::routes();


if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();


$routes->get('/', 'frontend\HomeController::index');
$routes->get('mail', 'frontend\HomeController::mail');
$routes->get('event/(:num)', 'frontend\HomeController::event/$1');

$routes->get('payment/(:num)', 'frontend\PaymentController::index/$1');

$routes->get('kwitansi', 'LaporanController::kwitansi');
$routes->get('login', 'AuthController::index',['namespace'=>'App\Controllers']);
$routes->get('logout', 'AuthController::logout',['namespace'=>'App\Controllers']);
$routes->post('validateLogin', 'AuthController::validateLogin',['namespace'=>'App\Controllers']);
$routes->get('wa', 'dashboardController::wa');

$routes->group('checkout',function($routes){
    $routes->get('', 'frontend\CheckoutController::index');
    $routes->post('chart', 'frontend\CheckoutController::addChart');
    $routes->post('store', 'frontend\CheckoutController::store');
});

$routes->group('transaksi',function($routes){
    $routes->get('', 'frontend\TransaksiController::index');
    $routes->post('storePembayaran', 'frontend\TransaksiController::storePembayaran');
    $routes->post('storeFeedback', 'frontend\TransaksiController::storeFeedback');
    $routes->post('refund', 'frontend\TransaksiController::refund');
});

$routes->group('admin',['filter' => 'auth'],function($routes){
    $routes->get('',function (){
        return redirect()->to('admin/dashboard');
    });

    $routes->get('dashboard', 'dashboardController::index');
    $routes->get('data-chart-pembeli-jenis-kelamin','dashboardController::getDataChartPembeliByJenisKelamin');
    $routes->get('data-chart-jumlah-transaksi','dashboardController::getChartJumlahTransaksi');
    $routes->get('data-chart-transaksi-event','dashboardController::getChartTransaksiEvent');

    $routes->group('transaksi',function($routes){
        $routes->get('/','TransaksiController::index');
        $routes->get('detail','TransaksiController::detail');

        $routes->post('updateStatus','TransaksiController::updateStatus');
        $routes->post('updateRefund','TransaksiController::updateRefund');
        $routes->post('delete','TransaksiController::delete');
    });

    $routes->group('kategori-event',function($routes){
        $routes->get('/','KategoriEventController::index');
        $routes->get('create','KategoriEventController::create');
        $routes->get('edit','KategoriEventController::edit');

        $routes->post('store','KategoriEventController::store');
        $routes->post('update','KategoriEventController::update');
        $routes->post('delete','KategoriEventController::delete');
    });

    $routes->group('petugas',function($routes){
        $routes->get('/','PetugasController::index');
        $routes->get('create','PetugasController::create');
        $routes->get('edit','PetugasController::edit');

        $routes->post('store','PetugasController::store');
        $routes->post('update','PetugasController::update');
        $routes->post('delete','PetugasController::delete');
    });

    $routes->group('metode-pembayaran',function($routes){
        $routes->get('/','MetodePembayaranController::index');
        $routes->get('create','MetodePembayaranController::create');
        $routes->get('edit','MetodePembayaranController::edit');

        $routes->post('store','MetodePembayaranController::store');
        $routes->post('update','MetodePembayaranController::update');
        $routes->post('delete','MetodePembayaranController::delete');
    });

    $routes->group('event',function($routes){
        $routes->get('/','EventController::index');
        $routes->get('create','EventController::create');
        $routes->get('edit','EventController::edit');

        $routes->post('store','EventController::store');
        $routes->post('update','EventController::update');
        $routes->post('delete','EventController::delete');
    });

    $routes->group('tiket',function($routes){
        $routes->get('(:num)','TiketEventController::index/$1');
        $routes->get('create/(:num)','TiketEventController::create/$1');
        $routes->get('edit','TiketEventController::edit');

        $routes->post('store','TiketEventController::store');
        $routes->post('update','TiketEventController::update');
        $routes->post('delete','TiketEventController::delete');
    });

    $routes->group('user',function($routes){
        $routes->get('/','UsersController::index');
        $routes->get('create','UsersController::create');
        $routes->get('edit','UsersController::edit');

        $routes->post('store','UsersController::store');
        $routes->post('update','UsersController::update');
        $routes->post('delete','UsersController::delete');
    });

    $routes->group('laporan',function($routes){
        $routes->get('transaksi','LaporanController::transaksi');
        $routes->get('transaksi-cetak','LaporanController::transaksiCetak');

        $routes->get('event','LaporanController::event');
        $routes->get('event-cetak','LaporanController::eventCetak');

        $routes->get('kategori','LaporanController::kategori');
        $routes->get('kategori-cetak','LaporanController::kategoriCetak');

        $routes->get('tiket-event','LaporanController::TiketEvent');
        $routes->get('tiket-event-cetak','LaporanController::TiketEventCetak');

        $routes->get('feedback','LaporanController::Feedback');
        $routes->get('feedback-cetak','LaporanController::FeedbackCetak');

        $routes->get('transaksi-bulanan','LaporanController::TransaksiBulanan');
        $routes->get('transaksi-bulanan-cetak','LaporanController::TransaksiBulananCetak');

        $routes->get('event-bulanan','LaporanController::EventBulanan');
        $routes->get('event-bulanan-cetak','LaporanController::EventBulananCetak');

        $routes->get('rangkuman-event','LaporanController::rangkumanEvent');
        $routes->get('rangkuman-event-cetak','LaporanController::rangkumanEventCetak');

        $routes->get('grafik','LaporanController::grafik');
    });
});




if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

<?php

function rupiah($angka){
	if(!$angka){
		return '0';
	}
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

function encryptData($data){
	$enc = \Config\Services::encrypter();
	return bin2hex($enc->encrypt($data));
}

function decryptData($data){
	$enc = \Config\Services::encrypter();
	return $enc->decrypt(hex2bin($data));
}

function getFileLink($path){
	if($path == '' || $path == null){
		return null;
	}
	$link = encryptData($path);
	$link = base_url('files').'/'.$link;
	return $link;
}

function tgl_waktu_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	$jam = explode(' ',$pecahkan[2]);
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $jam[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' '.$jam[1];
}

function tgl_indo($tanggal){
	if(!$tanggal || $tanggal=='0000-00-00'){
		return '';
	}
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function bulan_indo($bulan){
	if(!$bulan || $bulan<=0 || $bulan >= 13){
		return '';
	}
	$arrbulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	
	return $arrbulan[ (int)$bulan ];
}

?>
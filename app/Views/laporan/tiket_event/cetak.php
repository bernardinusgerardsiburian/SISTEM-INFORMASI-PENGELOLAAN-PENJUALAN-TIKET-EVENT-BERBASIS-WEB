<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Tiket Event</h3>
</div>
<b>Kode Transaksi : <?= $transaksi['kode']?></b>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Pembeli</b>
</div>
<table class='main' border='0' repeat_header="1" cellspacing="0" width="100%">
    <tr>
        <td style="width: 160px;">Nama</td>
        <td style="width: 3px;">:</td>
        <td><?= $transaksi['nama']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Email</td>
        <td style="width: 3px;">:</td>
        <td><?= $transaksi['email']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Jenis Kelamin</td>
        <td style="width: 3px;">:</td>
        <td><?= ($transaksi['jenis_kelamin']=='L' ? 'Laki-laki':'Perempuan')?></td>
    </tr>
</table>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Event</b>
</div>
<table class='main' border='0' repeat_header="1" cellspacing="0" width="100%">
    <tr>
        <td style="width: 160px;">Nama</td>
        <td style="width: 3px;">:</td>
        <td><?= $transaksi['event']['nama']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Tanggal</td>
        <td style="width: 3px;">:</td>
        <td><?= tgl_indo($transaksi['event']['tanggal'])?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Alamat</td>
        <td style="width: 3px;">:</td>
        <td><?= $transaksi['event']['alamat']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Waktu</td>
        <td style="width: 3px;">:</td>
        <td><?= $transaksi['event']['waktu_mulai'].' - '.$transaksi['event']['waktu_berakhir']?></td>
    </tr>
</table>
<p>Tiket Event :</p>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>
        <th>Tiket</th>
        <th>Harga</th>
        <th>Quantity</th>
        <th>Sub Total</th>
    </tr>
    <?php foreach($transaksi['details'] as $row):?>
        <tr>
            <td><?= $row['nama']?></td>
            <td><?= rupiah($row['harga'])?></td>
            <td><?= $row['quantity']?></td>
            <td><?= rupiah($row['sub_total'])?></td>
        </tr>
    <?php endforeach?>


</table>
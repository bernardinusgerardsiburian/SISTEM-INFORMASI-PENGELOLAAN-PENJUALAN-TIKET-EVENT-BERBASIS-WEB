<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Event</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Event</b>
</div>
<table class='main' border='0' repeat_header="1" cellspacing="0" width="100%">
    <tr>
        <td style="width: 160px;">Nama</td>
        <td style="width: 3px;">:</td>
        <td><?= $event['nama']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Kategori</td>
        <td style="width: 3px;">:</td>
        <td><?= $event['nama_kategori']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Tanggal Event</td>
        <td style="width: 3px;">:</td>
        <td><?= $event['tanggal']?></td>
    </tr>
    <tr>
        <td style="width: 160px;">Deskripsi</td>
        <td style="width: 3px;">:</td>
        <td><?= $event['deskripsi']?></td>
    </tr>
</table>

<p>Penjualan Tiket :</p>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>
        <th>Pembeli</th>
        <th>Jumlah Tiket</th>
        <th>Jumlah Pembelian</th>
        <th>Waktu</th>
    </tr>
    <?php foreach($transaksi as $row):?>
        <tr>
            <td><?= $row['nama']?></td>
            <td><?= $row['total_tiket']?></td>
            <td><?= $row['total_pembelian']?></td>
            <td><?= tgl_waktu_indo($row['waktu'])?></td>
        </tr>
    <?php endforeach?>


</table>
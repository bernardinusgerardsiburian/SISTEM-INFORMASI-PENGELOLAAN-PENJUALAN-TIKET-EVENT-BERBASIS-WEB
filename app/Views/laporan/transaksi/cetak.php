<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Transaksi</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Tanggal : <?= tgl_indo($daritanggal).' - '.tgl_indo($sampaitanggal)?></b>
</div>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>

        <th>Kode</th>
        <th>Pembeli</th>
        <th>Event</th>
        <th>Status</th>
        <th>Total</th>
    </tr>
    <?php foreach($transaksi as $row):?>
        <tr>
            <td><?= $row['kode']?></td>
            <td><?= $row['nama']?></td>
            <td><?= $row['nama_event']?></td>
            <td><?= ($row['status']=='wait_for_payment' ? 'Menunggu Pembayaran':($row['status']=='wait_for_confirmation' ? 'Menunggu Konfirmasi':($row['status']=='paid' ? 'Pembayaran diterima':'dibatalkan/gagal')))?></td>
            <td><?= rupiah($row['total'])?></td>
        </tr>
    <?php endforeach?>
</table>
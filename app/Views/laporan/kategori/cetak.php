<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Kategori</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Tanggal : <?= tgl_indo($daritanggal).' - '.tgl_indo($sampaitanggal)?></b>
</div>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>

        <th>Kategori Event</th>
        <th>Jumlah Event</th>
        <th>Jumlah Tiket Terjual</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <?php foreach($kategori as $row):?>
        <tr>
            <td><?= $row['nama']?></td>
            <td><?= $row['jumlah_event']?></td>
            <td><?= $row['jumlah_tiket']?></td>
            <td><?= rupiah($row['jumlah_pendapatan'])?></td>
        </tr>
    <?php endforeach?>
</table>
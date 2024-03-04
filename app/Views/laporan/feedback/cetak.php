<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Feedback</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Tanggal : <?= tgl_indo($daritanggal).' - '.tgl_indo($sampaitanggal)?></b>
</div>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>

        <th>Event</th>
        <th>Kategori Event</th>
        <th>Jumlah Transaksi</th>
        <th>Rating</th>
    </tr>
    <?php foreach($feedback as $row):?>
        <tr>
            <td><?= $row['nama']?></td>
            <td><?= $row['nama_kategori']?></td>
            <td><?= $row['jumlah_transaksi']?></td>
            <td><?= $row['rating']?></td>
        </tr>
    <?php endforeach?>
</table>
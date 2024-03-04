<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Rangkuman Event</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Tanggal : <?= tgl_indo($daritanggal).' - '.tgl_indo($sampaitanggal)?></b>
</div>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>

        <th>Nama Event</th>
        <th>Kategori Event</th>
        <th>Tanggal Event</th>
        <th>Total Penjualan Tiket</th>
    </tr>
    <?php foreach($transaksi as $row):?>
        <tr>
            <td><?= $row['nama']?></td>
            <td><?= $row['nama_kategori']?></td>
            <td><?= tgl_indo($row['tanggal'])?></td>
            <td><?= rupiah($row['total_penjualan'])?></td>
        </tr>
    <?php endforeach?>
</table>
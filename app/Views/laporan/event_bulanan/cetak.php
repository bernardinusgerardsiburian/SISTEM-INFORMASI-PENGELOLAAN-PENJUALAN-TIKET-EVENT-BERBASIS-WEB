<div style="text-align: center;padding-top:5px;padding-bottom:40px;">
    <h3>Laporan Event Bulanan</h3>
</div>
<div style="padding-top:5px;padding-bottom:10px;">
    <b>Tahun : <?= $tahun?></b>
</div>
<table class='main' border='1' repeat_header="1" cellspacing="0" width="100%" >
    <tr>

        <th>Bulan</th>
        <th>Total Tiket</th>
        <th>Total Event</th>
    </tr>
    <?php foreach($transaksi as $row):?>
        <tr>
            <td><?= bulan_indo($row['bulan'])?></td>
            <td><?= $row['total_tiket']?></td>
            <td><?= $row['total_event']?></td>
        </tr>
    <?php endforeach?>
</table>
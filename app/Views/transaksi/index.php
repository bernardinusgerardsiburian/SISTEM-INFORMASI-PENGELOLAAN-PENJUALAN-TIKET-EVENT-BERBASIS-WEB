<div class="row mb-2">

</div>
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table1" class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                <tr>
                    <th class="border-0">Kode</th>
                    <th class="border-0">Pembeli</th>
                    <th class="border-0">Event</th>
                    <th class="border-0">Status</th>
                    <th class="border-0">Total</th>
                    <th style="width: 60px;" class="border-0 rounded-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($transaksi as $row):?>
                    <tr>
                        <td><?= $row['kode']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['nama_event']?></td>
                        <td><?= ($row['status']=='wait_for_payment' ? 'Menunggu Pembayaran':($row['status']=='wait_for_confirmation' ? 'Menunggu Konfirmasi':($row['status']=='paid' ? 'Pembayaran diterima':($row['status']=='req_refund' ? 'Permintaan Refund':($row['status']=='refund' ? 'Refund diterima':'dibatalkan/gagal')))))?></td>
                        <td><?= rupiah($row['total'])?></td>
                        <td>
                            <form method="POST" action="<?= base_url('admin/transaksi/delete')?>">
                                <a href="<?= base_url('admin/transaksi/detail').'?kode='.$row['kode']?>" class="btn btn-sm btn-info">Detail</a>

                                <input type="hidden" name="id" value="<?= $row['id']?>" />
                                <input class="btn btn-sm btn-danger" type="submit" value="Hapus"
                                       onclick="return confirm('Anda yakin ingin menghapus data tersebut?')"
                                />
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
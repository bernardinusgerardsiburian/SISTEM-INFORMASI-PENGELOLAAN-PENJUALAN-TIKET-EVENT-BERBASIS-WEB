<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h3>Data Pembeli</h3>
                <hr/>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $transaksi['nama']?></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td><?= $transaksi['no_hp']?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h3>Detail Pembelian</h3>
                <hr/>
                <table class="table table-bordered">
                    <tr>
                        <th>Tiket</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach($transaksi['details'] as $row):?>
                    <tr>
                        <td>
                            <?= $row['nama']?>
                        </td>
                        <td><?= $row['quantity']?></td>
                        <td><?= rupiah($row['harga'])?></td>
                    </tr>
                    <?php
                    $total += $row['sub_total'];
                    endforeach;?>
                    <tr>
                        <th colspan="2">Total</th>
                        <th><?= rupiah($total)?></th>
                    </tr>
                </table>
                <div class="mt-2">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>- Pilih -</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                        </select>
                    </div>
                    <a href="<?= base_url('payment').'/1' ?>" class="btn btn-primary">Lanjut Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php
    $attributes = ['id' => 'formCreate','class'=>'row'];
    echo form_open('checkout/store', $attributes);
    ?>
    <input type="hidden" name="chart" value="<?= $chart?>">
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h3>Data Pembeli</h3>
                <hr/>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input name="no_hp" type="text" class="form-control" placeholder="No HP" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option selected disabled>- Pilih -</option>
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
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
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach($tiket as $row):
                        ?>
                    <tr>
                        <td><?= $row['nama']?></td>
                        <td><?= rupiah($row['harga'])?></td>
                        <td><?= $row['quantity']?></td>
                        <td><?= rupiah($row['sub_total'])?></td>
                    </tr>
                    <?php
                    $total += $row['sub_total'];
                    endforeach;?>
                    <tr>
                        <th colspan="3">Total</th>
                        <th><?= rupiah($total)?></th>
                    </tr>
                </table>
                <div class="mt-2">
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran_id" class="form-select" required>
                            <option selected disabled>- Pilih -</option>
                            <?php foreach($metode_pembayaran as $row):?>
                            <option value="<?= $row['id']?>"><?= $row['nama_metode']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lanjut Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close()?>
</div>
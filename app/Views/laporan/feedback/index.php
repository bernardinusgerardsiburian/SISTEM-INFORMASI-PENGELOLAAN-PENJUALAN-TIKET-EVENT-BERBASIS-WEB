
<div class="card border-0 shadow mb-4">
    <div class="container">
        <div class="mt-4 mb-4">
            <form>
                <label>Filter Tanggal</label>
                <div class="row">
                    <div class="col-6">
                        <small>Dari tanggal</small>
                        <input type="date" class="form-control" name="daritanggal" id="tanggal-awal" value="<?= $daritanggal?>" required>
                    </div>
                    <div class="col-6">
                        <small>Sampai tanggal</small>
                        <input type="date" class="form-control" name="sampaitanggal" id="tanggal-akhir" value="<?= $sampaitanggal?>" onchange="this.form.submit();">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(!$sampaitanggal){?>
    <div class="alert alert-danger">
        <strong>Silahkan pilih tanggal terlebih dahulu.</strong>
    </div>
<?php }else{?>
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <a href="<?= base_url('admin/laporan/feedback-cetak').'?daritanggal='.$daritanggal.'&sampaitanggal='.$sampaitanggal?>" class="btn btn-outline-success mb-2">Cetak</a>
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                    <tr>
                        <th class="border-0">Event</th>
                        <th class="border-0">Kategori Event</th>
                        <th class="border-0">Jumlah Transaksi</th>
                        <th class="border-0">Rating</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($feedback as $row):?>
                        <tr>
                            <td><?= $row['nama']?></td>
                            <td><?= $row['nama_kategori']?></td>
                            <td><?= $row['jumlah_transaksi']?></td>
                            <td><?= $row['rating']?></td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }
?>
<?= $this->section('javascripts') ?>
<script>
    document.getElementById("tanggal-awal").addEventListener("change", function(){
        let tanggal = document.getElementById("tanggal-awal").value;
        document.getElementById("tanggal-akhir").setAttribute('min',tanggal);
    });
</script>
<?= $this->endSection() ?>
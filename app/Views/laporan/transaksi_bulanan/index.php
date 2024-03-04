
<div class="card border-0 shadow mb-4">
    <div class="container">
        <div class="mt-4 mb-4">
            <form>
                <label>Filter Tahun</label>
                <div class="row">
                    <div class="col-6">
                        <small>Tahun</small>
                        <select name="tahun" class="form-control" onchange="this.form.submit()">
                            <option selected disabled>: Pilih Tahun :</option>
                            <?php for($i=2023;$i<=DATE('Y');$i++):?>
                                <option <?= ($tahun==$i ? 'selected':'')?> value="<?= $i?>"><?= $i?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(!$tahun){?>
    <div class="alert alert-danger">
        <strong>Silahkan pilih tahun terlebih dahulu.</strong>
    </div>
<?php }else{?>
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <a href="<?= base_url('admin/laporan/transaksi-bulanan-cetak').'?tahun='.$tahun?>" class="btn btn-outline-success mb-2">Cetak</a>
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                    <tr>
                        <th class="border-0">Bulan</th>
                        <th class="border-0">Total Event</th>
                        <th class="border-0">Total Pendapatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($transaksi as $row):?>
                        <tr>
                            <td><?= bulan_indo($row['bulan'])?></td>
                            <td><?= $row['total_event']?></td>
                            <td><?= rupiah($row['total_pendapatan'])?></td>
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
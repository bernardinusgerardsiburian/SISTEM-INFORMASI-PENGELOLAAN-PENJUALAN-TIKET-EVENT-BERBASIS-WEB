<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <?php
        $attributes = ['id' => 'formCreate'];
        echo form_open('admin/metode-pembayaran/update', $attributes);
        ?>
        <div class="row mb-4">
            <input type="hidden" name="id" value="<?= $metode['id']?>">
            <div class="col-12">
                <div class="mb-4">
                    <label>Nama Metode</label>
                    <input type="text" name="nama_metode" class="form-control" value="<?= $metode['nama_metode']?>">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Nomor</label>
                    <input type="text" name="nomor_metode" class="form-control" value="<?= $metode['nomor_metode']?>">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Atas Nama</label>
                    <input type="text" name="atas_nama" class="form-control" value="<?= $metode['atas_nama']?>">
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('admin/metode-pembayaran')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
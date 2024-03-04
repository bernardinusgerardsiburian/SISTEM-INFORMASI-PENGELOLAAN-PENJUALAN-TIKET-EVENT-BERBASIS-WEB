<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <?php
        $attributes = ['id' => 'formCreate'];
        echo form_open('admin/tiket/store', $attributes);
        ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="mb-4">
                    <label>Nama Tiket</label>
                    <input type="text" name="nama" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Harga</label>
                    <input type="number" name="harga" min="0" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Stok</label>
                    <input type="number" min="0" name="stok" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control">
                </div>
            </div>
            <input type="hidden" name="event_id" value="<?= $event_id?>">

        </div>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('admin/kategori-event')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
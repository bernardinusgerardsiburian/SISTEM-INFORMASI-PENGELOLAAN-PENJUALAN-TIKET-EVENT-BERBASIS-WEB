<div class="card border-0 shadow mb-4">
    <div class="card-body">
    <?php
    $attributes = ['id' => 'formCreate'];
    echo form_open('admin/kategori-event/store', $attributes);
    ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="mb-4">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control">
                </div>
            </div>
            
        </div>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('admin/kategori-event')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
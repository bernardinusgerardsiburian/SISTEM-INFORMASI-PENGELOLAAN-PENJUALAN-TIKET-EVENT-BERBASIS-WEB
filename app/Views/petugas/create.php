<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <?php
        $attributes = ['id' => 'formCreate'];
        echo form_open('admin/petugas/store', $attributes);
        ?>
        <div class="row mb-4">
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
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('admin/petugas')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
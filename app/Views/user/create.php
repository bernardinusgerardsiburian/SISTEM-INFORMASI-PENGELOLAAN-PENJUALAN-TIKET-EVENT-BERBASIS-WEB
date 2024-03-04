<div class="card border-0 shadow mb-4">
    <div class="card-body">
    <?php
    $attributes = ['id' => 'formCreate'];
    echo form_open('admin/user/store', $attributes);
    ?>
        <div class="row mb-4">
            <div class="col-6">
                <div class="mb-4">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-4">
                    <label>Petugas</label>
                    <select class="form-control" name="petugas_id">
                        <option selected disabled>- Pilih Petugas -</option>
                        <?php foreach($petugas as $row):?>
                            <option value="<?= $row['id']?>"><?= $row['nama']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-4">
                    <label>Role</label>
                    <select class="form-control" name="role">
                        <option selected disabled>- Pilih Role -</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>
            </div>
            
        </div>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('user')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
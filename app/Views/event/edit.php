<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <?php
        $attributes = ['id' => 'formCreate'];
        echo form_open_multipart('admin/event/update', $attributes);
        ?>
        <input type="hidden" name="id" value="<?= $event['id']?>">
        <div class="row mb-4">
            <div class="col-12">
                <div class="mb-4">
                    <label>Nama Event</label>
                    <input type="text" name="nama" class="form-control" value="<?= $event['nama']?>">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"><?= $event['deskripsi']?></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Alamat/Lokasi</label>
                    <textarea class="form-control" name="alamat"><?= $event['alamat']?></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-4">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"  value="<?= $event['tanggal']?>">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-4">
                    <label>Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" class="form-control"  value="<?= $event['waktu_mulai']?>">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-4">
                    <label>Waktu Berakhir</label>
                    <input type="time" name="waktu_berakhir" class="form-control" value="<?= $event['waktu_berakhir']?>">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <img src="<?= base_url($event['gambar'])?>" class="img-thumbnail" style="width: 240px">

                </div>
                <div class="col-6">

                    <div class="mb-4">
                        <label>Gambar/Banner</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-warning">* Upload gambar akan mengganti gambar lama</small>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb-4">
                    <label>Kategori</label>
                    <select class="form-select" name="kategori_event_id">
                        <option selected>:: Pilih ::</option>
                        <?php foreach($kategori as $row):?>
                            <option <?= ($row['id']==$event['kategori_event_id'] ? 'selected':'')?> value="<?= $row['id']?>"><?= $row['nama']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <a href="<?= base_url('admin/event')?>" class="btn btn-sm btn-gray-200">Kembali</a>
        </div>
        </form>
    </div>
</div>
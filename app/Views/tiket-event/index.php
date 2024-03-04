<div class="row mb-2">
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="text-center">
                <img src="<?= base_url($event['gambar'])?>" class="img-fluid" style="width: 280px">
            </div>

            <div class="card-body">
                <h3><?= $event['nama']?></h3>
                <hr/>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> <?= $event['alamat']?></li>
                    <li class="list-group-item"><i class="fas fa-calendar-check"></i> <?= tgl_indo($event['tanggal'])?></li>
                    <li class="list-group-item"><i class="fas fa-clock"></i> <?= $event['waktu_mulai'].' - '.$event['waktu_berakhir']?></li>
                </ul>
                <hr/>
                <p><?= $event['deskripsi']?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="mb-2">
            <a href="<?= base_url('admin/tiket/create').'/'.$event['id']?>" class="btn btn-success btn-sm">
                Tambah Data
            </a>
        </div>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">Event</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th style="width: 60px;" class="border-0 rounded-end">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($tiket as $row):?>
                            <tr>
                                <td><?= $row['nama']?></td>
                                <td><?= rupiah($row['harga'])?></td>
                                <td><?= $row['stok']?></td>
                                <td>
                                    <form method="POST" action="<?= base_url('admin/tiket/delete')?>">
                                        <a href="<?= base_url('admin/tiket/edit').'?id='.$row['id']?>" class="btn btn-sm btn-warning">Edit</a>

                                        <input type="hidden" name="id" value="<?= $row['id']?>" />
                                        <input class="btn btn-sm btn-danger" type="submit" value="Hapus"
                                               onclick="return confirm('Anda yakin ingin menghapus data tersebut?')"
                                        />
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
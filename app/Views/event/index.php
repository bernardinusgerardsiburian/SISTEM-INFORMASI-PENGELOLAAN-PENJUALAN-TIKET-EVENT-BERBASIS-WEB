<div class="row mb-2">
                    <div>
                        <a href="<?= base_url('admin/event/create')?>" class="btn btn-success btn-sm">
                            Tambah Data
                        </a>
                    </div>
                </div>
<div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table1" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">Event</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th style="width: 60px;" class="border-0 rounded-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($event as $row):?>
                                <tr>
                                    <td><?= $row['nama']?></td>
                                    <td><?= tgl_indo($row['tanggal'])?></td>
                                    <td><?= $row['waktu_mulai'].' - '.($row['waktu_berakhir'] ? $row['waktu_berakhir']:'Selesai')?></td>
                                    <td>
                                    <form method="POST" action="<?= base_url('admin/event/delete')?>">
                                        <a href="<?= base_url('admin/tiket/').'/'.$row['id']?>" class="btn btn-sm btn-primary text-white"><i class="fas fa-ticket-alt"></i> Tiket</a>
                                        <a href="<?= base_url('admin/event/edit').'?id='.$row['id']?>" class="btn btn-sm btn-warning">Edit</a>
                                        
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
<div class="row mb-2">
                    <div>
                        <a href="<?= base_url('admin/user/create')?>" class="btn btn-success btn-sm">
                            Tambah Data
                        </a>
                    </div>
                </div>
<div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">Username</th>
                                    <th class="border-0">Role</th>
                                    <th class="border-0">Petugas</th>
                                    <th style="width: 60px;" class="border-0 rounded-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($user as $row):?>
                                <tr>
                                    <td><?= $row['username']?></td>
                                    <td><?= $row['role']?></td>
                                    <td><?= $row['petugas']?></td>
                                    <td>
                                    <form method="POST" action="<?= base_url('admin/user/delete')?>">
                                        <a href="<?= base_url('admin/user/edit').'?id='.$row['user_id']?>" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <input type="hidden" name="id" value="<?= $row['user_id']?>" />
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
<?= $pager->links('','bootstrap_pagination');?>
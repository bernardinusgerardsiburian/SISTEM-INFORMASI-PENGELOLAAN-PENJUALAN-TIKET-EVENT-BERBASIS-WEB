<div class="row">
    <h3>Transaksi #<?= $transaksi['kode']?></h3>
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h5>Data Pembeli</h5>
                <hr/>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $transaksi['nama']?></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td><?= $transaksi['no_hp']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $transaksi['email']?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamain</td>
                        <td>:</td>
                        <td><?= ($transaksi['jenis_kelamin']=='L' ? 'Laki-laki':'Perempuan')?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= tgl_indo($transaksi['tanggal_lahir'])?></td>
                    </tr>
                </table>
                <hr/>
                <h5>Event</h5>
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <img src="<?= base_url($transaksi['event']['gambar'])?>" class="img img-thumbnail">
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong><?= $transaksi['event']['nama']?></strong></li>
                            <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> <?= $transaksi['event']['alamat']?></li>
                            <li class="list-group-item"><i class="fas fa-calendar-check"></i> <?= tgl_indo($transaksi['event']['tanggal'])?></li>
                            <li class="list-group-item"><i class="fas fa-clock"></i> <?= $transaksi['event']['waktu_mulai'].' - '.$transaksi['event']['waktu_berakhir']?></li>
                        </ul>
                    </div>
                </div>
                <hr/>
                <p><?= $transaksi['event']['deskripsi']?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h5>Detail Pembelian</h5>
                <hr/>
                <table class="table table-bordered">
                    <tr>
                        <th>Tiket</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach($transaksi['details'] as $row):?>
                        <tr>
                            <td>
                                <?= $row['nama']?>
                            </td>
                            <td><?= $row['quantity']?></td>
                            <td><?= rupiah($row['harga'])?></td>
                        </tr>
                        <?php
                        $total += $row['sub_total'];
                    endforeach;?>
                    <tr>
                        <th colspan="2">Total</th>
                        <th><?= rupiah($total)?></th>
                    </tr>
                </table>
                <hr/>
                <div class="mt-2">
                    <h5>Pembayaran</h5>
                    <table>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>:</td>
                            <td><b><?= ($transaksi['status_pembayaran']=='wait_for_payment' ? 'Menunggu pembayaran':($transaksi['status_pembayaran']=='wait_for_confirmation' ? 'Menunggu Konfirmasi':($transaksi['status_pembayaran']=='paid' ? 'Berhasil':($transaksi['status_pembayaran']=='req_refund' ? 'Permintaan Refund':($transaksi['status_pembayaran']=='refund' ? 'Refund diterima':'Gagal/dibatalkan')))))?></b></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td><?= $transaksi['nama_metode']?></td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td><?= $transaksi['nomor_metode']?></td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td><?= $transaksi['atas_nama']?></td>
                        </tr>
                    </table>
                    <?php
                    if($transaksi['status_pembayaran']=='wait_for_confirmation' || $transaksi['status_pembayaran']=='paid' || $transaksi['status_pembayaran']=='req_refund' || $transaksi['status_pembayaran']=='refund'){
                        ?>
                        <h5 class="mt-2">Pengirim</h5>
                        <table>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>:</td>
                                <td><?= $transaksi['metode_pembayaran_pengirim']?></td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td><?= $transaksi['no_rek_pengirim']?></td>
                            </tr>
                            <tr>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td><?= $transaksi['atas_nama_pengirim']?></td>
                            </tr>
                        </table>
                        <p>Bukti Pembayaran</p>
                        <img src="<?= base_url($transaksi['bukti_pembayaran'])?>" class="img img-thumbnail">
                        <?php
                    }?>
                    <hr/>
                    <?php if($transaksi['refund'] && $transaksi['refund']['status'] != 'req_refund'){?>
                        <div class="alert alert-info">
                            <strong>Permintaan Refund <?= ($transaksi['refund']['status']=='refund' ? 'Diterima':($transaksi['refund']['status']=='req_refund' ? 'Menunggu':'Ditolak'))  ?></strong>
                        </div>
                    <?php }?>
                    <?php
                    if($transaksi['status_pembayaran']=='wait_for_confirmation'){
                        $attributes = ['id' => 'formCreate','class'=>'row'];
                        echo form_open_multipart('admin/transaksi/updateStatus', $attributes);
                        ?>
                        <div class="container-fluid">

                            <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']?>">
                            <input type="hidden" name="pembayaran_id" value="<?= $transaksi['pembayaran_id']?>">
                            <input class="btn btn-sm btn-success" type="submit" name="status" value="Terima"
                                   onclick="return confirm('Anda yakin ingin mengkonfirmasi transaksi tersebut?')"
                            />
                            <input class="btn btn-sm btn-danger" type="submit" name="status" value="Tolak"
                                   onclick="return confirm('Anda yakin ingin mengkonfirmasi transaksi tersebut?')"
                            />
                        </div>
                        <?= form_close()?>
                        <?php
                    }elseif($transaksi['status_pembayaran']=='req_refund'){
                    $attributes = ['id' => 'formCreate','class'=>'row'];
                    echo form_open_multipart('admin/transaksi/updateRefund', $attributes);
                    ?>
                    <div class="container-fluid">
                        <div class="alert alert-info">
                            <strong>Pembeli telah melakukan permintaan refund</strong>
                            <p>Alasan refund : <?= $transaksi['refund']['alasan']?></p>
                        </div>
                        <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']?>">
                        <input type="hidden" name="pembayaran_id" value="<?= $transaksi['pembayaran_id']?>">
                        <input class="btn btn-sm btn-success" type="submit" name="status" value="Refund"
                               onclick="return confirm('Anda yakin ingin mengkonfirmasi transaksi tersebut?')"
                        />
                        <input class="btn btn-sm btn-danger" type="submit" name="status" value="Reject"
                               onclick="return confirm('Anda yakin ingin mengkonfirmasi transaksi tersebut?')"
                        />
                    </div>
                    <?= form_close()?>
<?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
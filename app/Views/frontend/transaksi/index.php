<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
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

        <?php if($feedback AND $transaksi['status']=='paid'){?>
        <div class="card m-2">
            <div class="card-body">
                <h5>Feedback</h5>
                <p><?= $feedback['feedback']?></p>
                <h5>Rating</h5>

                <div class="rate">
                    <?php for($i=1;$i<=$feedback['rating'];$i++):?>
                        <span class="fa fa-star checked" style="color: orange;"></span>
                    <?php endfor?>
                </div>
            </div>
        </div>
        <?php }elseif($transaksi['status']=='paid'){?>
            <div class="container-fluid">
                <div class="alert alert-info">
                    Silahkan berikan feedback anda
                </div>
<?= form_open('transaksi/storeFeedback',['method'=>'post'])?>
                <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']?>">
                <input type="hidden" name="event_id" value="<?= $transaksi['event']['id']?>">
                <div class="mb-3">
                    <label class="form-label">Feedback</label>
                    <input name="feedback" type="text" class="form-control" placeholder="Masukan Feedback anda" required>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <label class="form-label">Rating</label>
                    </div>
                    <div class="rate">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
                <?= form_close()?>
            </div>
        <?php }?>
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
                    <div class="d-flex justify-content-between">
                    <h5>Pembayaran</h5>
                        <?php if($transaksi['status_pembayaran']=='paid'){?>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Permintaan Refund</button>
                    <?php }?>
                    </div>
                    <table>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>:</td>
                            <td><b><?= ($transaksi['status_pembayaran']=='wait_for_payment' ? 'Menunggu pembayaran':($transaksi['status_pembayaran']=='wait_for_confirmation' ? 'Menunggu Konfirmasi':($transaksi['status_pembayaran']=='paid' ? 'Berhasil':($transaksi['status_pembayaran']=='req_refund' ? 'Permintaan Refund dikirim':($transaksi['status_pembayaran']=='refund' ? 'Refund diterima':'Gagal/dibatalkan')))))?></b></td>
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
                            <?php if($transaksi['refund']['status']=='refund'){?>
                                <p>Silahkan tunggu pembayaran anda dikembalikan segera.</p>
                            <?php }?>
                        </div>
                    <?php }?>
                    <?php
                        if($transaksi['status_pembayaran']=='wait_for_payment'){
                            $attributes = ['id' => 'formCreate','class'=>'row'];
                            echo form_open_multipart('transaksi/storePembayaran', $attributes);
                            ?>
                                <div class="container-fluid">
                                    <div class="alert alert-info">
                                        Silahkan lakukan pembayaran dan upload bukti pembayaran
                                    </div>

                                    <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']?>">
                                    <input type="hidden" name="pembayaran_id" value="<?= $transaksi['pembayaran_id']?>">
                                    <div class="mb-3">
                                        <label class="form-label">Atas Nama Pengirim</label>
                                        <input name="atas_nama_pengirim" type="text" class="form-control" placeholder="Nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Metode Pembayaran</label>
                                        <input name="metode_pembayaran_pengirim" type="text" class="form-control" placeholder="(Contoh : BRI)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Rekening</label>
                                        <input name="no_rek_pengirim" type="text" class="form-control" placeholder="No Rekening" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Bukti Pembayaran</label>
                                        <input name="image" type="file" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload Pembayaran</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Permintaan Refund</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('transaksi/refund',['method'=>'POST'])?>
            <div class="modal-body">
                <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']?>">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Alasan:</label>
                        <textarea class="form-control" name="alasan"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->section('javascripts')?>
<script>
</script>
<?= $this->endSection()?>

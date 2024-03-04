<div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card m-2">
                <div class="text-center">
                    <img src="<?= base_url($event['gambar'])?>" class="img-fluid" style="width: 512px">
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
                    <hr/>
                    Bagikan event :
                    <br/>
                    <a href="https://api.whatsapp.com/send?phone=&text=<?= base_url('event').'/'.$event['id']?>" target="_blank" class="btn btn-outline-primary"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(base_url('event').'/'.$event['id'])?>" target="_blank" class="btn btn-outline-primary"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card m-2">
                <div class="card-body">
                    <?php
                    $attributes = ['id' => 'formCreate'];
                    echo form_open('checkout/chart', $attributes);
                    ?>
                    <input type="hidden" name="event_id" value="<?= $event['id']?>">
                    <h3>Pilih Tiket</h3>
                    <hr/>
                    <?php foreach($tiket as $row):?>
                    <input type="hidden" name="tiket[]" value="<?= $row['id']?>">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><?= $row['nama']?> (<?= rupiah($row['harga'])?>)</span>
                            <input name="quantity[]" type="number" class="form-control" step="1" min="0" max="<?= $row['stok']?>" value="0">
                        </div>
                    <?php endforeach;?>
                    <button type="submit" class="btn btn-primary">Beli Tiket</button>
                    <?= form_close()?>
                </div>
            </div>
        </div>

    </div>
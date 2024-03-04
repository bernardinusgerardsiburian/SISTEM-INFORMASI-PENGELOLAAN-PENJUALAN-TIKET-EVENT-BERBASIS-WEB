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
    <div class="col-lg-8 col-sm-12">
        <div class="container mb-5">
            <?php if(!$kategori_event){?>
            <h5>Temukan Event</h5>
            <?php }else{?>
                <h5>Event <?= $kategori_event['nama']?></h5>
            <?php }?>
            <div class="row">
                <?php
                if($event){
                foreach($event as $row):?>
                <div class="col-lg-4 col-sm-12 p-2">
                    <div class="card">
                        <img src="<?= base_url($row['gambar'])?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama']?></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> <?= $row['alamat']?></li>
                                <li class="list-group-item"><i class="fas fa-calendar-check"></i> <?= tgl_indo($row['tanggal'])?></li>
                            </ul>
                            <a href="<?= base_url('event').'/'.$row['id']?>" class="btn btn-primary">Beli Tiket</a>
                        </div>
                    </div>
                </div>
                <?php
                endforeach;
                }else{
                    ?>
                <div class="container-fluid">
                <div class="alert alert-warning"><strong>Event tidak ditemukan</strong></div>
                </div>
                    <?php
                }?>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card m-2">
            <div class="card-body">
                <h5 class="card-title">Cari Event</h5>
                <form class="row g-3" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="judul" placeholder="Cari Event"
                               aria-label="Recipient's username" aria-describedby="button-addon2"
                                value="<?= $cari_event?>"
                        >
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card m-2">
            <div class="card-body">
                <h5 class="card-title">Sudah Punya Tiket?</h5>
                <form class="row g-3" action="<?= base_url('transaksi')?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="kode" placeholder="Kode Transaksi / Pembelian" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card m-2">
            <div class="card-body">
                <h5 class="card-title">Kategori Event</h5>
                <form class="row g-3">
                    <select class="form-select" aria-label="Default select example" name="kategori" onchange="this.form.submit()">
                        <option selected>:: Pilih ::</option>
                        <?php foreach($kategori as $row):?>
                        <option <?= (!$kategori_event ? '':($kategori_event['id']==$row['id'] ? 'selected':''))?> value="<?= $row['id']?>"><?= $row['nama']?></option>
                        <?php endforeach;?>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row p-5">
    <h4>Testimoni</h4>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $no=0;
            foreach($feedback as $row):
            ?>
            <div class="carousel-item <?= ($no==0 ? 'active':'')?>">
                <div class="row">
                    <?php foreach($row as $i):?>
                    <div class="col-12 col-md-6 col-xl-2 mb-4">
                        <div class="card mr-3">
                            <img src="<?= base_url($i['gambar'])?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $i['nama']?></h5>
                                <p><?= $i['feedback']?></p>
                                <div class="rate">
                                    <?php for($j=1;$j<=$i['rating'];$j++):?>
                                        <span class="fa fa-star checked" style="color: orange;"></span>
                                    <?php endfor?>
                                </div>
                                <small><?= $i['nama_pembeli']?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <?php
                $no++;
            endforeach;?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
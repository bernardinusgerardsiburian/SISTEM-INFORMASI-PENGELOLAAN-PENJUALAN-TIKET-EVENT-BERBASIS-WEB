<div class="row">
    <div class="col-sm-12 col-xl-8 mb-4">
        <div class="row">
            <div class="card mb-2">
                <div class="card-header bg-light text-center">
                    <h4>Grafik Penjualan Per Event</h4>
                </div>
                <div class="card-body">
                    <div class="ct-chart-bar ct-golden-section"></div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header bg-light text-center">
                    <h4>Grafik Penjualan Tiket Event</h4>
                </div>
                <div class="card-body">
                    <div class="ct-chart-line ct-golden-section"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 col-xl-4 mb-4">
        <div class="card">
            <div class="card-header bg-light text-center">
                <h4>Pembeli tiket berdasarkan jenis kelamin</h4>
            </div>
            <div class="card-body">
                <div class="ct-chart ct-golden-section"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->section('javascripts') ?>

<script>
    function loadChartJumlahPenjualan(tahun = 2024){
        $.ajax({
            url: '<?= base_url()?>/admin/data-chart-jumlah-transaksi?tahun='+tahun,
            type: 'GET',
            async: false,
            dataType: 'json',
            success: function(res) {
                new Chartist.Line('.ct-chart-line', {
                    labels: res.labels,
                    series: [
                        res.series,
                    ]
                }, {
                    fullWidth: true,
                    chartPadding: {
                        right: 40
                    },
                    axisY: {
                        onlyInteger: true,
                        offset: 20
                    }
                });
            }
        });
    }

    $.ajax({
        url: '<?= base_url()?>/admin/data-chart-transaksi-event',
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function(res) {
            console.log(res)
            let data = {
                labels: res.labels,
                series:  [res.series]
            };

            var options = {
                seriesBarDistance: 30
            };
            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];


            new Chartist.Bar('.ct-chart-bar', data,options,responsiveOptions);
        }
    });

    $.ajax({
        url: '<?= base_url()?>/admin/data-chart-pembeli-jenis-kelamin',
        type: 'GET',
        async: false,
        dataType: 'json',
        success: function(res) {
            let labels = res.labels

            let data = {
                series: res.data
            };

            let sum = function(a, b) { return a + b };

            new Chartist.Pie('.ct-chart', data, {
                labelInterpolationFnc: function(value,index) {
                    let persen = Math.round(value / data.series.reduce(sum) * 100) + '%';
                    return labels[index]+'['+persen+']'
                    // return Math.round(value /  + '%';
                }
            });
        }
    });

    loadChartJumlahPenjualan()

</script>
<?= $this->endSection() ?>
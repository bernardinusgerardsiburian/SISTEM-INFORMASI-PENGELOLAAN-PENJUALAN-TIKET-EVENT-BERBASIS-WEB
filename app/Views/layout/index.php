<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Primary Meta Tags -->
<title><?= (isset($title) ? $title:'')?> - SISTEM INFORMASI PENGELOLAAN PENJUALAN TIKET EVENT BERBASIS WEB</title>

<!-- Sweet Alert -->
<link type="text/css" href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css')?>" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="<?= base_url('assets/vendor/notyf/notyf.min.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/vendor/simple-datatables/style.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/chartist/dist/chartist.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/simple-datatables.css')?>">
<!-- Volt CSS -->
<link type="text/css" href="<?= base_url('assets/css/volt.css')?>" rel="stylesheet">
    <link type="text/css" href="<?= base_url('assets/vendor/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
<script data-search-pseudo-elements defer src="<?= base_url('assets/vendor/fontawesome/js/all.min.js')?>" crossorigin="anonymous"></script>
<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>



<?= view('layout/sidebar')?>
    
<main class="content">

<?= view('layout/navbar')?>
<nav aria-label="breadcrumb" class="d-none d-md-inline-block">
    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
        <li class="breadcrumb-item">
            <a href="#">
                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?= (isset($title) ? $title:'')?></li>
    </ol>
</nav>
<div class="row">
    <h4><?= (isset($title) ? $title:'')?></h4>
</div>
<div class="py-4">
    <?= view($content)?>
</div>



<?= view('layout/footer')?>
        </main>

    <!-- Core -->
<script src="<?= base_url('assets/vendor/@popperjs/core/dist/umd/popper.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js')?>"></script>

<!-- Vendor JS -->
<script src="<?= base_url('assets/vendor/onscreen/dist/on-screen.umd.min.js')?>"></script>

<!-- Slider -->
<script src="<?= base_url('assets/vendor/nouislider/dist/nouislider.min.js')?>"></script>

<!-- Smooth scroll -->
<script src="<?= base_url('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')?>"></script>

<!-- Charts -->
<script src="<?= base_url('assets/vendor/chartist/dist/chartist.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')?>"></script>

<!-- Datepicker -->
<script src="<?= base_url('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')?>"></script>

<!-- Sweet Alerts 2 -->
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="<?= base_url('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')?>"></script>

<!-- Notyf -->
<script src="<?= base_url('assets/vendor/notyf/notyf.min.js')?>"></script>

<!-- Simplebar -->
<script src="<?= base_url('assets/vendor/simplebar/dist/simplebar.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/chartist/dist/chartist.min.js')?>"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="<?= base_url('assets/js/volt.js')?>"></script>

<script src="<?= base_url('assets/vendor/simple-datatables/umd/simple-datatables.js')?>"></script>
<script src="<?= base_url('assets/js/simple-datatables.js')?>"></script>
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
<?= view('layout/notif')?>
<?= $this->renderSection('javascripts') ?>
</body>

</html>

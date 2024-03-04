<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title><?= (isset($title) ? $title:'')?> - SISTEM INFORMASI PENGELOLAAN DATA NASABAH KREDIT BERMASALAH</title>

<!-- Sweet Alert -->
<link type="text/css" href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css')?>" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="<?= base_url('assets/vendor/notyf/notyf.min.css')?>" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="<?= base_url('assets/css/volt.css')?>" rel="stylesheet">
<script data-search-pseudo-elements defer src="<?= base_url('assets/vendor/fontawesome/js/all.min.js')?>" crossorigin="anonymous"></script>
<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    

    <main>

        <!-- Section -->
        <?= view($content)?>
    </main>

    <!-- Core -->
<script src="<?= base_url('assets/vendor/@popperjs/core/dist/umd/popper.min.js')?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js')?>"></script>

<!-- Vendor JS -->
<script src="<?= base_url('assets/vendor/onscreen/dist/on-screen.umd.min.js')?>"></script>

<!-- Slider -->
<script src="<?= base_url('assets/vendor/nouislider/distribute/nouislider.min.js')?>"></script>

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

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="<?= base_url('assets/js/volt.js')?>"></script>
<?= view('layout/notif')?>
    
</body>

</html>

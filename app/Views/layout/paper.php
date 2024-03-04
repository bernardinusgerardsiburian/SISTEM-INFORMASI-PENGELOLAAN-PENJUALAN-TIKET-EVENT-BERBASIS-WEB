<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= (isset($title) ? '- '.$title:'')?></title>
	
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body>
<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<?php
    $path = base_url('assets/img/kop mg.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $file = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($file);
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    ?>
	<table border="0" style="width: 100%;text-align: center;">
            <tr>
                <td>
                    <img src="<?= $base64?>" style="width: 720px;height: 180px;">
                </td>
            </tr>
        </table>
<main>
    <?= view($content) ?>
</main>
</body>

</html>

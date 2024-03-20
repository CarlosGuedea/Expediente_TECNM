<?php

use function Francerz\Http\Utils\baseUrl;

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='<?= baseUrl("assets/siitec/script.min.js") ?>'></script>
    <link rel="stylesheet" href="<?= baseUrl("assets/siitec/style.min.css") ?>">
    <link rel="stylesheet" href="<?= baseUrl("assets/style.css") ?>">
    <link rel="shortcut icon" href="https://siitec.colima.tecnm.mx/assets/img/favicon.ico">
    <title><?= $title ?? 'Contratos' ?></title>
</head>

<body>
    <?= $layout->section('content') ?>
    <div class="footer mb-10"></div>
</body>

</html>

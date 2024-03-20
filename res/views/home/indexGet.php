<?php

use App\Classes\MenuItem;
use App\Session;
use ITColima\SiitecApi\SiitecApi;

use function Francerz\Http\Utils\siteUrl;

/* $siitecApi = new SiitecApi();
$perfil = $siitecApi->getPerfil();
$perfil = Session::getPerfil(); */

$menuItem = new MenuItem(
    'Ejemplo de item',
    siteUrl(''),
    'Ejemplo de la descripción del item',
    'icon-ws-x-circle-fill'
);
$breadcrumbs = [
    'Menú Principal' => SiitecApi::getHomeUrl(),
    'app' => siteUrl()
];
?>
<?= $layout = $view->loadLayout('@layouts/default') ?>
<?= $layout->startSection('content') ?>
<?php $view->include('@templates/topBar') ?>
<div class="container">
    <?php $view->include('@templates/sessionbar', ['perfil' => $perfil ?? '']) ?>
    <?php $view->include('@templates/breadcrumbs', ['breadcrumbs' => $breadcrumbs]) ?>
    <h1><?= $title ?? 'Bienvenido!' ?></h1>
    <div class="menulist">
        <?php $view->include('@templates/menuItem', ['menuItem' => $menuItem]) ?>
    </div>
</div>
<?= $layout->endSection() ?>

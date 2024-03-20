<?php

use function Francerz\Http\Utils\baseUrl;
use function Francerz\Http\Utils\siteUrl;

?>
<div class="topbar autostick">
    <div class="container row">
        <div class="col-auto">
            <a class="topbar-item topbar-logo" title="Menú principal" href="https://siitec.colima.tecnm.mx/">
                <svg class="topbar-logo-graphic">
                    <use href="<?= baseUrl('assets/siitec/graphics.svg#logo-siitec') ?>" />
                </svg>
            </a>
        </div>
        <div class="col">
        </div>
        <div class="col-auto">
            <a class="topbar-item" title="Cerrar sesión" href="<?= siteUrl('/logout') ?>">
                <span class="topbar-icon icon-ws-x-circle-fill"></span>
            </a>
        </div>
    </div>
</div>

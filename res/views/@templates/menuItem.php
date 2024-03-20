<?php
$icono = null;
if (isset($menuItem->icon)) {
    $icono = strpos($menuItem->icon, 'icon-ws-') === 0 ? $menuItem->icon : 'menuitem-icon';
}
?>
<a href="<?= $menuItem->url ?>" class="menuitem">
    <div class="menuitem-icon">
        <span class="<?= $icono ?>"></span>
    </div>
    <div class="menuitem-content">
        <div class="menuitem-title"><?= $menuItem->title ?></div>
        <div class="menuitem-description"><?= $menuItem->description ?></div>
    </div>
</a>

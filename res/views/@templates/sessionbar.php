<?php
if (isset($perfil) && !empty($perfil->usuario)) : ?>
    <div class="container">
        <dl class="sessionbar">
            <div class="sessionbar-group">
                <dt class="sessionbar-label">Periodo</dt>
                <dd class="sessionbar-content"><?= $perfil->usuario ?></dd>
            </div>
            <div class="sessionbar-separator"></div>
            <div class="sessionbar-group">
                <dt class="sessionbar-label">Usuario</dt>
                <dd class="sessionbar-content"><?= $perfil->usuario ?></dd>
            </div>
        </dl>
    </div>
<?php endif; ?>

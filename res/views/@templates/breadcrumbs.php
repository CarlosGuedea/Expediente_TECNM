<?php if (!empty($breadcrumbs) && is_array($breadcrumbs)) : ?>
    <div class="container autostick-md bg-default">
        <div class="breadcrumbs">
            <?php foreach ($breadcrumbs as $brd_name => $brd_link) : ?>
                <li class="breadcrumbs-item">
                    <a href="<?= $brd_link ?>" class="breadcrumbs-link"><?= $brd_name ?></a>
                </li>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        $('.breadcrumbs .breadcrumbs-link').last().prop('class', 'breadcrumbs-link--active');
    });
</script>

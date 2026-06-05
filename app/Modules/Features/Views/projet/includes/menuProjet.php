<?php $uri = service('uri'); ?>

<div class="ibox-head d-flex justify-content-between align-items-center">
    <div class="ibox-title"></div>

    <div>
        <a class="btn <?= ($uri->getSegment(3) == 'index' || $uri->getSegment(3) == '') ? 'btn-primary' : 'btn-secondary' ?> btn-sm"
            href="<?= base_url('projet') ?>">
            Liste
        </a>

        <a class="btn <?= ($uri->getSegment(3) == 'ajouter') ? 'btn-primary' : 'btn-secondary' ?> btn-sm"
            href="<?= base_url('projet/ajouter') ?>">
            Ajouter
        </a>
    </div>
</div>
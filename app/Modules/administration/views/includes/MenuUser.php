<?php $method = service('uri')->getSegment(3); ?>

<div class="ibox-head d-flex justify-content-between align-items-center">

    <div class="ibox-title">Gestion des utilisateurs</div>

    <div>
        <a class="btn <?= ($method == 'ajouter') ? 'btn-primary' : '' ?> btn-sm"
            href="<?= base_url('administration/user/ajouter') ?>">
            Ajouter
        </a>

        <a class="btn <?= ($method == '' || $method == 'index') ? 'btn-primary' : '' ?> btn-sm"
            href="<?= base_url('administration/user') ?>">
            Liste
        </a>
    </div>

</div>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>BIRATURABA</title>
    <!-- GLOBAL MAINLY STYLES-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url('public/assetsfront/logo/favicon.ico'); ?>">

    <link href="<?= base_url()?>public/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?= base_url()?>public/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />

    <link href="<?= base_url()?>public/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css"
        rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css"
        rel="stylesheet" />
    <link href="<?= base_url()?>public/assets/vendors/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" />

    <!-- THEME STYLES-->
    <link href="<?= base_url()?>public/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <style>
    .brand-img {
        height: 50px;
    }

    .brand-img-mini {
        height: 30px;
        display: none;
        /* s'affiche seulement en mode mini si tu veux */
    }

    /* Nom utilisateur : autoriser retour à la ligne */
    .user-name {
        max-width: 160px;
        /* ajuste si besoin */
        display: inline-block;
        white-space: normal;
        /* autorise le retour à la ligne */
        word-break: break-word;
        /* coupe les mots trop longs */
        vertical-align: middle;
    }

    /* Dropdown : largeur automatique */
    .user-dropdown {
        min-width: 220px;
        max-width: 300px;
    }

    /* Items du menu */
    .user-dropdown .dropdown-item {
        white-space: normal;
        /* autorise texte sur plusieurs lignes */
        word-break: break-word;
    }
    </style>
    <style>
    /* Correction de la structure globale */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .App-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1 0 auto;
        padding-bottom: 20px;
    }

    /* Correction spécifique pour page-footer */
    .page-footer {
        flex-shrink: 0;
        margin-top: auto;
        background: #f5f5f5;
        padding: 15px 20px;
        text-align: center;
        border-top: 1px solid #ddd;
        width: 100%;
        clear: both;
        position: relative;
        bottom: 0;
        left: 0;
        right: 0;
    }

    /* S'assurer que le footer n'empiète pas sur le tableau */
    .ibox-body {
        overflow-x: auto;
        margin-bottom: 0;
    }

    .dataTables_wrapper {
        margin-bottom: 20px;
    }

    /* Ajuster la hauteur du tableau pour éviter le chevauchement */
    .page-content {
        min-height: calc(100vh - 300px);
    }

    .App-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1;
    }

    /* SOLUTION GLOBALE POUR TOUTES LES PAGES */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .App-wrapper {
        display: flex !important;
        flex-direction: column !important;
        min-height: 100vh !important;
    }

    .content-wrapper {
        flex: 1 0 auto !important;
        padding-bottom: 0 !important;
    }

    /* Correction pour page-footer sur TOUTES les pages */
    .page-footer {
        flex-shrink: 0 !important;
        margin-top: auto !important;
        position: relative !important;
        clear: both !important;
        background: #f5f5f5;
        padding: 15px 20px;
        text-align: center;
        border-top: 1px solid #e0e0e0;
        width: 100%;
    }
    </style>
</head>
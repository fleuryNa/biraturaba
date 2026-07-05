<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
    <!--begin::App Wrapper-->
    <div class="App-wrapper">

<?= view('includes/backend/sidebarmenu_new') ?>

<?= view('includes/backend/menu_new') ?>

  <div class="content-wrapper">
            <div class="content">
                <!-- PAGE HEADING -->
                <div class="page-heading">
                    <h1 class="page-title">Modifier un membre</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Modifier un membre</li>
                    </ol>
                </div>

                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="<?= site_url('formexample') ?>" class="btn btn-secondary">Retour à la liste</a>
                            </div>


        <?php $errors = session()->get('errors') ?? [] ?>
        <?= view('formexample/_form', [
            'action'=>site_url('formexample/update/'.$membre['ID_MEMBRES']), 
            'buttonText'=>'Modifier',
            'membre'=>$membre,
            'provinces'=>$provinces,
            'communes'=>$communes,
            'zones'=>$zones,
            'collines'=>$collines,
            'typeGroupes'=>$typeGroupes,
            'errors'=>$errors
        ]) ?>
     </div>
                    </div>
                </div>
            </div>
        </div>


<?= view('includes/backend/footer_new') ?>

    </div>
    <!-- END App-wrapper -->

    <!-- SETTINGS / BACKDROPS -->
    <?= view('includes/backend/settings.php'); ?>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>
  </body>
  <!--end::Body-->
</html>
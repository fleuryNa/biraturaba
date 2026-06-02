<!DOCTYPE html>
<html lang="en">

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
                    <h1 class="page-title">Créer un membre</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Créer un membre</li>
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
                                'action' => site_url('formexample/store'), 
                                'buttonText' => 'Créer',
                                'provinces' => $provinces,
                                'errors' => $errors
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

    <!-- CSS de correction pour le footer et la hauteur de page -->
    <style>
        /* Correction structurelle globale */
        html, body {
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
            padding-bottom: 0;
        }
        
        .content {
            padding-bottom: 20px;
        }
        
        /* Correction spécifique pour page-footer */
        .page-footer {
            flex-shrink: 0;
            margin-top: auto;
            background: #f5f5f5;
            padding: 12px 20px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            width: 100%;
            clear: both;
        }
        
        /* Éviter que le formulaire soit trop long */
        .ibox-body {
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Ajuster la hauteur du contenu */
        .page-content {
            min-height: calc(100vh - 350px);
        }
        
        /* Pour les écrans très petits, réduire le padding */
        @media (max-width: 768px) {
            .page-footer {
                padding: 8px 15px;
                font-size: 12px;
            }
            
            .page-content {
                min-height: calc(100vh - 300px);
            }
        }
    </style>

    <!-- JavaScript pour ajuster dynamiquement la hauteur -->
    <script>
    $(document).ready(function() {
        adjustLayout();
        
        // Réajuster au redimensionnement
        $(window).on('resize', function() {
            adjustLayout();
        });
    });
    
    function adjustLayout() {
        // S'assurer que le footer est bien à la fin
        var footer = $('.page-footer');
        var appWrapper = $('.App-wrapper');
        
        if (footer.length && appWrapper.length) {
            // Si le footer est dans content-wrapper, le déplacer
            if (footer.parents('.content-wrapper').length) {
                footer.detach().appendTo(appWrapper);
            }
            
            // Appliquer les styles nécessaires
            appWrapper.css({
                'display': 'flex',
                'flex-direction': 'column',
                'min-height': '100vh'
            });
            
            footer.css({
                'flex-shrink': '0',
                'margin-top': 'auto',
                'position': 'relative',
                'clear': 'both'
            });
        }
        
        // Ajuster le content-wrapper
        $('.content-wrapper').css('flex', '1 0 auto');
        
        // Calculer la hauteur disponible pour éviter un footer flottant
        var windowHeight = $(window).height();
        var headerHeight = $('.page-heading').outerHeight() || 100;
        var footerHeight = $('.page-footer').outerHeight() || 50;
        var availableHeight = windowHeight - headerHeight - footerHeight - 100;
        
        if (availableHeight > 300) {
            $('.page-content').css('min-height', availableHeight + 'px');
        } else {
            $('.page-content').css('min-height', 'auto');
        }
    }
    </script>

    <!-- Si votre formulaire utilise des selects dynamiques (province -> zone -> colline) -->
    <script>
    $(document).ready(function() {
        // Gestion des dépendances Province -> Zone
        $('#province_id').on('change', function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: '<?= site_url('formexample/getZonesByProvince') ?>/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#zone_id').empty();
                        $('#zone_id').append('<option value="">Sélectionner une zone</option>');
                        $.each(data, function(key, value) {
                            $('#zone_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#colline_id').empty().append('<option value="">Sélectionner d\'abord une zone</option>');
                    }
                });
            } else {
                $('#zone_id').empty().append('<option value="">Sélectionner une province d\'abord</option>');
                $('#colline_id').empty().append('<option value="">Sélectionner une zone d\'abord</option>');
            }
        });
        
        // Gestion des dépendances Zone -> Colline
        $('#zone_id').on('change', function() {
            var zoneId = $(this).val();
            if (zoneId) {
                $.ajax({
                    url: '<?= site_url('formexample/getCollinesByZone') ?>/' + zoneId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#colline_id').empty();
                        $('#colline_id').append('<option value="">Sélectionner une colline</option>');
                        $.each(data, function(key, value) {
                            $('#colline_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#colline_id').empty().append('<option value="">Sélectionner une zone d\'abord</option>');
            }
        });
    });
    </script>

</body>
</html>
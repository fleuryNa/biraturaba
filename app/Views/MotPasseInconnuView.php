<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Biraturaba | Modifier mot de passe</title>
    <!-- GLOBAL MAINLY STYLES-->
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url('public/assetsfront/logo/favicon.ico'); ?>">

    <link href="<?= base_url('public/assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url('public/assets/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url('public/assets/vendors/themify-icons/css/themify-icons.css')?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?= base_url('public/assets/css/main.css')?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?= base_url('public/assets/css/pages/auth-light.css')?>" rel="stylesheet" />

    <style>
    .brand {
        text-align: center;
        display: flex;
        flex-direction: column;
        /* place le texte en haut, logo en bas */
        align-items: center;
        /* centre horizontalement */
    }

    .brand .link {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
        /* espace entre texte et logo */
    }

    .brand-logo {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
    }
    </style>
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link">BIRATURABA</a>
            <img src="<?= base_url('public/assetsfront/logo/biraturaba.png')?>" class="brand-logo">
        </div>
        <form id="password-form" action="<?= base_url('modifierPassword') ?>" method="post">

            <h2 class="login-title text-center">Modifier le mot de passe</h2>

            <?php if (session()->getFlashdata('message')) : ?>
            <?= session()->getFlashdata('message'); ?>
            <?php endif; ?>

            <?= csrf_field() ?>
            <input class="form-control" type="hidden" name="ID_USER" id="ID_USER" value="<?= $id_user ;?>">


            <div class="form-group">
                <label>Ancien mot de passe</label>
                <div class="input-group-icon right">
                    <div class="input-icon">
                        <i class="fa fa-lock font-16"></i>
                    </div>
                    <input class="form-control" type="password" name="OLDPASSWORD" id="oldPassword" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <div class="input-group-icon right">
                    <div class="input-icon">
                        <i class="fa fa-lock font-16"></i>
                    </div>
                    <input class="form-control" type="password" name="NEWPASSWORD" id="newPassword" minlength="8"
                        required>
                </div>
            </div>

            <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <div class="input-group-icon right">
                    <div class="input-icon">
                        <i class="fa fa-lock font-16"></i>
                    </div>
                    <input class="form-control" type="password" name="CONFIRMPASSWORD" id="confirmPassword" required>
                </div>
            </div>

            <div class="form-group">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox" id="showPassword">
                    <span class="input-span"></span>
                    Voir les mots de passe
                </label>
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">
                    Modifier le mot de passe
                </button>
            </div>

        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?= base_url('public/assets/vendors/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>
    <script src="<?= base_url('public/assets/vendors/popper.js/dist/umd/popper.min.js')?>" type="text/javascript">
    </script>
    <script src="<?= base_url('public/assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript">
    </script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?= base_url('public/assets/vendors/jquery-validation/dist/jquery.validate.min.js')?>"
        type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?= base_url('public/assets/js/app.js')?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
    $(document).ready(function() {

        $('#showPassword').on('change', function() {

            let type = $(this).is(':checked') ? 'text' : 'password';

            $('#oldPassword').attr('type', type);
            $('#newPassword').attr('type', type);
            $('#confirmPassword').attr('type', type);
        });

        $('#password-form').validate({
            errorClass: "text-danger",
            errorElement: "small",

            rules: {
                OLDPASSWORD: {
                    required: true
                },
                NEWPASSWORD: {
                    required: true,
                    minlength: 8
                },
                CONFIRMPASSWORD: {
                    required: true,
                    equalTo: "#newPassword"
                }
            },

            messages: {
                OLDPASSWORD: {
                    required: "Veuillez saisir l'ancien mot de passe."
                },
                NEWPASSWORD: {
                    required: "Veuillez saisir le nouveau mot de passe.",
                    minlength: "Le mot de passe doit contenir au moins 8 caractères."
                },
                CONFIRMPASSWORD: {
                    required: "Veuillez confirmer le mot de passe.",
                    equalTo: "Les mots de passe ne correspondent pas."
                }
            }
        });
    });
    </script>

</body>

</html>
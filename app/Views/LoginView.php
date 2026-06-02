<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Superbat | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/uploads/superbat.png'); ?>">
    <link href="<?= base_url()?>/public/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>/public/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>/public/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?= base_url()?>/public/assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?= base_url()?>/public/assets/css/pages/auth-light.css" rel="stylesheet" />

    <style>
        .brand {
            text-align: center;
            display: flex;
            flex-direction: column;   /* place le texte en haut, logo en bas */
            align-items: center;      /* centre horizontalement */
        }

        .brand .link {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;       /* espace entre texte et logo */
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
       <!-- BEGIN PAGA BACKDROPS-->
   <!--  <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> -->
    <!-- END PAGA BACKDROPS-->
        <div class="brand">
            <a class="link" >BIRATURABA</a>
            <img src="<?= base_url()?>public/assets/img/logos/biraturaba.png" class="brand-logo">
        </div>
       <form id="loginForm" method="post">
            <h2 class="login-title">Log in</h2>

           
         <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="USERNAME" name="USERNAME" placeholder="Email" autocomplete="off">

            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input class="form-control" type="password" name="PASSWORD" id="password">
            </div>
        </div>
       <label class="ui-checkbox ui-checkbox-info">
    <input type="checkbox" onclick="togglePassword()">
    <span class="input-span"></span>Voir le mot de passe
</label>
            <div id="responseMessage"></div>
            <br>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="button" id="btnsb">Login</button>
            </div>

        </form>
    </div>
   
    <!-- CORE PLUGINS -->
    <script src="<?= base_url()?>/public/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url()?>/public/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url()?>/public/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?= base_url()?>/public/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?= base_url()?>assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->



   <script>
$(document).ready(function () {

  $("#btnsb").on("click", function (e) {

    e.preventDefault();

    // Supprimer les anciens messages d'erreur
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();
    $("#responseMessage").html("");

    // Récupérer les valeurs (correction : utiliser l'attribut name ou ajouter des ID)
    let USERNAME = $("input[name='USERNAME']").val().trim();
    let PASSWORD = $("input[name='PASSWORD']").val();

    let isValid = true;

    // Validation email
    if (USERNAME === "") {
      isValid = false;
      $("input[name='USERNAME']")
        .addClass("is-invalid")
        .after('<div class="invalid-feedback">L\'email est obligatoire</div>');
    } else if (!isValidEmail(USERNAME)) {
      isValid = false;
      $("input[name='USERNAME']")
        .addClass("is-invalid")
        .after('<div class="invalid-feedback">Veuillez entrer un email valide</div>');
    }

    // Validation mot de passe
    if (PASSWORD === "") {
      isValid = false;
      $("input[name='PASSWORD']")
        .addClass("is-invalid")
        .after('<div class="invalid-feedback">Le mot de passe est obligatoire</div>');
    }

    if (!isValid) return;

    // Créer le FormData
    let formData = new FormData();
    formData.append("USERNAME", USERNAME);
    formData.append("PASSWORD", PASSWORD);

    // Désactiver le bouton pendant l'envoi
    $("#btnsb")
      .prop('disabled', true)
      .html('<i class="fa fa-spinner fa-spin"></i> Connexion...');

    $.ajax({
      url: "<?= base_url('login') ?>",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function (response) {
        if (response.success) {
          $("#responseMessage").html(
            '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
            '<i class="fa fa-check-circle"></i> Connexion réussie, redirection...' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '</div>'
          );

          setTimeout(function () {
            window.location.href = response.redirect_url;
          }, 800);
        } else {
          $("#responseMessage").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            '<i class="fa fa-exclamation-triangle"></i> ' + response.message +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '</div>'
          );
        }
      },

      error: function (xhr, status, error) {
        console.error("Erreur AJAX:", error);
        $("#responseMessage").html(
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
          '<i class="fa fa-exclamation-triangle"></i> Erreur serveur. Veuillez réessayer.' +
          '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '</div>'
        );
      },

      complete: function () {
        $("#btnsb")
          .prop('disabled', false)
          .html('Connexion');
      }
    });
  });

  // Fonction helper pour valider l'email
  function isValidEmail(email) {
    var re = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
    return re.test(email);
  }

  // Soumettre avec la touche Entrée
  $("input").keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
      $("#btnsb").click();
    }
  });
});
</script>
<script>
function togglePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>















<!-- 
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });



        function myPassword() {

          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    } 

</script> -->
</body>

</html>
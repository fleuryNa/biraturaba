<!doctype html>
<html lang="en">
<!--begin::Head-->
<?= view('includes/backend/header') ?>
<!--end::Head-->
<!--begin::Body-->
<style>

  .login-card-body{
    border-radius:15px;
  }

  .card{
    box-shadow:0 5px 20px rgba(0,0,0,.15);
  }

  .profile-image-pic{
    width:150px;
    height:150px;
    object-fit:cover;
  }

  .login-logo a{
    font-weight:bold;
    color:#0d6efd;
  }

  .btn-primary{
    border-radius:10px;
  }

  .form-control{
    border-radius:8px;
  }
</style>
<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="login-logo">
      <a href="../index2.html"><b></b>BIRATURABA</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">
          <div class="text-center">
            <img src="<?php echo base_url('public/assets/logo/biraturaba.png') ?>"
            class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
            alt="profile">
          </div>
        </p>

        <form id="loginForm" method="post">

          <div id="responseMessage"></div>

          <div class="input-group mb-3">
            <input type="text"
            class="form-control"
            name="USERNAME"
            id="USERNAME"
            placeholder="Nom d'utilisateur">
            <div class="input-group-text">
              <span class="bi bi-person"></span>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password"
            class="form-control"
            name="PASSWORD"
            id="PASSWORD"
            placeholder="Mot de passe">

            <span class="input-group-text toggle-password"
            onclick="togglePassword('PASSWORD')"
            style="cursor:pointer">
            <i id="eye_PASSWORD" class="bi bi-eye"></i>
          </span>
        </div>

        <div class="row">
          <div class="col-6">
            <!-- <div class="form-check">
              <input class="form-check-input"
              type="checkbox"
              id="remember">
              <label class="form-check-label" for="remember">
                Se souvenir de moi
              </label>
            </div> -->
          </div>

          <div class="col-6">
            <div class="d-grid">
              <button type="button"
              id="btnsb"
              class="btn btn-primary">
              Connexion
            </button>
          </div>
        </div>
      </div>

    </form>

    <p class="mb-1">
      <a href="forgot-password.html">Mot de passe oublie</a>
    </p>

  </div>
  <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!--begin::Third Party Plugin(OverlayScrollbars)-->
<?= view('includes/backend/script_back') ?>


<script>
 $(document).ready(function () {

  $("#btnsb").on("click", function (e) {

    e.preventDefault();

    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    let USERNAME = $("#USERNAME").val().trim();
    let PASSWORD = $("#PASSWORD").val();

    let isValid = true;

    if (USERNAME === "") {
      isValid = false;
      $("#USERNAME")
      .addClass("is-invalid")
      .after('<div class="invalid-feedback">Le nom utilisateur est obligatoire</div>');
    }

    if (PASSWORD === "") {
      isValid = false;
      $("#PASSWORD")
      .addClass("is-invalid")
      .after('<div class="invalid-feedback">Le mot de passe est obligatoire</div>');
    }

    if (!isValid) return;

    // ✅ IMPORTANT: prendre le FORM et pas le bouton
    let formData = new FormData($("#loginForm")[0]);

    $("#btnsb")
    .prop('disabled', true)
    .html('<i class="spinner-border spinner-border-sm"></i> Connexion...');

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
            '<div class="alert alert-success">Connexion réussie...</div>'
            );

          setTimeout(function () {
            window.location.href = response.redirect_url;
          }, 800);

        } else {

          $("#responseMessage").html(
            '<div class="alert alert-danger">' + response.message + '</div>'
            );
        }
      },

      error: function () {
        $("#responseMessage").html(
          '<div class="alert alert-danger">Erreur serveur</div>'
          );
      },

      complete: function () {
        $("#btnsb")
        .prop('disabled', false)
        .html('Connexion');
      }
    });

  });

});

</script>
<script>

 function togglePassword(fieldId)
 {
  let input = document.getElementById(fieldId);
  let eye = document.getElementById("eye_" + fieldId);

  if(input.type === "password")
  {
    input.type = "text";
    eye.classList.remove("bi-eye");
    eye.classList.add("bi-eye-slash");
  }
  else
  {
    input.type = "password";
    eye.classList.remove("bi-eye-slash");
    eye.classList.add("bi-eye");
  }
}
</script>


</body>
<!--end::Body-->
</html>

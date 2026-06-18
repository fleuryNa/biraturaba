<!DOCTYPE html>
<html lang="fr">

<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
  <div class="App-wrapper">
    <?= view('includes/backend/sidebarmenu_new') ?>
    <?= view('includes/backend/menu_new') ?>

    <div class="content-wrapper">
      <div class="content">
        <div class="page-heading">
          <h1 class="page-title">Utilisateurs</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('accueil') ?>">Accueil</a></li>
            <li class="breadcrumb-item active">Administration</li>
          </ol>
        </div>

        <div class="page-content fade-in-up">
          <div class="ibox">
            <div class="ibox-head d-flex justify-content-between align-items-center">
              <div class="ibox-title">Liste des utilisateurs</div>
              <a class="btn btn-primary btn-sm" href="<?= base_url('administration/users') ?>">Actualiser</a>
            </div>
            <div class="ibox-body">
              <table id="userTable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Username</th>
                    <th>Agence</th>
                    <th>Profils</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= view('includes/backend/footer_new') ?>
  </div>

  <?= view('includes/backend/settings.php'); ?>
  <?= view('includes/backend/script_back_new') ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
          url: '<?= base_url('administration/users/liste') ?>',
          type: 'POST'
        },
        order: [[0, 'asc']],
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf']
      });
    });
  </script>
</body>
</html>

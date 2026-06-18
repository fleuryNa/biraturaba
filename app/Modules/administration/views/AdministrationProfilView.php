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
          <h1 class="page-title">Profils & Droits</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('accueil') ?>">Accueil</a></li>
            <li class="breadcrumb-item active">Administration</li>
          </ol>
        </div>

        <div class="page-content fade-in-up">
          <div class="ibox">
            <div class="ibox-head d-flex justify-content-between align-items-center">
              <div class="ibox-title">Liste des profils</div>
              <a class="btn btn-primary btn-sm" href="<?= base_url('administration/profils') ?>">Actualiser</a>
            </div>
            <div class="ibox-body">
              <table id="profilTable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Profil</th>
                    <th>Droits</th>
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
      $('#profilTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
          url: '<?= base_url('administration/profils/liste') ?>',
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

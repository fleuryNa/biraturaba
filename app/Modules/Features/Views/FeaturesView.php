<!doctype html>
<html lang="en">
<?= view('includes/backend/header') ?>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    <!--begin::Header-->
    <?= view('includes/backend/sidebarmenu') ?>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <?= view('includes/backend/menu') ?>
    <!--end::Sidebar-->
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0"><?= $title ;?></h3>
            </div>
           <!--  <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Elements</li>
              </ol>
            </div> -->
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="row g-4">
           <div class="card">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#featureModal">
              + Ajouter Feature
            </button>
            <div class="card-body">
              <div id="pills-captage">
                <table class="table table-sm table-bordered table-striped" id="table_features">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Icon</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
<!--begin::Footer-->
<?= view('includes/backend/footer') ?>
<!--end::Footer-->
</div>
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<?= view('includes/backend/script_back') ?>


<script>
// Attendre que le DOM soit chargé
  document.addEventListener('DOMContentLoaded', function() {
    //default pill
    loadCaptageData()

  });

// Fonctions pour charger les données
  function loadCaptageData() {

    $('#table_features').DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "order": [
        [5, 'desc']
        ], // Order by date
        "ajax": {
          url: "<?php echo base_url('caracteristique/liste/') ?>",
          type: "POST",
          data: {}
        },
        lengthMenu: [
          [10, 25, 50, 100, -1],
          [10, 25, 50, 100, "Tous"]
        ],
        pageLength: 10,
        "columnDefs": [{
            "targets": [7], // Action column
            "orderable": false
          }],
          dom: 'Bfrtlip',
          buttons: [{
            extend: 'copy',
            text: '<i class="bi bi-files"></i> Copier'
          },
          {
            extend: 'csv',
            text: '<i class="bi bi-file-earmark-spreadsheet"></i> CSV'
          },
          {
            extend: 'excel',
            text: '<i class="bi bi-file-earmark-excel"></i> Excel'
          },
          {
            extend: 'pdf',
            text: '<i class="bi bi-file-earmark-pdf"></i> PDF'
          },
          {
            extend: 'print',
            text: '<i class="bi bi-printer"></i> Imprimer'
          }
        ],
        language: {
          url: "<?php echo base_url('assets/js/') ?>French.json"
        }
      });
  }
</script>
</body>
</html>

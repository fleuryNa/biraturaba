<!doctype html>
<html lang="en">
  <!--begin::Head-->
  

<?= view('includes/backend/header') ?>




  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
 



<?= view('includes/backend/sidebarmenu') ?>





      <!--end::Header-->
      <!--begin::Sidebar-->



<?= view('includes/backend/menu') ?>





      <!--end::Sidebar-->
      <!--begin::App Main-->
   <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Data Tables</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 16rem">
                    <span class="input-group-text">
                      <i class="bi bi-search" aria-hidden="true"></i>
                    </span>
                    <input
                      id="table-filter"
                      type="search"
                      class="form-control"
                      placeholder="Filter rows…"
                      aria-label="Filter rows"
                    />
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex gap-2 mb-3">
                  <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i>
                    Export CSV
                  </button>
                  <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-json me-1" aria-hidden="true"></i>
                    Export JSON
                  </button>
                  <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-printer me-1" aria-hidden="true"></i>
                    Print
                  </button>
                </div>
                <div id="users-table"></div>
              </div>
              <div class="card-footer text-secondary small">
                Powered by
                <a href="https://tabulator.info/" target="_blank" rel="noopener">Tabulator</a>
                &mdash; vanilla JS, no jQuery required.
              </div>
            </div>
          </div>
        </div>
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
       

<?= view('includes/backend/footer') ?>
     

      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
   


<?= view('includes/backend/script_back') ?>



    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>

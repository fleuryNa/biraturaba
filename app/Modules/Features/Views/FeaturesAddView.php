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

            <!-- Quick Example -->
            <div class="col-md-12">
              <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                  <div class="card-title"><?= $title ;?></div>
                </div>
                <form method="post"
                action="<?= base_url('feature/store') ?>"
                enctype="multipart/form-data">
                <div class="card-body">


                  <div class="mb-3">
                    <label>Titre</label>
                    <input type="text" name="TITLE" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label>Description</label>
                    <textarea name="DESC_FEATURE" class="form-control"></textarea>
                  </div>

                  <div class="mb-3">
                    <label>Icône</label>
                    <input type="file" name="ICON_FEATURE" class="form-control">
                  </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary col-md-12">Submit</button>
              </div>
            </form>
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
</body>
</html>

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
                    <h1 class="page-title">Liste des partenaires</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Partenaires</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Partenaires</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddBlogModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="blogTable" class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Titre</th>
                                                <th>Image</th>
                                                <th>Contenu</th>
                                                <th>Catégorie</th>
                                                <th>Auteur</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!-- DataTables injecte ici -->
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= view('includes/backend/footer_new') ?>

    </div>
    <div class="modal fade" id="blogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong id="modalTitle">Ajouter un blog</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="blogForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_BLOG" id="ID_BLOG">

                        <div class="row">

                            <!-- TITLE -->
                            <div class="col-md-6 mb-3">
                                <label>Titre</label>
                                <input type="text" name="TITLE" id="TITLE" class="form-control">
                            </div>

                            <!-- CATEGORY -->
                            <div class="col-md-6 mb-3">
                                <label>Catégorie</label>
                                <input type="text" name="CATEGORIE_BLOG" id="CATEGORIE_BLOG" class="form-control">
                            </div>

                            <!-- AUTHOR -->
                            <div class="col-md-6 mb-3">
                                <label>Auteur</label>
                                <input type="text" name="AUTHOR" id="AUTHOR" class="form-control">
                            </div>

                            <!-- IMAGE -->
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" name="IMAGE_BLOG" id="IMAGE_BLOG" class="form-control"
                                    accept="image/*">

                                <!-- Preview -->
                                <img id="previewImage" src=""
                                    style="width:120px;height:80px;margin-top:10px;display:none;border-radius:6px;">
                            </div>

                            <!-- CONTENT -->
                            <div class="col-md-12 mb-3">
                                <label>Contenu</label>
                                <textarea name="CONTENT" id="CONTENT" class="form-control" rows="4"></textarea>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" onclick="saveBlog(event)">
                        <i class="fa fa-save"></i> Enregistrer
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- END App-wrapper -->

    <!-- SETTINGS / BACKDROPS -->
    <?= view('includes/backend/settings.php'); ?>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>




    <script>
    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        //default pill
        loadBlogsData()

    });

    // Fonctions pour charger les données
    function loadBlogsData() {
        // alert('ok');
        $('#blogTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('blogs/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [4], // Action column
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
            ]
        });
    }
    </script>
    <script>
    // SAVE (INSERT + UPDATE)
    function saveBlog(e) {
        e.preventDefault();

        let form = $('#blogForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('blogs/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#blogModal').modal('hide');

                    $('#blogTable').DataTable().ajax.reload();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetBlogForm() {
        $('#blogForm')[0].reset();
        $('#ID_BLOG').val('');
        $('#previewImage').attr('src', '');
        $('#modalTitle').text('Ajouter un blog ');
    }

    function openAddBlogModal() {
        $('#blogForm')[0].reset();
        $('#ID_BLOG').val('');

        $('#previewImage').hide().attr('src', '');

        $('#modalTitle').text('Ajouter un blog');

        $('#blogModal').modal('show');
    }

    function editBlog(id) {
        $.ajax({
            url: "<?= base_url('blogs/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    let d = res.data;

                    $('#ID_BLOG').val(d.ID_BLOG);
                    $('#TITLE').val(d.TITLE);
                    $('#CONTENT').val(d.CONTENT);
                    $('#CATEGORIE_BLOG').val(d.CATEGORIE_BLOG);
                    $('#AUTHOR').val(d.AUTHOR);

                    if (d.IMAGE_BLOG) {
                        $('#previewImage')
                            .attr('src', "<?= base_url('uploads/blogs/') ?>" + d.IMAGE_BLOG)
                            .show();
                    }

                    $('#modalTitle').text('Modifier blog');

                    $('#blogModal').modal('show');
                }
            }
        });
    }
    // DELETE
    function deleteBlog(id) {

        if (!confirm("Supprimer ce blog ?")) return;

        $.ajax({
            url: "<?= base_url('blogs/delete') ?>",
            type: "POST",
            data: {
                ID_BLOG: id
            },

            success: function(res) {
                $('#blogTable').DataTable().ajax.reload();
            }
        });
    }


    // Preview image when selecting file
    $('#IMAGE_BLOG').on('change', function() {

        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        }
    });
    </script>



    <!-- Style supplémentaire pour corriger l'affichage -->
    <style>
    .App-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content-wrapper {
        flex: 1;
        padding-bottom: 20px;
    }

    footer {
        margin-top: auto;
    }

    .table-responsive {
        overflow-x: auto;
    }

    /* Correction pour la hauteur du tableau */
    .dataTables_wrapper {
        overflow: auto;
    }

    /* Footer bien collé en bas */
    .App-wrapper>footer {
        margin-top: auto;
    }
    </style>

</body>

</html>
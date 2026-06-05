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
                    <h1 class="page-title">Liste des a propos</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item"></li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">A propos</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddAboutModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="aboutTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Texte bouton</th>
                                            <th>Lien bouton</th>
                                            <th>Date création</th>
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
        </div>

        <?= view('includes/backend/footer_new') ?>

    </div>

    <div class="modal fade" id="staticAbout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticAboutLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticAboutLabel">
                        <strong id="modal-title">Ajouter un à propos</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="aboutForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_ABOUT" id="ID_ABOUT">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Titre</label>
                                <input type="text" name="TITRE" id="TITRE" class="form-control" placeholder="Titre">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Texte bouton</label>
                                <input type="text" name="TEXTE_BOUTON" id="TEXTE_BOUTON" class="form-control"
                                    placeholder="Lire plus">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="DESCRIPTION" id="DESCRIPTION" rows="5" class="form-control"
                                    placeholder="Description"></textarea>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label class="form-label">Lien bouton</label>
                                <input type="url" name="LIEN_BOUTON" id="LIEN_BOUTON" class="form-control"
                                    placeholder="https://">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="IMAGE" id="IMAGE" class="form-control" accept="image/*">

                                <div class="mt-2">
                                    <img id="previewImage" src=""
                                        style="display:none;width:120px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                                </div>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitAboutForm(event)">
                        <i class="bi bi-save"></i> Enregistrer
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
        loadAboutData()

    });

    // Fonctions pour charger les données
    function loadAboutData() {
        // alert('ok');
        $('#aboutTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [0, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('about/liste') ?>",
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
            ]
        });
    }
    </script>
    <script>
    // SAVE (INSERT + UPDATE)
    function submitAboutForm(e) {

        e.preventDefault();

        let form = $('#aboutForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('about/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#staticAbout').modal('hide');

                    $('#aboutTable').DataTable().ajax.reload();

                    resetAboutForm();
                }
            }
        });
    }

    function resetAboutForm() {

        $('#aboutForm')[0].reset();

        $('#ID_ABOUT').val('');

        $('#previewImage')
            .attr('src', '')
            .hide();

        $('#modal-title').text('Ajouter À propos');
    }

    function openAddAboutModal() {

        resetAboutForm();

        $('#staticAbout').modal('show');
    }

    function editAbout(id) {

        $.ajax({
            url: "<?= base_url('about/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(response) {

                if (response.success) {

                    let data = response.data;

                    $('#ID_ABOUT').val(data.ID_ABOUT);
                    $('#TITRE').val(data.TITRE);
                    $('#DESCRIPTION').val(data.DESCRIPTION);
                    $('#TEXTE_BOUTON').val(data.TEXTE_BOUTON);
                    $('#LIEN_BOUTON').val(data.LIEN_BOUTON);

                    if (data.IMAGE) {

                        $('#previewImage')
                            .attr(
                                'src',
                                '<?= base_url('uploads/about/') ?>' + data.IMAGE
                            )
                            .show();
                    }

                    $('#modal-title').text('Modifier À propos');

                    $('#staticAbout').modal('show');
                }
            }
        });
    }
    // DELETE
    function deleteAbout(id) {

        if (!confirm('Supprimer cet enregistrement ?')) {
            return;
        }

        $.ajax({
            url: "<?= base_url('about/delete') ?>",
            type: "POST",
            data: {
                ID_ABOUT: id
            },

            success: function(res) {

                $('#aboutTable').DataTable().ajax.reload();
            }
        });
    }

    $('#IMAGE').on('change', function() {

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
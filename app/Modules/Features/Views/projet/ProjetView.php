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
                    <h1 class="page-title">Liste des projets</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Projets</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Projets</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddProjetModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="projetTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Images</th>
                                            <th>Date</th>
                                            <th>Actions</th>
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

        <?= view('includes/backend/footer_new') ?>

    </div>

    <div class="modal fade" id="staticProjet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticProjetLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticProjetLabel">
                        <strong id="modal-title">Ajouter un projet</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="" method="post" id="projetForm" name="projetForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_PROJET" id="ID_PROJET">

                        <div class="row">

                            <!-- TITRE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="TITRE" class="form-label"><strong>Titre</strong></label>
                                    <input type="text" name="TITRE" id="TITRE" class="form-control"
                                        placeholder="Saisir le titre du projet">
                                </div>
                            </div>

                            <!-- DATE CREATION (optionnel si géré côté serveur) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="DATE_CREATION" class="form-label"><strong>Date de
                                            création</strong></label>
                                    <input type="datetime-local" name="DATE_CREATION" id="DATE_CREATION"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="DESCRIPTION" class="form-label"><strong>Description</strong></label>
                                    <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control" rows="4"
                                        placeholder="Décrire le projet"></textarea>
                                </div>
                            </div>

                            <!-- IMAGE -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="IMAGE" class="form-label"><strong>Image du projet</strong></label>
                                    <input type="file" name="IMAGE" id="IMAGE" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div>
                                <img id="previewImage" width="100" style="margin-top:10px;">
                            </div>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitProjetForm(event)">
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
        loadCaptageData()

    });

    // Fonctions pour charger les données
    function loadCaptageData() {
        // alert('ok');
        $('#projetTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('projet/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [5], // Action column
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
    function submitProjetForm(e) {
        e.preventDefault();

        let form = $('#projetForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('projet/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {
                alert(res.message);
                $('#staticProjet').modal('hide');
                $('#projetTable').DataTable().ajax.reload();
                $('#projetForm')[0].reset();
            }
        });
    }

    // EDIT
    // function editProjet(id) {

    //     $.ajax({
    //         url: "<?= base_url('projet/edit') ?>",
    //         type: "POST",
    //         data: {
    //             ID_PROJET: id
    //         },
    //         dataType: "json",
    //         success: function(data) {
    //             $('#ID_PROJET').val(data.ID_PROJET);
    //             $('#TITRE').val(data.TITRE);
    //             $('#DESCRIPTION').val(data.DESCRIPTION);
    //             $('#DATE_CREATION').val(data.DATE_CREATION);
    //             $('#modal-title').text("Modifier projet");

    //             $('#staticProjet').modal('show');
    //         }
    //     });
    // }

    function editProjet(id) {

        $.ajax({
            url: "<?= base_url('projet/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",
            success: function(response) {

                if (response.success) {

                    let data = response.data;

                    $('#ID_PROJET').val(data.ID_PROJET);
                    $('#TITRE').val(data.TITRE);
                    $('#DESCRIPTION').val(data.DESCRIPTION);
                    $('#DATE_CREATION').val(data.DATE_CREATION);
                    if (data.IMAGE) {
                        $('#previewImage').attr('src', '<?= base_url('uploads/projets/') ?>' + data.IMAGE);
                    }

                    $('#modal-title').text('Modifier le projet');

                    $('#staticProjet').modal('show');
                } else {
                    alert("Projet introuvable");
                }
            },
            error: function() {
                alert("Erreur serveur");
            }
        });
    }

    // DELETE
    function deleteProjet(id) {
        if (!confirm("Supprimer ce projet ?")) return;

        $.ajax({
            url: "<?= base_url('projet/delete') ?>",
            type: "POST",
            data: {
                ID_PROJET: id
            },
            success: function(res) {
                $('#projetTable').DataTable().ajax.reload();
            }
        });
    }

    // RESET modal title
    $('#staticProjet').on('hidden.bs.modal', function() {
        $('#modal-title').text("Ajouter un projet");
        $('#projetForm')[0].reset();
        $('#ID_PROJET').val('');
    });
    </script>

    <script>
    // Fonction pour afficher les images dans la modale
    function openAddProjetModal() {
        $('#projetForm')[0].reset();
        $('#ID_PROJET').val('');
        $('#modal-title').text('Ajouter un projet');

        $('#staticProjet').modal('show');
    }
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
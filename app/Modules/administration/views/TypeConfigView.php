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
                    <h1 class="page-title">Liste des Type de groupes</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Type de groupes</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Type de groupes</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddTypeModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="typeTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Description</th>
                                                <th>Statut</th>
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
    <div class="modal fade" id="typeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong id="modalTitle">Ajouter une type de groupe</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="typeForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_TYPE_GROUPE" id="ID_TYPE_GROUPE">

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <input type="text" name="DESC_GROUPE" id="DESC_GROUPE" class="form-control">
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" onclick="saveType(event)">
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
        loadTypesData();

    });

    // Fonctions pour charger les données
    function loadTypesData() {
        // alert('ok');
        $('#typeTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [2, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('type-groupe/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [2], // Action column
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
    function saveType(e) {

        e.preventDefault();

        let form = $('#typeForm')[0];

        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('type-groupe/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#typeModal').modal('hide');

                    $('#particulariteTable').DataTable().ajax.reload();

                } else {

                    alert(res.message);

                }
            }
        });
    }

    function resettypeForm() {
        $('#typeForm')[0].reset();
        $('#ID_TYPE_GROUPE').val('');
        $('#previewImage').attr('src', '');
        $('#modalTitle').text('Ajouter un type de groupe');
    }

    function openAddTypeModal() {
        $('#typeForm')[0].reset();
        $('#ID_TYPE_GROUPE').val('');

        $('#previewImage').hide().attr('src', '');

        $('#modalTitle').text('Ajouter un type de groupe');

        $('#typeModal').modal('show');
    }

    function editType(id) {

        $.ajax({

            url: "<?= base_url('type-groupe/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(res) {

                let d = res.data;

                $('#ID_TYPE_GROUPE').val(d.ID_TYPE_GROUPE);
                $('#DESC_GROUPE').val(d.DESC_GROUPE);

                $('#modalTitle').text('Modifier type de groupe');

                $('#typeModal').modal('show');
            }
        });
    }
    // DELETE
    function deleteType(id) {

        if (!confirm('Supprimer cette type de groupes ?')) {
            return;
        }

        $.ajax({

            url: "<?= base_url('type-groupe/delete') ?>",

            type: "POST",

            data: {
                ID_TYPE_GROUPE: id
            },

            success: function() {

                $('#typeTable')
                    .DataTable()
                    .ajax
                    .reload();
            }
        });
    }

    function changeStatus(id, statut) {
        let action = (statut == 1) ? 'activer' : 'désactiver';

        if (confirm('Voulez-vous vraiment ' + action + ' cet impact ?')) {
            $.ajax({
                url: "<?= base_url('type-groupe/changeStatut') ?>",
                type: "POST",
                data: {
                    ID_TYPE_GROUPE: id,
                    STATUT: statut
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#typeTable').DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
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
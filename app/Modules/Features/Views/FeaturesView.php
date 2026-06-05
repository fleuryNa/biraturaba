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
                                <button class="lodge-primary" onclick="openAddFeatureModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="featureTable" class="table table-striped table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Logo</th>
                                            <th>Lien</th>
                                            <th>Statut</th>
                                            <th>Date insertion</th>
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

    <div class="modal fade" id="staticFeature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticFeatureLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticFeatureLabel">
                        <strong id="modal-title">Ajouter une fonctionnalité</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="featureForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_FEATURE" id="ID_FEATURE">

                        <div class="row">

                            <div class="col-md-6">
                                <label><strong>Titre</strong></label>
                                <input type="text" name="TITLE" id="TITLE" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label><strong>Statut</strong></label>
                                <select name="STATUS" id="STATUS" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label><strong>Description</strong></label>
                                <textarea name="DESC_FEATURE" id="DESC_FEATURE" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label><strong>Icon</strong></label>
                                <input type="file" name="ICON_FEATURE" id="ICON_FEATURE" class="form-control"
                                    accept="image/*">
                            </div>

                            <div class="col-md-12">
                                <img id="previewIcon" width="80" style="margin-top:10px;">
                            </div>

                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitFeatureForm(event)">
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
        loadFeaturesData()

    });

    // Fonctions pour charger les données
    function loadFeaturesData() {
        // alert('ok');
        $('#featureTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('features/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [6], // Action column
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
    function submitFeatureForm(e) {
        e.preventDefault();

        let form = $('#featureForm')[0];
        let data = new FormData(form);

        let id = $('#ID_FEATURE').val();

        // Même endpoint pour insert + update
        let url = "<?= base_url('features/store') ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#staticFeature').modal('hide');

                    $('#featureTable').DataTable().ajax.reload();

                    resetFeatureForm();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetFeatureForm() {
        $('#featureForm')[0].reset();
        $('#ID_FEATURE').val('');
        $('#previewIcon').attr('src', '');
        $('#modal-title').text('Ajouter une fonctionnalité');
    }

    function openAddFeatureModal() {
        resetFeatureForm();
        $('#staticFeature').modal('show');
    }

    function editFeature(id) {

        $.ajax({
            url: "<?= base_url('features/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(response) {

                if (response.success) {

                    let data = response.data;

                    $('#ID_FEATURE').val(data.ID_FEATURE);
                    $('#TITLE').val(data.TITLE);
                    $('#DESC_FEATURE').val(data.DESC_FEATURE);
                    $('#STATUS').val(data.STATUS);

                    if (data.ICON_FEATURE) {
                        $('#previewIcon').attr(
                            'src',
                            '<?= base_url('uploads/features/') ?>' + data.ICON_FEATURE
                        );
                    }

                    $('#modal-title').text('Modifier la feature');

                    $('#staticFeature').modal('show');
                }
            }
        });
    }
    // DELETE
    function deleteFeature(id) {

        if (!confirm("Supprimer cette fonctionnalité ?")) return;

        $.ajax({
            url: "<?= base_url('features/delete') ?>",
            type: "POST",
            data: {
                ID_FEATURE: id
            },
            success: function(res) {
                $('#featureTable').DataTable().ajax.reload();
            },
            error: function() {
                alert("Erreur lors de la suppression");
            }
        });
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
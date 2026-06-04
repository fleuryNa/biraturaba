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
                                <button class="lodge-primary" onclick="openAddServiceModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="serviceTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Logo</th>
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

    <div class="modal fade" id="staticService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticServiceLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticServiceLabel">
                        <strong id="modal-title">Ajouter un service</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="serviceForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_SERVICE" id="ID_SERVICE">

                        <div class="row">

                            <!-- NOM -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom du service</label>
                                <input type="text" name="NOM" id="NOM" class="form-control"
                                    placeholder="Ex: Développement Web">
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control" rows="3"
                                    placeholder="Description du service..."></textarea>
                            </div>

                            <!-- ICON UPLOAD -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Icône / Image</label>
                                <input type="file" name="ICONE" id="ICONE" class="form-control" accept="image/*">

                                <!-- Preview -->
                                <div class="mt-2">
                                    <img id="previewIcon" src=""
                                        style="display:none; width:120px; height:120px; object-fit:cover; border-radius:8px; border:1px solid #ddd;">
                                </div>
                            </div>

                            <!-- ID / STATUS OPTIONNEL (si besoin futur) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Statut</label>
                                <select name="STATUT" id="STATUT" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitServiceForm(event)">
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
        loadServicesData()

    });

    // Fonctions pour charger les données
    function loadServicesData() {
        // alert('ok');
        $('#serviceTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('services/liste') ?>",
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
    function submitServiceForm(e) {
        e.preventDefault();

        let form = $('#serviceForm')[0];
        let data = new FormData(form);

        let id = $('#ID_SERVICE').val();

        // Même endpoint pour insert + update
        let url = "<?= base_url('services/store') ?>";

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

                    $('#staticService').modal('hide');

                    $('#serviceTable').DataTable().ajax.reload();

                    resetServiceForm();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetServiceForm() {
        $('#serviceForm')[0].reset();
        $('#ID_SERVICE').val('');
        $('#previewIcon').attr('src', '');
        $('#modal-title').text('Ajouter un service');
    }

    function openAddServiceModal() {
        resetServiceForm();
        $('#staticService').modal('show');
    }

    function editService(id) {

        $.ajax({
            url: "<?= base_url('service/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(response) {

                if (response.success) {

                    let data = response.data;

                    $('#ID_SERVICE').val(data.ID_SERVICE);
                    $('#NOM').val(data.NOM);
                    $('#DESCRIPTION').val(data.DESCRIPTION);

                    if (data.ICONE) {
                        $('#previewIcon').attr(
                            'src',
                            '<?= base_url('uploads/service/') ?>' + data.ICONE
                        );
                    }

                    $('#modal-title').text('Modifier le service');

                    $('#staticService').modal('show');
                }
            }
        });
    }
    // DELETE
    function deleteService(id) {

        if (!confirm("Supprimer ce service ?")) return;

        $.ajax({
            url: "<?= base_url('service/delete') ?>",
            type: "POST",
            data: {
                ID_SERVICE: id
            },

            success: function(res) {
                $('#serviceTable').DataTable().ajax.reload();
            }
        });
    }


    $('#ICONE').on('change', function() {

        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewIcon')
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
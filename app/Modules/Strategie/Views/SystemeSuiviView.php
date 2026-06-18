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
                    <h1 class="page-title">Liste des systèmes de suivi</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Systèmes de suivi</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Systèmes de suivi</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddSystemeSuiviModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="systemeSuiviTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Statut</th>
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
    <div class="modal fade" id="systemeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong id="modalTitle">Ajouter un système de suivi</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="systemeForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID" id="ID">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" name="IMAGE" id="IMAGE" class="form-control">

                                <img id="previewImage" style="width:120px;height:80px;margin-top:10px;display:none;">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="DESCRIPTION" id="DESCRIPTION" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Statut</label>
                                <select name="STATUT" id="STATUT" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" onclick="saveSysteme(event)">
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
        loadSystemeSuiviData();

    });

    // Fonctions pour charger les données
    function loadSystemeSuiviData() {
        // alert('ok');
        $('#systemeSuiviTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('systeme-suivi/liste') ?>",
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
    function saveSysteme(e) {

        e.preventDefault();

        let form = $('#systemeForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('systeme-suivi/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#systemeModal').modal('hide');

                    $('#systemeSuiviTable').DataTable().ajax.reload();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetSystemeSuiviForm() {
        $('#systemeForm')[0].reset();
        $('#ID').val('');
        $('#previewImage').attr('src', '');
        $('#modalTitle').text('Ajouter un système de suivi');
    }

    function openAddSystemeSuiviModal() {
        $('#systemeForm')[0].reset();
        $('#ID').val('');

        $('#previewImage').hide().attr('src', '');

        $('#modalTitle').text('Ajouter un système de suivi');

        $('#systemeModal').modal('show');
    }

    function editSysteme(id) {

        $.ajax({

            url: "<?= base_url('systeme-suivi/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(res) {

                let d = res.data;

                $('#ID').val(d.ID);
                $('#DESCRIPTION').val(d.DESCRIPTION);
                $('#STATUT').val(d.STATUT);

                if (d.IMAGE) {

                    $('#previewImage')
                        .attr(
                            'src',
                            "<?= base_url('uploads/systeme_suivi/') ?>" + d.IMAGE
                        )
                        .show();
                }

                $('#modalTitle').text('Modifier');

                $('#systemeModal').modal('show');
            }
        });
    }
    // DELETE
    function deleteSysteme(id) {

        if (!confirm('Supprimer cet élément ?')) {
            return;
        }

        $.ajax({

            url: "<?= base_url('systeme-suivi/delete') ?>",

            type: "POST",

            data: {
                ID: id
            },

            success: function() {

                $('#systemeSuiviTable')
                    .DataTable()
                    .ajax
                    .reload();
            }
        });
    }

    // Preview image when selecting file
    $('#IMAGE').on('change', function() {

        let file = this.files[0];

        if (!file) return;

        let reader = new FileReader();

        reader.onload = function(e) {

            $('#previewImage')
                .attr('src', e.target.result)
                .show();
        };

        reader.readAsDataURL(file);
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
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
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
                                <button class="lodge-primary" onclick="openAddPartnerModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="partnerTable" class="table table-bordered table-hover">
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
                    <form id="partnerForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_PARTNERS" id="ID_PARTNERS">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><strong>Nom du partenaire</strong></label>
                                    <input type="text" name="NAME" id="NAME" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><strong>Statut</strong></label>
                                    <select name="STATUT" id="STATUT" class="form-control">
                                        <option value="1">Actif</option>
                                        <option value="0">Inactif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label><strong>Lien du partenaire</strong></label>
                                    <input type="url" name="LINK_PARTNER" id="LINK_PARTNER" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label><strong>Logo</strong></label>
                                    <input type="file" name="LOGO" id="LOGO" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <img id="previewLogo" width="100" style="margin-top:10px;">
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitPartnerForm(event)">
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
        $('#partnerTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('partenaire/liste') ?>",
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
    function submitPartnerForm(e) {
        e.preventDefault();

        let form = $('#partnerForm')[0];
        let data = new FormData(form);

        let id = $('#ID_PARTNERS').val();

        let url = (id === "" || id === null) ?
            "<?= base_url('partenaire/store') ?>" // INSERT
            :
            "<?= base_url('partenaire/store') ?>"; // UPDATE (même endpoint)

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {

                alert(res.message);

                $('#staticProjet').modal('hide');

                $('#partnerTable').DataTable().ajax.reload();

                resetPartnerForm();
            }
        });
    }


    function resetPartnerForm() {
        $('#partnerForm')[0].reset();
        $('#ID_PARTNERS').val('');
        $('#previewLogo').attr('src', '');
        $('#modal-title').text('Ajouter un partenaire');
    }

    function openAddPartnerModal() {
        resetPartnerForm();
        $('#staticProjet').modal('show');
    }

    function editPartner(id) {

        $.ajax({
            url: "<?= base_url('partenaire/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",
            success: function(response) {

                if (response.success) {

                    let data = response.data;

                    $('#ID_PARTNERS').val(data.ID_PARTNERS);
                    $('#NAME').val(data.NAME);
                    $('#LINK_PARTNER').val(data.LINK_PARTNER);
                    $('#STATUT').val(data.STATUT);

                    if (data.LOGO) {
                        $('#previewLogo').attr(
                            'src',
                            '<?= base_url('uploads/partners/') ?>' + data.LOGO
                        );
                    }

                    $('#modal-title').text('Modifier un partenaire');

                    $('#staticProjet').modal('show');
                }
            }
        });
    }
    // DELETE
    function deletePartner(id) {

        if (!confirm("Supprimer ce partenaire ?")) return;

        $.ajax({
            url: "<?= base_url('partenaire/delete') ?>",
            type: "POST",
            data: {
                ID_PARTNERS: id
            },
            success: function(res) {
                $('#partnerTable').DataTable().ajax.reload();
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
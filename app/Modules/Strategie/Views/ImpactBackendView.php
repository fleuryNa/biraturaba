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
                    <h1 class="page-title">Liste des Impacts</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Impacts</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Impacts</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddImpactModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="impactTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Bénéficiaires</th>
                                                <th>Femmes</th>
                                                <th>Crédit Groupe</th>
                                                <th>Taux Moyen (%)</th>
                                                <th>Epargne Groupe</th>
                                                <th>Intérêt Crédit</th>
                                                <th>Evolution Capital</th>
                                                <th>Statut</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
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
    <div class="modal fade" id="impactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong id="modalTitle">Ajouter un impact</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="impactForm" enctype="multipart/form-data">

                        <div class="row">

                            <input type="hidden" name="ID_IMPACT" id="ID_IMPACT">

                            <div class="col-md-4 mb-3">
                                <label>Bénéficiaires</label>
                                <input type="number" class="form-control" name="BENEFICIAIRE" id="BENEFICIAIRE">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Bénéficiaires Femmes</label>
                                <input type="number" class="form-control" name="BENEFICIEARE_FEEMME"
                                    id="BENEFICIEARE_FEEMME">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Crédit octroyé groupe</label>
                                <input type="text" class="form-control" name="CREDIT_OCTROYE_GROUP"
                                    id="CREDIT_OCTROYE_GROUP">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Taux moyen (%)</label>
                                <input type="text" step="0.01" class="form-control" name="TAUX_MOYEN" id="TAUX_MOYEN">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Epargne groupe</label>
                                <input type="text" class="form-control" name="EPARGNE_GROUPE" id="EPARGNE_GROUPE">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Intérêt généré crédit</label>
                                <input type="text" class="form-control" name="INTERET_GENERER_CREDIT"
                                    id="INTERET_GENERER_CREDIT">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Evolution capital</label>
                                <input type="text" class="form-control" name="EVOLUTION_CAPITAL" id="EVOLUTION_CAPITAL">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Statut</label>
                                <select class="form-control" name="STATUT" id="STATUT">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="IMAGE_IMPACT" id="IMAGE_IMPACT">
                                <img id="previewImage" style="width:120px;height:80px;margin-top:10px;display:none;">

                            </div>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" onclick="saveImpact(event)">
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
        loadImpactsData();

    });

    // Fonctions pour charger les données
    function loadImpactsData() {
        // alert('ok');
        $('#impactTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('impacts/liste') ?>",
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
    function saveImpact(e) {

        e.preventDefault();

        let form = $('#impactForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('impacts/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                alert(res.message);

                if (res.success) {

                    $('#impactModal').modal('hide');
                    $('#impactTable').DataTable().ajax.reload();

                }
            }
        });
    }

    function resetImpactForm() {
        $('#impactForm')[0].reset();
        $('#ID_IMPACT').val('');
        $('#previewImage').attr('src', '');
        $('#modalTitle').text('Ajouter un impact');
    }

    function openAddImpactModal() {

        $('#impactForm')[0].reset();
        $('#ID_IMPACT').val('');
        $('#previewImage').hide();

        $('#impactModal').modal('show');
    }

    function editImpact(id) {
        $.ajax({
            url: "<?= base_url('impacts/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(res) {
                let d = res.data;

                $('#ID_IMPACT').val(d.ID_IMPACT);
                $('#BENEFICIAIRE').val(d.BENEFICIAIRE);
                $('#BENEFICIEARE_FEEMME').val(d.BENEFICIEARE_FEEMME);
                $('#CREDIT_OCTROYE_GROUP').val(d.CREDIT_OCTROYE_GROUP);
                $('#TAUX_MOYEN').val(d.TAUX_MOYEN);
                $('#EPARGNE_GROUPE').val(d.EPARGNE_GROUPE);
                $('#INTERET_GENERER_CREDIT').val(d.INTERET_GENERER_CREDIT);
                $('#EVOLUTION_CAPITAL').val(d.EVOLUTION_CAPITAL);
                $('#STATUT').val(d.STATUT);

                if (d.IMAGE_IMPACT && d.IMAGE_IMPACT !== '') {

                    $('#previewImage')
                        .attr('src', "<?= base_url('uploads/impact/') ?>" + d.IMAGE_IMPACT)
                        .show();

                } else {

                    $('#previewImage')
                        .attr('src', '')
                        .hide();
                }
                $('#activiteModal').modal('show');
            }
        });
    }
    // DELETE
    function deleteImpact(id) {
        if (!confirm('Supprimer cet impact ?'))
            return;

        $.ajax({
            url: "<?= base_url('impacts/delete') ?>",
            type: "POST",
            data: {
                ID_IMPACT: id
            },

            success: function() {
                $('#activiteTable')
                    .DataTable()
                    .ajax.reload();
            }
        });
    }

    // Preview image when selecting file
    $('#IMAGE_IMPACT').on('change', function() {

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


    function changeStatut(id, statut) {
        let action = (statut == 1) ? 'activer' : 'désactiver';

        if (confirm('Voulez-vous vraiment ' + action + ' cet impact ?')) {
            $.ajax({
                url: "<?= base_url('impacts/changeStatut') ?>",
                type: "POST",
                data: {
                    ID_IMPACT: id,
                    STATUT: statut
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#mytable').DataTable().ajax.reload(null, false);
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
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
                    <h1 class="page-title">Liste des membres de l'équipe</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Équipe</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Membres de l'équipe</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddTeamModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="teamTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Poste</th>
                                            <th>Niveau</th>
                                            <th>Facebook</th>
                                            <th>Twitter</th>
                                            <th>Email</th>
                                            <th>Ordre</th>
                                            <th>Statut</th>
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

    <div class="modal fade" id="staticTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticTeamLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticTeamLabel">
                        <strong id="modal-title">Ajouter un membre de l'équipe</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="teamForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_TEAM" id="ID_TEAM">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nom</label>
                                <input type="text" name="NOM" id="NOM" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Poste</label>
                                <input type="text" name="POSTE" id="POSTE" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Niveau</label>
                                <input type="number" name="NIVEAU" id="NIVEAU" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Ordre d'affichage</label>
                                <input type="number" name="ORDRE" id="ORDRE" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="text" name="FACEBOOK" id="FACEBOOK" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Twitter</label>
                                <input type="text" name="TWITTER" id="TWITTER" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Gmail</label>
                                <input type="email" name="GMAIL" id="GMAIL" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Photo</label>
                                <input type="file" name="PHOTO" id="PHOTO" class="form-control" accept="image/*">

                                <div class="mt-2">
                                    <img id="previewPhoto"
                                        style="display:none;width:120px;height:120px;object-fit:cover;">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Statut</label>
                                <select name="IS_ACTIF" id="IS_ACTIF" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitTeamForm(event)">
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
        loadTeamsData()

    });

    // Fonctions pour charger les données
    function loadTeamsData() {
        // alert('ok');
        $('#teamTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('teams/liste') ?>",
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
    function submitTeamForm(e) {
        e.preventDefault();

        let form = $('#teamForm')[0];
        let data = new FormData(form);

        let id = $('#ID_TEAM').val();

        // Même endpoint pour insert + update
        let url = "<?= base_url('teams/store') ?>";

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

                    $('#staticTeam').modal('hide');

                    $('#teamTable').DataTable().ajax.reload();

                    resetTeamForm();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetTeamForm() {
        $('#teamForm')[0].reset();
        $('#ID_TEAM').val('');
        $('#previewIcon').attr('src', '');
        $('#modal-title').text('Ajouter un membre de l\'équipe');
    }

    function openAddTeamModal() {
        resetTeamForm();
        $('#staticTeam').modal('show');
    }

    function editTeam(id) {
        $.ajax({
            url: "<?= base_url('team/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",

            success: function(response) {
                let data = response.data;

                $('#ID_TEAM').val(data.ID_TEAM);
                $('#NOM').val(data.NOM);
                $('#POSTE').val(data.POSTE);
                $('#NIVEAU').val(data.NIVEAU);
                $('#FACEBOOK').val(data.FACEBOOK);
                $('#TWITTER').val(data.TWITTER);
                $('#GMAIL').val(data.GMAIL);
                $('#ORDRE').val(data.ORDRE);
                $('#IS_ACTIF').val(data.IS_ACTIF);

                if (data.PHOTO) {
                    $('#previewPhoto')
                        .attr('src', '<?= base_url('uploads/team/') ?>' + data.PHOTO)
                        .show();
                }

                $('#staticTeam').modal('show');
            }
        });
    }
    // DELETE
    function deleteTeam(id) {

        if (!confirm("Supprimer ce membre de l'équipe ?")) return;

        $.ajax({
            url: "<?= base_url('team/delete') ?>",
            type: "POST",
            data: {
                ID_TEAM: id
            },

            success: function(res) {
                $('#teamTable').DataTable().ajax.reload();
            }
        });
    }

    $('#PHOTO').on('change', function() {

        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewPhoto')
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
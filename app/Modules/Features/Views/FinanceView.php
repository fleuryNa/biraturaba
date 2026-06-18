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
                    <h1 class="page-title">Gestion des finances</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Finances</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Finances</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddFinanceModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="financeTable" class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Type de financement</th>
                                                <th>Montant</th>
                                                <th>Année</th>
                                                <th>Date d'insertion</th>
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

    <div class="modal fade" id="financeModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong id="modalTitle">Ajouter une finance</strong>
                    </h5>
                </div>

                <div class="modal-body">

                    <form id="financeForm">

                        <input type="hidden" name="ID_FINANCE" id="ID_FINANCE">

                        <div class="mb-3">
                            <label>Type de financement</label>

                            <select class="form-control" name="TYPE_FINANCE_ID" id="TYPE_FINANCE_ID">

                                <option value="">
                                    Sélectionner
                                </option>

                                <?php foreach($types as $type): ?>

                                <option value="<?= $type->TYPE_FINANCE_ID ?>">
                                    <?= $type->DESCRIPTION_TYPE ?>
                                </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Montant</label>

                            <input type="number" class="form-control" name="MONTANT" id="MONTANT">
                        </div>

                        <div class="mb-3">
                            <label>Année</label>

                            <input type="number" class="form-control" name="ANNEE_DE_PRESSION" id="ANNEE_DE_PRESSION">
                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <button class="btn btn-primary" onclick="saveFinance(event)">
                        Enregistrer
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
        loadFinanceData()

    });

    // Fonctions pour charger les données
    function loadFinanceData() {
        // alert('ok');
        $('#financeTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('finances/liste') ?>",
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
    function saveFinance(e) {
        e.preventDefault();

        let form = $('#financeForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('finances/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#financeModal').modal('hide');

                    $('#financeTable').DataTable().ajax.reload();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetFinanceForm() {
        $('#financeForm')[0].reset();
        $('#ID_FINANCE').val('');
        $('#modalTitle').text('Ajouter une finance');
    }

    function openAddFinanceModal() {
        $('#financeForm')[0].reset();
        $('#ID_FINANCE').val('');

        $('#previewImage').hide().attr('src', '');

        $('#modalTitle').text('Ajouter une finance');

        $('#financeModal').modal('show');
    }

    function editFinance(id) {
        $.ajax({

            url: "<?= base_url('finances/getOne/') ?>" + id,

            type: "GET",

            dataType: "json",

            success: function(res) {

                let d = res.data;

                $('#ID_FINANCE').val(d.ID_FINANCE);

                $('#TYPE_FINANCE_ID')
                    .val(d.TYPE_FINANCE_ID);

                $('#MONTANT')
                    .val(d.MONTANT);

                $('#ANNEE_DE_PRESSION')
                    .val(d.ANNEE_DE_PRESSION);

                $('#modalTitle')
                    .text('Modifier finance');

                $('#financeModal')
                    .modal('show');
            }
        });
    }
    // DELETE
    function deleteFinance(id) {

        if (!confirm("Supprimer cette finance ?")) return;

        $.ajax({
            url: "<?= base_url('finances/delete') ?>",
            type: "POST",
            data: {
                ID_FINANCE: id
            },

            success: function(res) {
                $('#financeTable').DataTable().ajax.reload();
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
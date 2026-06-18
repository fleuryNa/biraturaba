<!DOCTYPE html>
<html lang="en">

<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
    <div class="App-wrapper">

        <?= view('includes/backend/sidebarmenu_new') ?>
        <?= view('includes/backend/menu_new') ?>

        <div class="content-wrapper">

            <div class="page-heading">
                <h1 class="page-title"><?= esc($title) ?></h1>
            </div>

            <div class="page-content fade-in-up">
                <div class="ibox">

                    <?= view('App\Modules\Administration\Views\includes\MenuProfil') ?>
                    <div class="ibox-body">
                        <div id="alertBox">
                            <?php if (session()->getFlashdata('message')): ?>
                            <?= session()->getFlashdata('message'); ?>
                            <?php endif; ?>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-modern" id="mytable"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Droit</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Les données seront chargées dynamiquement par DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT -->


            <?= view('includes/backend/footer_new') ?>
        </div>
    </div>

    <!-- SETTINGS / BACKDROPS -->
    <!-- SETTINGS / BACKDROPS -->
    <?= view('includes/backend/settings.php'); ?>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>


    <script>
    $(document).ready(function() {
        liste_search();
    });

    function liste_search() {
        var url = "<?= base_url() ?>administration/profil-droit/listing";
        var row_count = "1000000";
        table = $("#mytable").DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [0, 'desc']
            ],
            "ajax": {
                url: url,
                type: "POST"
            },
            lengthMenu: [
                [5, 10, 50, 100, row_count],
                [5, 10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [],
                "orderable": false
            }],
            dom: 'Bfrtlip',
            buttons: ['copy', 'excel', 'pdf'],
            language: {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ éléments",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                "sInfoEmpty": "Aucun élément",
                "sZeroRecords": "Aucun résultat",
                "sEmptyTable": "Aucune donnée disponible",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Précédent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                }
            }
        });
    }
    </script>

    <script>
    $(document).ready(function() {

        if ($('.alert').length) {

            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });

                // supprimer flashdata côté session
                $.get("<?= base_url('vente/Client/clear_flash')?>");

            }, 4000);

        }

    });
    </script>
</body>

</html>
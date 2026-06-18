<!DOCTYPE html>
<html lang="en">

<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
    <!--begin::App Wrapper-->
    <div class="App-wrapper">

        <?= view('includes/backend/sidebarmenu_new') ?>
        <?= view('includes/backend/menu_new') ?>
        <!-- END SIDEBAR -->

        <div class="content-wrapper">


            <!-- PAGE HEADING (si tu veux le garder aussi) -->
            <div class="page-heading">
                <h1 class="page-title"><?= $title; ?></h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item"><?= $title; ?></li>
                </ol>
            </div>

            <!-- PAGE CONTENT -->
            <div class="page-content fade-in-up">
                <div class="ibox">



                    <?= view('App\Modules\Administration\Views\includes\MenuUser') ?>
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
                                    <th>Nom</th>
                                    <th>Username</th>
                                    <th>Agence</th>
                                    <th>Profil</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
        var url = "<?php echo base_url('administration/user/liste') ?>";
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

</body>

</html>
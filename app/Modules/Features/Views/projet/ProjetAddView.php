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
                    <h1 class="page-title">Membres inscrits</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Projets</li>
                    </ol>
                </div>

                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-body">
                            <h2>Ajouter un projet</h2>

                            <form method="post" enctype="multipart/form-data">

                                <label>Titre</label>
                                <input type="text"
                                name="TITRE"
                                class="form-control">

                                <br>

                                <label>Description</label>
                                <textarea name="DESCRIPTION"
                                class="form-control"></textarea>

                                <br>

                                <label>Image</label>
                                <input type="file"
                                name="IMAGE"
                                class="form-control">

                                <br>

                                <button class="btn btn-success">
                                    Enregistrer
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= view('includes/backend/footer_new') ?>

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
        $(document).ready(function() {
        // Forcer un bon affichage
            $('.content-wrapper').css('min-height', $(window).height() - 100);

            liste_search();
        });

        function liste_search() {
            $("#membresTable").DataTable({
                "order": [[0, 'desc']],
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
                "pageLength": 10,
            "scrollX": true,  // Pour le responsive sur mobile
            "autoWidth": false,
            "columnDefs": [{ 
                "targets": [7],
                "orderable": false 
            }],
            "dom": '<"top"Bf>rt<"bottom"lip>',  // Structure plus propre
            "buttons": ['copy', 'excel', 'pdf'],
            "language": {
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
            },
            "initComplete": function() {
                // Ajuster la hauteur après chargement
                $('.content-wrapper').css('min-height', $(window).height() - 100);
            }
        });
        }

    // Ajuster la hauteur quand la fenêtre est redimensionnée
        $(window).resize(function() {
            $('.content-wrapper').css('min-height', $(window).height() - 100);
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
        .App-wrapper > footer {
            margin-top: auto;
        }
    </style>

</body>
</html>
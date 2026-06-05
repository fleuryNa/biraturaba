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
                        <li class="breadcrumb-item">Membres inscrits</li>
                    </ol>
                </div>

                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="<?= site_url('formexample/create') ?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Ajouter un membre
                                </a>
                                <a href="<?= site_url('formexample/exportCsv') ?>" class="btn btn-info">
                                    <i class="fa fa-file-excel-o"></i> Exporter CSV
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="membresTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Commune</th>
                                            <th>Zone</th>
                                            <th>Colline</th>
                                            <th>Groupes fonctionnels</th>
                                            <th>Membres inscrits</th>
                                            <th>Hommes</th>
                                            <th>Femmes</th>
                                            <th>Type de groupe</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($membres as $m): ?>
                                        <tr>
                                            <td><?= esc($m['COMMUNE_NAME'] ?? '-') ?></td>
                                            <td><?= esc($m['ZONE_NAME'] ?? '-') ?></td>
                                            <td><?= esc($m['COLLINE_NAME'] ?? '-') ?></td>
                                            <td><?= esc($m['NB_GROUPE_FONCTIONNELS'] ?? 0) ?></td>
                                            <td><?= esc($m['NB_MEMBRE_INSCRITS'] ?? 0) ?></td>
                                            <td><?= esc($m['NOMBRE_HOMME'] ?? 0) ?></td>
                                            <td><?= esc($m['NOMBRE_FEMME'] ?? 0) ?></td>
                                            <td>
                                                <?php if (!empty($m['TYPE_GROUPE'])): ?>
                                                    <span class="badge badge-primary"><?= esc($m['TYPE_GROUPE']) ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary">Non défini</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-cog"></i> Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?= site_url('formexample/edit/'.$m['ID_MEMBRES']) ?>">
                                                            <i class="fa fa-edit text-warning"></i> Modifier
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" onclick="confirmDelete(<?= $m['ID_MEMBRES'] ?>, '<?= esc($m['COLLINE_NAME'] ?? 'ce membre') ?>')">
                                                            <i class="fa fa-trash text-danger"></i> Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
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
    <!-- END App-wrapper -->

    <!-- SETTINGS / BACKDROPS -->
    <?= view('includes/backend/settings.php'); ?>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fa fa-exclamation-triangle"></i> Confirmation de suppression
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce membre ?</p>
                    <p><strong id="deleteItemName"></strong></p>
                    <p class="text-danger">Cette action est irréversible !</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i> Annuler
                    </button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.content-wrapper').css('min-height', $(window).height() - 100);
        
        $("#membresTable").DataTable({
            "order": [[0, 'desc']],
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]],
            "pageLength": 10,
            "scrollX": true,
            "autoWidth": false,
            "columnDefs": [{ 
                "targets": [8],
                "orderable": false 
            }],
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
            }
        });
    });

    $(window).resize(function() {
        $('.content-wrapper').css('min-height', $(window).height() - 100);
    });

    // Fonction de confirmation de suppression
    function confirmDelete(id, name) {
        $('#deleteItemName').text(name);
        $('#confirmDeleteBtn').attr('href', '<?= site_url('formexample/delete/') ?>' + id);
        $('#deleteModal').modal('show');
    }
    </script>

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
        .table-responsive {
            overflow-x: auto;
        }
        .badge-primary {
            background-color: #007bff;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }
        .badge-secondary {
            background-color: #6c757d;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }
        .dropdown-menu {
            min-width: 150px;
        }
        .dropdown-menu .dropdown-item i {
            margin-right: 8px;
            width: 16px;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .btn-secondary.dropdown-toggle {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .modal-header.bg-danger {
            background-color: #dc3545 !important;
        }
    </style>

</body>
</html>
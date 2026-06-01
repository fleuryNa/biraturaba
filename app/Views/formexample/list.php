<!doctype html>
<html lang="fr">
<head>
    <?= view('includes/backend/header') ?>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?= view('includes/backend/sidebarmenu') ?>
        <?= view('includes/backend/menu') ?>

        <main class="app-main">
            <div class="container-fluid mt-4">
                <h3>Membres inscrits</h3>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="<?= site_url('formexample/create') ?>" class="btn btn-primary">Nouveau membre</a>
                </div>

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
                                <a href="<?= site_url('formexample/edit/'.$m['ID_MEMBRES']) ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="<?= site_url('formexample/delete/'.$m['ID_MEMBRES']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </main>

        <?= view('includes/backend/footer') ?>
    </div>

    <!-- jQuery d'abord -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#membresTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: 'Exporter CSV'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Exporter Excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exporter PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    title: 'Liste des membres inscrits'
                },
                {
                    extend: 'print',
                    text: 'Imprimer'
                }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
            },
            pageLength: 10
        });
    });
    </script>

    <?= view('includes/backend/script_back') ?>
</body>
</html>
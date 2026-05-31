<?= view('includes/backend/header') ?>

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
            <a href="<?= site_url('formexample/export') ?>" class="btn btn-success">Exporter CSV</a>
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
                    <td><?= esc($m['NB_GROUPE_FONCTIONNELS']) ?></td>
                    <td><?= esc($m['NB_MEMBRE_INSCRITS']) ?></td>
                    <td><?= esc($m['NOMBRE_HOMME']) ?></td>
                    <td><?= esc($m['NOMBRE_FEMME']) ?></td>
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

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#membresTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csvHtml5',
                text: 'Exporter CSV',
                className: 'btn btn-sm btn-outline-secondary'
            },
            {
                extend: 'excelHtml5',
                text: 'Exporter Excel',
                className: 'btn btn-sm btn-outline-secondary'
            },
            {
                extend: 'print',
                text: 'Imprimer',
                className: 'btn btn-sm btn-outline-secondary'
            }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
        },
        pageLength: 10,
        order: [[0, 'asc']]
    });
});
</script>

<?= view('includes/backend/footer') ?>
<?= view('includes/backend/script_back') ?>

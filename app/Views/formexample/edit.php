<?= view('includes/backend/header') ?>

<?= view('includes/backend/sidebarmenu') ?>

<?= view('includes/backend/menu') ?>

<main class="app-main">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Modifier un membre</h3>
            <div>
                <a href="<?= site_url('formexample') ?>" class="btn btn-secondary me-2">Retour à la liste</a>
                <a href="<?= site_url('formexample/create') ?>" class="btn btn-primary">Ajouter un membre</a>
            </div>
        </div>

        <?php $errors = session()->get('errors') ?? [] ?>
        <?= view('formexample/_form', ['action'=>site_url('formexample/update/'.$membre['ID_MEMBRES']), 'buttonText'=>'Modifier','membre'=>$membre,'provinces'=>$provinces,'communes'=>$communes,'zones'=>$zones,'collines'=>$collines,'errors'=>$errors]) ?>
    </div>
</main>

<?= view('includes/backend/footer') ?>
<?= view('includes/backend/script_back') ?>

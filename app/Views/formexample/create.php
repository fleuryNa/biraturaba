<?= view('includes/backend/header') ?>

<?= view('includes/backend/sidebarmenu') ?>

<?= view('includes/backend/menu') ?>

<main class="app-main">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Créer un membre</h3>
            <a href="<?= site_url('formexample') ?>" class="btn btn-secondary">Retour à la liste</a>
        </div>

        <?php $errors = session()->get('errors') ?? [] ?>
        <?= view('formexample/_form', ['action'=>site_url('formexample/store'), 'buttonText'=>'Créer','provinces'=>$provinces,'errors'=>$errors]) ?>
    </div>
</main>

<?= view('includes/backend/footer') ?>
<?= view('includes/backend/script_back') ?>

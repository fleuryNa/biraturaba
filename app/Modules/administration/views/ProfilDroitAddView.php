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

                        <!-- FLASH MESSAGE CI4 -->
                        <?php if (session()->getFlashdata('message')): ?>
                        <?= session()->getFlashdata('message'); ?>
                        <?php endif; ?>

                        <form action="<?= site_url('administration/profil-droit/add') ?>" method="POST">

                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label>Nom du Profil</label>
                                <input class="form-control" type="text" name="DESCRIPTION"
                                    value="<?= old('DESCRIPTION') ?>" placeholder="Nom Profil">

                                <?php if (isset($validation)) : ?>
                                <small class="text-danger">
                                    <?= $validation->getError('DESCRIPTION') ?>
                                </small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Les droits</label>

                                <div class="row">

                                    <?php foreach ($droits as $value): ?>

                                    <div class="col-4 mb-2">

                                        <label class="ui-checkbox">
                                            <input type="checkbox" name="ID_DROIT[]"
                                                value="<?= esc($value['ID_DROIT']) ?>">
                                            <span class="input-span"></span>
                                            <?= esc($value['DESCRIPTION']) ?>
                                        </label>

                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>

                            <button class="btn btn-success btn-block" type="submit">
                                Enregistrer
                            </button>

                        </form>

                    </div>
                </div>
            </div>

            <?= view('includes/backend/footer_new') ?>
        </div>
    </div>

    <?= view('includes/backend/settings.php'); ?>

    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>

</body>

</html>
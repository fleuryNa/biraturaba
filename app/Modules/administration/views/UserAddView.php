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

                    <?= view('App\Modules\Administration\Views\includes\MenuUser') ?>

                    <div class="ibox-body">

                        <form action="<?= site_url('administration/user/add') ?>" method="post">

                            <?= csrf_field() ?>

                            <div class="row">

                                <div class="col-sm-6 form-group">
                                    <label>Nom *</label>
                                    <input class="form-control" type="text" name="NOM" value="<?= old('NOM') ?>">
                                    <small class="text-danger">
                                        <?= $validation->getError('NOM') ?>
                                    </small>
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Prénom *</label>
                                    <input class="form-control" type="text" name="PRENOM" value="<?= old('PRENOM') ?>">
                                    <small class="text-danger">
                                        <?= $validation->getError('PRENOM') ?>
                                    </small>
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>E-mail *</label>
                                    <input class="form-control" type="email" name="USERNAME"
                                        value="<?= old('USERNAME') ?>">
                                    <small class="text-danger">
                                        <?= $validation->getError('USERNAME') ?>
                                    </small>
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label>Password *</label>
                                    <input class="form-control" type="password" name="PASSWORD">
                                    <small class="text-danger">
                                        <?= $validation->getError('PASSWORD') ?>
                                    </small>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Profile *</label>
                                    <select class="form-control" name="PROFIL_ID[]" id="PROFIL_ID" multiple>
                                        <?php foreach ($profil as $p): ?>
                                        <option value="<?= $p['PROFIL_ID'] ?>">
                                            <?= esc($p['DESCRIPTION']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
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

    <?= view('includes/backend/script_back_new') ?>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
    $('#PROFIL_ID').select2({
        placeholder: "Sélectionnez un ou plusieurs profils"
    });
    </script>

    <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        let input = document.querySelector('input[name="PASSWORD"]');

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    });
    </script>

</body>

</html>
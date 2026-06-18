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

                        <form action="<?= site_url('administration/user/update') ?>" method="post">

                            <?= csrf_field() ?>

                            <input type="hidden" name="ID_USER" value="<?= esc($data['ID_USER']) ?>">

                            <div class="row">

                                <!-- NOM -->
                                <div class="col-sm-6 form-group">
                                    <label>Nom *</label>
                                    <input type="text" name="NOM" class="form-control"
                                        value="<?= old('NOM', $data['NOM']) ?>">

                                    <small class="text-danger">
                                        <?= isset($validation) ? $validation->getError('NOM') : '' ?>
                                    </small>
                                </div>

                                <!-- PRENOM -->
                                <div class="col-sm-6 form-group">
                                    <label>Prénom *</label>
                                    <input type="text" name="PRENOM" class="form-control"
                                        value="<?= old('PRENOM', $data['PRENOM']) ?>">

                                    <small class="text-danger">
                                        <?= isset($validation) ? $validation->getError('PRENOM') : '' ?>
                                    </small>
                                </div>

                                <!-- USERNAME -->
                                <div class="col-sm-6 form-group">
                                    <label>E-mail *</label>
                                    <input type="email" name="USERNAME" class="form-control"
                                        value="<?= old('USERNAME', $data['USERNAME']) ?>">

                                    <small class="text-danger">
                                        <?= isset($validation) ? $validation->getError('USERNAME') : '' ?>
                                    </small>
                                </div>

                                <!-- PASSWORD INFO -->
                                <div class="col-sm-6 form-group">
                                    <label>Password</label>
                                    <div class="alert alert-info">
                                        Le mot de passe reste inchangé. L'utilisateur peut le modifier lui-même.
                                    </div>
                                </div>

                                <!-- PROFILS -->
                                <div class="col-lg-6 form-group">
                                    <label>Profil *</label>

                                    <select name="PROFIL_ID[]" id="PROFIL_ID" class="form-control" multiple>

                                        <?php foreach ($profil as $p): ?>
                                        <option value="<?= esc($p['PROFIL_ID']) ?>"
                                            <?= in_array($p['PROFIL_ID'], $profils_user) ? 'selected' : '' ?>>
                                            <?= esc($p['DESCRIPTION']) ?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <!-- AGENCE -->
                                <div class="col-lg-6 form-group">
                                    <label>Agence *</label>

                                    <select name="ID_AGENCE" class="form-control">

                                        <option value="">-- Sélectionner --</option>

                                        <?php foreach ($agence as $a): ?>
                                        <option value="<?= esc($a['ID_AGENCE']) ?>"
                                            <?= $a['ID_AGENCE'] == $data['ID_AGENCE'] ? 'selected' : '' ?>>
                                            <?= esc($a['DESCRIPTION']) ?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                            </div>

                            <button class="btn btn-success btn-block">
                                Mettre à jour
                            </button>

                        </form>

                    </div>
                </div>
            </div>
            =
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


    <!-- SELECT2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(function() {
        $('#PROFIL_ID').select2({
            placeholder: "Sélectionner des profils"
        });
    });
    </script>

</body>

</html>
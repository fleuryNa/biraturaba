<!DOCTYPE html>
<html lang="en">

<?php
echo view('includes/frontend/header');
?>

<body data-spy="scroll" data-offset="80">

    <!-- START PRELOADER -->
    <div class="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!-- END PRELOADER -->

    <!-- START NAVBAR -->
    <?php
    echo view('includes/frontend/navbar');
    ?>
    <!-- END NAVBAR-->

    <!-- START HOME -->
    <section data-stellar-background-ratio="0.3" id="home" class="home_bg" style="background-image:url('<?= base_url('uploads/impact/'.$impacts['IMAGE_IMPACT']) ?>');
    background-size:cover;background-position:center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="hero-text">
                        <h2>Notre Impact</h2>
                        <p>
                            Découvrez les réalisations et les changements positifs apportés par
                            BIRATURABA au sein de la communauté.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END  HOME -->

    <!-- FEATURES -->
    <section class="feature_area">
        <div class="container">
            <div class="row feature_bg">
                <div class="section-title text-center">
                    <h2>Les impacts de BIRATURABA</h2>
                    <p>
                        À travers ses différentes initiatives, BIRATURABA contribue
                        au développement social, économique et communautaire.
                    </p>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/research.png" alt="icon" />
                        <h4><?= $impacts['BENEFICIAIRE']?> dont <?= $impacts['BENEFICIEARE_FEEMME']?> Femmes</h4>
                        <p>Bénéficiaires </p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/brand.png" alt="icon" />
                        <h4><?= $impacts['CREDIT_OCTROYE_GROUP']?></h4>
                        <p>Crédits octroyés par les groupes SILC</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/web.png" alt="icon" />
                        <h4><?= $impacts['TAUX_MOYEN']?></h4>
                        <p>Taux moyens d'accès à au moins 3 repas/jour pour les enfants</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/strategy.png" alt="icon" />
                        <h4><?= $impacts['EPARGNE_GROUPE']?></h4>
                        <p>Epargne constituée par les SILC</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/design.png" alt="icon" />
                        <h4><?= $impacts['INTERET_GENERER_CREDIT']?></h4>
                        <p>Intérêts générés par les crédits des SILC</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.5s" data-wow-offset="0">
                    <div class="single_feature">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/photo.png" alt="icon" />
                        <h4><?= $impacts['EVOLUTION_CAPITAL']?></h4>
                        <p>Evolution du capital investi dans les AGRs</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END FEATURES -->

    <?php echo view('includes/frontend/footer') ?>
</body>

</html>
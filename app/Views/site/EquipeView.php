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


    <!-- START SECTION TOP -->
    <section class="section-top"
        style="background-image: url(public/assetsfront/img/bg/section-top.png);background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                    <div class="section-top-title">
                        <h1>Notre Equipe</h1>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START TEAM MEMBERS -->
    <section id="team" class="team_area section-padding">
        <div class="container">

            <div class="section-title text-center">
                <h2>Équipe brillante</h2>
                <p></p>
            </div>

            <div class="row text-center">

                <!-- <?php foreach ($team as $index => $membre): ?>

                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="<?= 0.1 + ($index * 0.1) ?>s" data-wow-offset="0">

                    <div class="our-team">

                        <div class="single-team">
                            <img src="<?= base_url('uploads/team/' . $membre['PHOTO']) ?>" class="img-fluid"
                                alt="<?= esc($membre['NOM']) ?>" />

                            <h3><?= esc($membre['NOM']) ?></h3>
                            <p><?= esc($membre['POSTE']) ?></p>
                        </div>

                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>

                    </div>
                </div>

                <?php endforeach; ?> -->

                <?php
                    $niveaux = [];

                    foreach ($team as $membre) {
                        $niveaux[$membre['NIVEAU']][] = $membre;
                    }
                    ?>

                <?php foreach ($niveaux as $niveau => $membres): ?>

                <h3 class="text-center mb-4">
                    <?= $niveau==1 ? 'Representant' : 'Membres' ?>
                </h3>

                <div class="row text-center">

                    <?php foreach ($membres as $membre): ?>

                    <div class="col-lg-3 col-sm-6">
                        <div class="our-team">
                            <div class="single-team">
                                <img src="<?= base_url('uploads/team/' . $membre['PHOTO']) ?>" class="img-fluid">
                                <h3><?= esc($membre['NOM']) ?></h3>
                                <p><?= esc($membre['POSTE']) ?></p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- END TEAM MEMBERS -->

    <!-- HIRE US -->

    <!-- END HIRE US -->

    <?php echo view('includes/frontend/footer') ?>
</body>

</html>
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
                        <h1><?= $title?></h1>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- START BLOG -->
    <section class="about_area section-padding">
        <div class="container">

            <?php if (!empty($suivi)): ?>

            <?php foreach ($suivi as $key => $item): ?>

            <div class="row align-items-center mb-5">

                <?php if ($key % 2 == 0): ?>

                <!-- Image à gauche -->
                <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                    <div class="about_img">
                        <img src="<?= base_url('uploads/systeme_suivi/' . $item['IMAGE']) ?>"
                            class="img-fluid rounded shadow" alt="Système de suivi">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
                    <div class="about_content">
                        <p><?= nl2br(esc($item['DESCRIPTION'])) ?></p>
                    </div>
                </div>

                <?php else: ?>

                <!-- Image à droite -->
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
                    <div class="about_content">
                        <p><?= nl2br(esc($item['DESCRIPTION'])) ?></p>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                    <div class="about_img">
                        <img src="<?= base_url('uploads/systeme_suivi/' . $item['IMAGE']) ?>"
                            class="img-fluid rounded shadow" alt="Système de suivi">
                    </div>
                </div>

                <?php endif; ?>

            </div>

            <?php endforeach; ?>

            <?php else: ?>

            <div class="row">
                <div class="col-12 text-center">
                    <p>Aucune information disponible pour le moment.</p>
                </div>
            </div>

            <?php endif; ?>

        </div>
    </section>


    <!-- END BLOG -->
    <?php
	echo view('includes/frontend/footer');
?>
</body>

</html>
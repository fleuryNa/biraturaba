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
    <?php foreach ($objectifs as $key => $objectif): ?>

    <section class="about_area section-padding">
        <div class="container">
            <div class="row align-items-center">

                <?php if ($key % 2 == 0): ?>

                <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                    <div class="about_img">
                        <img src="<?= base_url('uploads/objectifs/' . $objectif['IMAGE']) ?>"
                            class="img-fluid rounded shadow" alt="<?= esc($objectif['TITRE']) ?>">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
                    <div class="about_content">
                        <h3><?= esc($objectif['TITRE']) ?></h3>
                        <p><?= esc($objectif['DESCRIPTION']) ?></p>
                    </div>
                </div>

                <?php else: ?>

                <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
                    <div class="about_content">
                        <h3><?= esc($objectif['TITRE']) ?></h3>
                        <p><?= esc($objectif['DESCRIPTION']) ?></p>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                    <div class="about_img">
                        <img src="<?= base_url('uploads/objectifs/' . $objectif['IMAGE']) ?>"
                            class="img-fluid rounded shadow" alt="<?= esc($objectif['TITRE']) ?>">
                    </div>
                </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php endforeach; ?>
    <!-- END BLOG -->
    <?php
	echo view('includes/frontend/footer');
?>
</body>

</html>
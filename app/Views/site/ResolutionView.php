<!DOCTYPE html>
<html lang="en">

<?php
	echo view('includes/frontend/header');
?>
<?php helper('text'); ?>

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

    <!-- START PORTFOLIO PROJECT -->
    <section class="portfolio_project_area section-padding">
        <div class="container">
            <div class="row">
                <?php 
                
                 $i=01;
                if (!empty($projets)): ?>

                <?php foreach ($projets as $projet): ?>
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_project">
                        <img src="<?= base_url('uploads/projets/' . $projet['IMAGE']) ?>" class="img-fluid"
                            alt="portfolio" />
                        <h1><?= $i++ ?></h1>

                        <h2><?= $projet['TITRE'] ?></h2>
                        <p><?= character_limiter(strip_tags($projet['DESCRIPTION']), 100) ?></p>
                        <a class="btn_one" href="single_project.html">View Project</a>
                    </div>
                </div>

                <?php endforeach; ?>
                <?php endif; ?>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END PORTFOLIO PROJECT -->

    <?php
		echo view('includes/frontend/footer');
	?>
</body>

</html>
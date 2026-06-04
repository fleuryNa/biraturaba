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

    <!-- START PORTFOLIO PROJECT -->
    <section class="portfolio_project_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_project">
                        <img src="<?= base_url()?>public/assetsfront/img/portfolio/1.jpg" class="img-fluid"
                            alt="portfolio" />
                        <h1>01</h1>
                        <h2>Website Design Agency</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry standard dummy text ever since the when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It is a long established fact that a
                            reader.</p>
                        <a class="btn_one" href="single_project.html">View Project</a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_project">
                        <img src="<?= base_url()?>public/assetsfront/img/portfolio/2.jpg" class="img-fluid"
                            alt="portfolio" />
                        <h1>02</h1>
                        <h2>Product Marketing</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry standard dummy text ever since the when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It is a long established fact that a
                            reader.</p>
                        <a class="btn_one" href="single_project.html">View Project</a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_project">
                        <img src="<?= base_url()?>public/assetsfront/img/portfolio/3.jpg" class="img-fluid"
                            alt="portfolio" />
                        <h1>03</h1>
                        <h2>App Development</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry standard dummy text ever since the when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It is a long established fact that a
                            reader.</p>
                        <a class="btn_one" href="single_project.html">View Project</a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="single_project">
                        <img src="<?= base_url()?>public/assetsfront/img/portfolio/4.jpg" class="img-fluid"
                            alt="portfolio" />
                        <h1>04</h1>
                        <h2>Business Strategy</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry standard dummy text ever since the when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It is a long established fact that a
                            reader.</p>
                        <a class="btn_one" href="single_project.html">View Project</a>
                    </div>
                </div>
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
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
                        <h1><?= $title; ?></h1>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

    <!-- SETVICE -->
    <section class="why_choose_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_why_choose">
                        <h2>Notre Vision <br /> <br /> </h2>
                        <p>Un Burundi uni et paisible où chaque acteur comprend et joue pleinement son rôle pour un
                            développement intégral et durable.</p>
                        <a class="btn_one" href="<?= base_url('about') ?>">En savoir plus</a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_why_choose_img">
                        <img src="<?= base_url()?>public/assetsfront/img/valeurintegritehistoire.jpg" class="img-fluid"
                            alt="about-image" />
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SETVICE -->



    <section class="skills_area section-padding"
        style="background-image: url(public/assetsfront/img/competence.jpeg);  background-size:cover;background-position:center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-8 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="skill_bg">
                        <div class="skill_content">
                            <h2>Notre Mission</h2>
                            <p>Promouvoir des mécanismes communautaires de résilience économique, sociale et
                                environnementale au Burundi, notamment à travers le changement positif des mentalités,
                                la lutte contre l’ignorance et l’indifférence ainsi que l’implication et de mieux en
                                synergie des différents acteurs (le pouvoir public, les organisations de la société
                                civile et les titulaires des droits que sont les citoyens)</p>
                        </div>

                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>

    <!-- START PRICING TABLE -->
    <div class="pricing-table-area section-padding"
        style="background-image: url(public/assetsfront/img/bg/pricing-bg.jpg);  background-size:cover;background-position:center;">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="section-title-white">Pricing Plan</h2>
                <p class="section-title-white">It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <div class="price-value">
                                <span class="currency">$</span>
                                <span class="amount">20</span>
                                <span class="duration">/month</span>
                            </div>
                        </div>
                        <div class="pricing-content">
                            <h3 class="title">Business</h3>
                            <ul>
                                <li>PSD to HTML</li>
                                <li>WordPress Theme</li>
                                <li>WordPress Plugin</li>
                                <li>Logo Design</li>
                                <li>WordPress Customization</li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="#">Order Now</a>
                        </div>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <div class="price-value">
                                <span class="currency">$</span>
                                <span class="amount">60</span>
                                <span class="duration">/month</span>
                            </div>
                        </div>
                        <div class="pricing-content">
                            <h3 class="title">Standard</h3>
                            <ul>
                                <li>PSD to HTML</li>
                                <li>WordPress Theme</li>
                                <li>WordPress Plugin</li>
                                <li>Logo Design</li>
                                <li>WordPress Customization</li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="#">Order Now</a>
                        </div>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <div class="price-value">
                                <span class="currency">$</span>
                                <span class="amount">90</span>
                                <span class="duration">/month</span>
                            </div>
                        </div>
                        <div class="pricing-content">
                            <h3 class="title">Professional</h3>
                            <ul>
                                <li>PSD to HTML</li>
                                <li>WordPress Theme</li>
                                <li>WordPress Plugin</li>
                                <li>Logo Design</li>
                                <li>WordPress Customization</li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="#">Order Now</a>
                        </div>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END PRICING TABLE -->

    <!-- START PARTNER LOGO -->

    <!-- END PARTNER LOGO -->

    <?php echo view('includes/frontend/footer') ?>

</body>

</html>
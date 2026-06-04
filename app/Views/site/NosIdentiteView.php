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
    <section class="service_area section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/research.png" alt="icon" />
                        <h4>Email Marketing</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/brand.png" alt="icon" />
                        <h4>Offline SEO</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/web.png" alt="icon" />
                        <h4>Social media marketing</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/strategy.png" alt="icon" />
                        <h4>Lead Generation</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/design.png" alt="icon" />
                        <h4>Web Design</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"
                    data-wow-offset="0">
                    <div class="single_service">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/photo.png" alt="icon" />
                        <h4>Search Engine optimization</h4>
                        <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.</p>
                        <a class="btn_one" href="single_service.html">More Info</a>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SETVICE -->

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
    <div class="partner-logo section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_logo single_logo_bm">
                        <a href="#"><img style="height: 50px;width: 50px;"
                                src="<?= base_url()?>public/assetsfront/img/partner/1.png" alt=""
                                class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_logo">
                        <a href="#"><img src="assetsfront/img/partner/2.png" alt="" class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_logo single_logo_bm">
                        <a href="#"><img src="<?= base_url()?>public/assetsfront/img/partner/3.png" alt=""
                                class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_logo">
                        <a href="#"><img src="assetsfront/img/partner/4.png" alt="" class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.5s" data-wow-offset="0">
                    <div class="single_logo">
                        <a href="#"><img src="<?= base_url()?>public/assetsfront/img/partner/5.png" alt=""
                                class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.6s" data-wow-offset="0">
                    <div class="single_logo">
                        <a href="#"><img src="<?= base_url()?>public/assetsfront/img/partner/6.png" alt=""
                                class="img-fluid" /></a>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END PARTNER LOGO -->

    <?php echo view('includes/frontend/footer') ?>

</body>

</html>
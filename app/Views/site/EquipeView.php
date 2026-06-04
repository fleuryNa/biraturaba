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

    <!-- START TEAM MEMBERS -->
    <section id="team" class="team_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Brilliant team</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout.</p>
            </div>
            <div class="row text-center">
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/1.jpg" class="img-fluid" alt="" />
                            <h3>Gary Hunt</h3>
                            <p>Marketer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/2.jpg" class="img-fluid" alt="" />
                            <h3>Ayoub Fennouni</h3>
                            <p>Manager</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/3.jpg" class="img-fluid" alt="" />
                            <h3>Mark Linomit</h3>
                            <p>Python Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/4.jpg" class="img-fluid" alt="" />
                            <h3>Thompson Luis</h3>
                            <p>Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/5.jpg" class="img-fluid" alt="" />
                            <h3>Gary Hunt</h3>
                            <p>Marketer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/6.jpg" class="img-fluid" alt="" />
                            <h3>Ayoub Fennouni</h3>
                            <p>Manager</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/7.jpg" class="img-fluid" alt="" />
                            <h3>Mark Linomit</h3>
                            <p>Python Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                    data-wow-offset="0">
                    <div class="our-team">
                        <div class="single-team">
                            <img src="<?= base_url()?>public/assetsfront/img/team/8.jpg" class="img-fluid" alt="" />
                            <h3>Thompson Luis</h3>
                            <p>Developer</p>
                        </div>
                        <ul class="social">
                            <li><a href="#" class="ti-facebook facebook"></a></li>
                            <li><a href="#" class="ti-twitter twitter"></a></li>
                            <li><a href="#" class="ti-google google"></a></li>
                        </ul>
                    </div>
                    <!--- END OUR TEAM -->
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END TEAM MEMBERS -->

    <!-- HIRE US -->
    <div class="hire_us_area section-padding">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="hire_img">
                                <img src="<?= base_url()?>public/assetsfront/img/icon/search.png" class="img-fluid"
                                    alt="" />
                            </div>
                        </div><!-- END COL  -->
                        <div class="col-lg-8 col-sm-6 col-xs-12">
                            <div class="hire_content">
                                <h2>Want to work with us?</h2>
                                <p>Sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor sit amet consectetur
                                    elit.</p>
                                <a class="btn_one" href="contact.html">Contact us</a>
                            </div>
                        </div><!-- END COL  -->
                    </div><!-- END ROW -->
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END HIRE US -->


</body>

</html>
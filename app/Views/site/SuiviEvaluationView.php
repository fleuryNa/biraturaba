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
    <section class="blog-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-xs-12">
                    <div class="home_single_blog">
                        <img src="<?= base_url()?>public/assetsfront/img/blog/1.jpg" class="img-fluid"
                            alt="blog-image" />
                        <div class="home_blog_content">
                            <div class="blog_title_info">
                                <h2><a href="blog_single.html">Tiktok Illegally collecting data sharing</a></h2>
                                <span>August 24, 2026</span>
                                <span><a href="blog_single.html">Marketing</a></span>
                            </div>
                            <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.
                            </p>
                            <a class="home_b_btn" href="blog_single.html">Read More</a>
                        </div>
                    </div>
                    <div class="home_single_blog">
                        <img src="<?= base_url()?>public/assetsfront/img/blog/2.jpg" class="img-fluid"
                            alt="blog-image" />
                        <div class="home_blog_content">
                            <div class="blog_title_info">
                                <h2><a href="blog_single.html">How can use our latest news by Monoline</a></h2>
                                <span>August 24, 2026</span>
                                <span><a href="blog_single.html">Design</a></span>
                            </div>
                            <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.
                            </p>
                            <a class="home_b_btn" href="blog_single.html">Read More</a>
                        </div>
                    </div>
                    <div class="home_single_blog">
                        <img src="<?= base_url()?>public/assetsfront/img/blog/3.jpg" class="img-fluid"
                            alt="blog-image" />
                        <div class="home_blog_content">
                            <div class="blog_title_info">
                                <h2><a href="blog_single.html">Convincing reasons you need to learn</a></h2>
                                <span>August 24, 2026</span>
                                <span><a href="blog_single.html">Agency</a></span>
                            </div>
                            <p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur elit.
                            </p>
                            <a class="home_b_btn" href="blog_single.html">Read More</a>
                        </div>
                    </div>
                </div><!-- END COL-->
                <div class="col-lg-4 col-sm-12 col-xs-12">
                    <div class="blog_search">
                        <input type="text" class="form-control" placeholder="Type & Press Enter">
                    </div>
                    <div class="latest_blog wow fadeInRight">
                        <h4 class="blog_sidebar_title">Latest Blog</h4>
                        <div class="single_latest_blog">
                            <a href="#">
                                <h4>Successful analysis can become the key to your business success.</h4>
                            </a>
                        </div>
                        <div class="single_latest_blog">
                            <a href="#">
                                <h4>How a good team can positively influence your business.</h4>
                            </a>
                        </div>
                        <div class="single_latest_blog">
                            <a href="#">
                                <h4>Good partnerships can help your company achieve better results.</h4>
                            </a>
                        </div>
                    </div>
                    <div class="categories">
                        <h4 class="blog_sidebar_title">Categories</h4>
                        <ul>
                            <li><a href="#"><i class="ti-arrow-right"></i> Photography</a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i> Business</a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i> Responsive Design</a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i> Web Design</a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i> Branding</a></li>
                            <li><a href="#"><i class="ti-arrow-right"></i> Marketing</a></li>
                        </ul>
                    </div>
                    <div class="video_post wow fadeInRight">
                        <h4 class="blog_sidebar_title">Video Widget</h4>
                        <iframe src="https://player.vimeo.com/video/62026718"></iframe>
                    </div>
                    <div class="tag">
                        <h4 class="blog_sidebar_title">Tag cloud</h4>
                        <a href="#">Design</a>
                        <a href="#">Development</a>
                        <a href="#">Seo</a>
                        <a href="#">Responsive</a>
                        <a href="#">Photopgraphy</a>
                        <a href="#">How to build</a>
                        <a href="#">All project</a>
                        <a href="#">Clean Design</a>
                    </div>
                    <div class="banner">
                        <a href="#"><img src="<?= base_url()?>public/assetsfront/img/blog/banner_3.jpg"
                                class="img-fluid" alt="" /></a>
                    </div>
                </div>
                <!--- END COL -->
            </div><!-- END ROW-->
        </div><!-- END CONTAINER-->
    </section>
    <!-- END BLOG -->

    <?php
	echo view('includes/frontend/footer');
?>
</body>

</html>
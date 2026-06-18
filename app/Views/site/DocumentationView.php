<!DOCTYPE html>
<html lang="en">

<?php
	echo view('includes/frontend/header');
?>


<style>
.blog-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.blog-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 20px;
}

.blog-content h2 {
    min-height: 60px;
}

.blog-content h2 a {
    display: block;
    word-break: break-word;
    overflow-wrap: break-word;
}

.blog-excerpt {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    /* 3 lignes max */
    -webkit-box-orient: vertical;
    line-height: 1.6;
    min-height: 75px;
}

.blog-btn {
    margin-top: auto;
}
</style>

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
    <!-- END  HOME DESIGN -->

    <!-- BLOG -->

    <section class="blog_area section-padding">
        <div class="container">

            <div class="section-title text-center">
                <h2>Actualités</h2>
                <p>Découvrez nos dernières publications et informations.</p>
            </div>

            <div class="row align-items-stretch">

                <?php foreach ($blogs as $blog): ?>

                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp">

                    <div class="home_single_blog blog-card">

                        <img src="<?= base_url('uploads/blogs/' . $blog['IMAGE_BLOG']) ?>"
                            alt="<?= esc($blog['TITLE']) ?>">

                        <div class="home_blog_content blog-content">

                            <div class="blog_title_info">

                                <h2>
                                    <a href="<?= base_url('blog/detail/' . $blog['ID_BLOG']) ?>">
                                        <?= esc($blog['TITLE']) ?>
                                    </a>
                                </h2>

                                <div class="mb-2">
                                    <span>
                                        <?= date('d/m/Y', strtotime($blog['DATE_INSERTION'])) ?>
                                    </span>
                                    |
                                    <span>
                                        <?= esc($blog['CATEGORIE_BLOG']) ?>
                                    </span>
                                </div>

                            </div>

                            <p class="blog-excerpt">
                                <?= strip_tags($blog['CONTENT']) ?>
                            </p>

                            <a class="home_b_btn blog-btn" href="<?= base_url('blog/detail/' . $blog['ID_BLOG']) ?>">
                                En savoir plus
                            </a>

                        </div>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>
    </section>
    <!-- END BLOG -->
    <?php
				echo view('includes/frontend/footer');
			?>
</body>

</html>
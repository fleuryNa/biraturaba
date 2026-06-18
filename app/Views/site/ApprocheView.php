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
                <div class="col-lg-12">

                    <?php foreach ($activites as $activite): ?>

                    <div class="home_single_blog mb-5">

                        <img src="<?= base_url('uploads/activites/'.$activite['IMAGE']) ?>" class="img-fluid"
                            alt="<?= esc($activite['TITRE']) ?>" />

                        <div class="home_blog_content">

                            <div class="blog_title_info">
                                <h2>
                                    <?= esc($activite['TITRE']) ?>
                                </h2>
                            </div>

                            <div class="blog-text-wrapper">
                                <?= $activite['DESCRIPTION'] ?>
                            </div>

                            <?php if(strlen(strip_tags($activite['DESCRIPTION'])) > 300): ?>
                            <a class="home_b_btn read-more" href="javascript:void(0)">
                                Lire plus
                            </a>
                            <?php endif; ?>

                        </div>

                    </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>
    <!-- END BLOG -->

    <?php
	echo view('includes/frontend/footer');
?>
    <script>
    document.querySelectorAll('.read-more').forEach(function(btn) {
        btn.addEventListener('click', function() {

            let wrapper = this.previousElementSibling;

            if (wrapper.classList.contains('open')) {
                wrapper.classList.remove('open');
                this.innerText = "Lire plus";
            } else {
                wrapper.classList.add('open');
                this.innerText = "Lire moins";
            }
        });
    });
    </script>
    <style>
    .blog-text-wrapper {
        max-height: 120px;
        overflow: hidden;
        transition: max-height 0.6s ease;
    }

    .blog-text-wrapper.open {
        max-height: 2000px;
    }
    </style>
</body>

</html>
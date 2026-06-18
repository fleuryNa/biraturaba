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

    <section class="page-banner" style="padding:80px 0;background:#f8f9fa;">
        <div class="container">
            <h2><?= esc($blog['TITLE']) ?></h2>

            <p class="text-muted">
                Publié le <?= date('d/m/Y', strtotime($blog['DATE_INSERTION'])) ?>
            </p>
        </div>
    </section>

    <section class="blog-details section-padding">
        <div class="container">

            <div class="row">

                <!-- Article -->
                <div class="col-lg-8">

                    <div class="blog-details-content">

                        <?php if (!empty($blog['IMAGE_BLOG'])): ?>
                        <img src="<?= base_url('uploads/blogs/'.$blog['IMAGE_BLOG']) ?>" class="img-fluid mb-4 w-100"
                            alt="<?= esc($blog['TITLE']) ?>">
                        <?php endif; ?>

                        <h2 class="mb-3">
                            <?= esc($blog['TITLE']) ?>
                        </h2>

                        <div class="blog-content">
                            <?= $blog['CONTENT'] ?>
                        </div>

                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5>Articles récents</h5>
                        </div>

                        <div class="card-body">

                            <?php foreach($recentBlogs as $item): ?>

                            <div class="mb-3">

                                <a href="<?= base_url('blog/detail/'.$item['ID_BLOG']) ?>">
                                    <strong><?= esc($item['TITLE']) ?></strong>
                                </a>

                                <br>

                                <small class="text-muted">
                                    <?= date('d/m/Y', strtotime($item['DATE_INSERTION'])) ?>
                                </small>

                            </div>

                            <hr>

                            <?php endforeach; ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <?php
				echo view('includes/frontend/footer');
			?>
</body>

</html>
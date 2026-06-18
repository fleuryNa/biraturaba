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
        style="background-image: url(public/assetsfront/img/bg/histoire.jpeg);background-size:cover; background-position: center center;">
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

<section class="about_area section-padding">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                <div class="about_img">
                    <img src="<?= base_url('public/assetsfront/img/histoire.jpeg') ?>"
                        class="img-fluid rounded shadow"
                        alt="Histoire de Biraturaba">
                </div>
            </div>

            <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
                <div class="about_content">

                    <span class="text-warning fw-bold">
                        Depuis 2002
                    </span>

                    <h2>Notre Histoire</h2>

                    <p>
                        Biraturaba a été créé en 2002 par une équipe de cinq personnes
                        animées par une vision commune : contribuer durablement à
                        l'amélioration des conditions de vie de leur communauté.
                    </p>

                    <p>
                        L'idée est née de l'expérience d'un des fondateurs ayant travaillé
                        plusieurs années dans des ONG internationales. Il avait constaté
                        que de nombreux projets mobilisaient d'importantes ressources
                        financières mais que leurs résultats disparaissaient peu de temps
                        après leur clôture, faute de mécanismes garantissant leur durabilité.
                    </p>

                    <p>
                        Face à cette réalité, plusieurs propositions de changement et
                        d'approches innovantes furent formulées. Cependant, il s'est avéré
                        difficile d'influencer des décisions souvent prises loin des réalités
                        locales et sans la participation effective des communautés concernées.
                    </p>

                    <p>
                        C'est ainsi qu'est née l'idée de créer une organisation locale,
                        dirigée par des acteurs locaux, avec une approche centrée sur les
                        capacités des populations à améliorer elles-mêmes leurs conditions
                        de vie à partir de leurs propres ressources.
                    </p>

                    <p>
                        Le nom <strong>Biraturaba</strong>, qui signifie
                        <em>« Cela nous concerne »</em> en kirundi,
                        reflète parfaitement cette vision. Il exprime la conviction que
                        les solutions durables doivent être initiées par les communautés
                        elles-mêmes, avec responsabilité, engagement et solidarité.
                    </p>

                    <a href="#contact" class="btn_one mt-3">
                        Découvrir nos actions
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>


    <?php echo view('includes/frontend/footer') ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<?php
	echo view('includes/frontend/header');
?>

<style>
.section-title h2,
.section-title p,
.single_marketing h3,
.single_marketing p {
    color: #ffffff !important;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
}

.single_marketing {
    background: rgba(0, 0, 0, 0.45);
    padding: 25px;
    border-radius: 10px;
    backdrop-filter: blur(5px);
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
    <div class="pricing-table-area section-padding valeur-bg"
        style="background-image: url(public/assetsfront/img/valeurimage.jpeg);  background-size:cover;background-position:center;">
        <div class="container">
            <!-- MARKETING LIST -->
            <div class="marketing_list_area section-padding">
                <div class="container">
                    <div class="section-title text-center">
                        <h2>Nos valeurs</h2>
                        <p></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.1s" data-wow-offset="0">
                                    <div class="single_marketing">
                                        <div class="marketing_icon_img">
                                            <img src="<?= base_url('public/assetsfront/img/icon/marketing-1.png')?>"
                                                alt="marketing-icon-image" />
                                        </div>
                                        <h3>Apolitisme</h3>
                                        <p>Les membres et les travailleurs de BIRATURABA sont tenus d’être neutres et
                                            non partisans dans l’exercice de leurs fonctions. Pour cela, ils ne doivent
                                            pas appartenir à des partis politiques et plus spécifiquement : (i) ne pas
                                            participer dans des activités d’un quelconque parti politique ; (ii) ne pas
                                            porter des insignes d’un parti politique et (iii) ne pas faire de propagande
                                            pour ou contre un parti politique.</p>
                                    </div>
                                </div><!-- END COL  -->

                                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.3s" data-wow-offset="0">
                                    <div class="single_marketing">
                                        <div class="marketing_icon_img">
                                            <img src="<?= base_url('public/assetsfront/img/icon/cart.png')?>"
                                                alt="marketing-icon-image" />
                                        </div>
                                        <h3>Transparence</h3>
                                        <p>Dans une optique de transparence et de prise de décision éclairée, nous
                                            communiquons une information de qualité et complète, ce qui suppose qu’elle
                                            est juste, contextuelle, facilement accessible et compréhensible à tous.
                                            Pour cela, chaque membre et chaque employé est tenu de respecter les
                                            procédures organisationnelles et de disponibiliser l’information complète en
                                            rapport avec ses activités (rapport, programmation, budget, etc.).</p>
                                    </div>
                                </div><!-- END COL  -->
                                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.2s" data-wow-offset="0">
                                    <div class="single_marketing">
                                        <div class="marketing_icon_img">
                                            <img src="<?= base_url('public/assetsfront/img/icon/envelope.png')?>"
                                                alt="marketing-icon-image" />
                                        </div>
                                        <h3>Responsabilité</h3>
                                        <p>La latitude que nous offre la gestion axée sur les résultats permet plus
                                            d’initiative, de créativité et d’innovation dans l'exercice de nos fonctions
                                            tout en nous rendant davantage responsables de nos actions et décisions. En
                                            ce sens, nous devons être en mesure de les expliquer et d’en assumer les
                                            conséquences dans un climat de confiance réciproque. La responsabilité
                                            engage chaque membre et employé de Biraturaba, à l’authenticité (véracité
                                            des informations fournies), à la non-complicité (en cas de fraude ou de
                                            mauvaise gestion constatée, chacun est tenu de dénoncer et de ne pas rester
                                            indifférent) et au secret professionnel.</p>
                                    </div>
                                </div><!-- END COL  -->
                                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="0.4s" data-wow-offset="0">
                                    <div class="single_marketing">
                                        <div class="marketing_icon_img">
                                            <img src="<?= base_url('public/assetsfront/img/icon/counter-4.png')?>"
                                                alt="marketing-icon-image" />
                                        </div>
                                        <h3>Respect</h3>
                                        <p>Le respect implique de se soucier de l'impact de nos actes sur autrui, d'être
                                            inclusif et d'accepter les autres pour ce qu'ils sont, même lorsqu'ils sont
                                            différents. Ainsi, les membres et employés de Biraturaba sont tenus d’être
                                            polis les uns envers les autres, envers différents partenaires (y compris
                                            les bénéficiaires) et accepter que chacun soit différent. Pour cela, chacun
                                            est tenu d’être ponctuel (au travail, aux rendez-vous, aux réunions, aux
                                            activités planifiées, etc.), de respecter la parole d’autrui (lors des
                                            conversations, ne pas couper la parole d’autrui) et d’être pleinement
                                            disponible lorsqu’on fait une activité donnée (par exemple, ne pas faire
                                            d’autres activités pendant une réunion, ne pas répondre au téléphone pendant
                                            qu’on échange avec les autres, etc.). </p>
                                    </div>
                                </div><!-- END COL  -->
                            </div>
                        </div>
                    </div><!-- END ROW -->
                </div>
                <!--- END CONTAINER -->
            </div>
            <!-- END MARKETING LIST -->
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
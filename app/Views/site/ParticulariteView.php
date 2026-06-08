<!DOCTYPE html>
<html lang="en">

<?php
	echo view('includes/frontend/header');
?>

<body data-spy="scroll" data-offset="80">


    <!-- START NAVBAR -->
    <?php
		echo view('includes/frontend/navbar');
	?>
    <!-- END NAVBAR-->

    <!-- START HOME -->
    <div id="kenburns_061"
        class="carousel slide ps_indicators_txt_icon ps_control_txt_icon data-bs-target kbrns_zoomInOut thumb_scroll_x swipe_x ps_easeOutQuart"
        data-ride="carousel" data-pause="hover" data-interval="10000" data-duration="2000">
        <!-- Wrapper For Slides -->
        <div class="carousel-inner" role="listbox">
            <!-- First Slide -->
            <div class="carousel-item active">
                <!-- Slide Background -->
                <img src="<?php echo base_url('public/assetsfront/img/bg/1.jpg'); ?>" alt="slider-image" />
                <!-- Left Slide Text Layer -->
                <div class="kenburns_061_slide" data-animation="animated fadeInRight">

                </div><!-- /Left Slide Text Layer -->
            </div><!-- /item -->
            <!-- End of Slide -->
            <!-- Second Slide -->
            <div class="carousel-item">
                <!-- Slide Background -->
                <img src="<?php echo base_url('public/assetsfront/img/bg/2.jpg'); ?>" alt="slider-image" />
                <!-- Right Slide Text Layer -->
                <div class="kenburns_061_slide kenburns_061_slide_right" data-animation="animated fadeInLeft">

                </div><!-- /Right Slide Text Layer -->
            </div><!-- /item -->
            <!-- End of Slide -->
            <!-- Third Slide -->
            <div class="carousel-item">
                <!-- Slide Background -->
                <img src="<?php echo base_url('public/assetsfront/img/bg/3.jpg'); ?>" alt="slider-image" />
                <!-- Center Slide Text Layer -->
                <div class="kenburns_061_slide kenburns_061_slide_center" data-animation="animated fadeInDown">

                </div><!-- /Center Slide Text Layer -->
            </div><!-- /item -->
            <!-- End of Slide -->
        </div><!-- End of Wrapper For Slides -->
        <button class="carousel-control-prev" type="button" data-bs-target="#kenburns_061" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#kenburns_061" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- END  HOME -->

    <!-- FEATURES -->
    <section class="feature_area">
        <div class="container">
            <div class="row feature_bg">
                <div class="section-title text-center">
                    <h2>Notre Particularité</h2>
                    <p></p>
                </div>
                <div class="biraturaba-approche">

                    <ul>
                        <li>
                            Biraturaba utilise une approche stratégique et graduelle, commençant par l’éradication de
                            l’extrême pauvreté et évoluant vers la responsabilité citoyenne :
                            l’autonomie économique des ménages constitue la base pour l’engagement communautaire et
                            civique.
                        </li>

                        <li>
                            L’approche de Biraturaba pour l’éradication de l’extrême pauvreté permet l’autonomisation
                            des pauvres d’une manière très rapide, efficace, efficiente et durable :
                        </li>
                    </ul>

                    <div class="mt-3">
                        <p>
                            En moyenne, les membres des SILC quittent l'extrême pauvreté dans une période d’1 année,
                            et la situation de pauvreté dans une période de moins de 2 ans.
                        </p>

                        <p>
                            Dans la période 2016-2018, pour une personne encadrée, Biraturaba a dépensé 32 $ et lui a
                            permis d’accéder à 116.5 $
                            (39 $ de fonds propres et 77,5 $ de crédits).
                        </p>

                        <p>
                            91% des groupes SILC créés entre 2014-2016 fonctionnent toujours, 3 ans après l’encadrement
                            de Biraturaba.
                        </p>

                        <p>
                            93,3% des Agents Villageois qui accompagnaient les groupes SILC durant la même période
                            continuent à travailler comme des experts locaux
                            et sont payés directement par les groupes qu’ils accompagnent.
                        </p>
                    </div>

                    <ul class="mt-3">
                        <li>
                            Une approche de plaidoyer centrée sur le partenariat :
                            cette approche est basée sur l’analyse des problèmes et la proposition de solutions.
                            Ainsi, on va vers les acteurs concernés (secteur public, secteur privé et société civile)
                            en proposant des solutions aux problèmes identifiés.
                        </li>

                        <li>
                            Cette démarche provoque un sentiment de valorisation chez l’acteur concerné et ouvre un bon
                            environnement de collaboration.
                            De plus, Biraturaba facilite des cadres d’échange entre les différentes parties prenantes
                            afin que chaque acteur puisse contribuer dans un cadre de partenariat constructif.
                        </li>
                    </ul>

                </div>
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END FEATURES -->



</body>

</html>
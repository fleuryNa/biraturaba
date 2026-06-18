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
    <?php helper('text'); ?>
    <!-- START HOME -->

    <section data-stellar-background-ratio="0.3" id="home" class="home_bg" style="background-image: url(<?= base_url('uploads/about/' . $hero['IMAGE']) ?>); 
           background-size: cover; 
           background-position: center center;">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">

                    <div class="hero-text">

                        <h2><?= esc($hero['TITRE']) ?></h2>

                        <p><?= esc($hero['DESCRIPTION']) ?></p>

                        <a
                            href="<?= !empty($hero['LIEN_BOUTON']) ? base_url($hero['LIEN_BOUTON']) : base_url('about') ?>">
                            <?= esc($hero['TEXTE_BOUTON'] ?? 'En savoir plus') ?>
                        </a>

                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- END  HOME -->

    <!-- FEATURES -->
    <section class="feature_area">
        <div class="container">
            <div class="row feature_bg">
                <div class="section-title text-center">
                    <h2>Ce que nous faisons</h2>
                    <p>Biraturaba renforce les capacités des acteurs locaux (communautés, OSC et autorités locales) leur
                        permettant de jouer pleinement leurs rôles et facilite la création des cadres d’échange
                        permettant leur collaboration et leur travail en synergie.</p>
                </div>
                <?php foreach($services as $service): ?>

                <div class="col-lg-4 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_feature">

                        <img src="<?= base_url('uploads/service/'.$service['ICONE']) ?>">

                        <h4><?= $service['NOM'] ?></h4>

                        <p> <?= character_limiter(strip_tags($service['DESCRIPTION']), 100) ?></p>

                    </div>
                </div>

                <?php endforeach ?>

            </div><!-- END COL -->
        </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END FEATURES -->

    <!-- START COUNTER -->
    <section data-stellar-background-ratio="0.3" class="counter_feature section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single-project">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/counter-1.png" alt="icon" />
                        <h2 class="counter-num"><?= $nb_testimonials['TOTAL'] ?></h2>
                        <h4>Temoignages</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single-project">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/counter-2.png" alt="icon" />
                        <h2 class="counter-num"><?= $nb_projets['TOTAL'] ?></h2>
                        <h4>Projects </h4>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single-project">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/counter-3.png" alt="icon" />
                        <h2 class="counter-num"><?= $nb_services['TOTAL'] ?></h2>
                        <h4>Services</h4>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single-project single-project-mrnone">
                        <img src="<?= base_url()?>public/assetsfront/img/icon/counter-4.png" alt="icon" />
                        <h2 class="counter-num"><?= $nb_blogs['TOTAL'] ?></h2>
                        <h4>Blogs</h4>
                    </div>
                </div><!-- END COL -->
            </div>
            <!--- END ROW -->
            <div class="row text-center">
                <div class="col-lg-8 offset-lg-2 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.3s" data-wow-offset="0">


                    <div class="video_btn" style="background-image:url('<?= base_url('uploads/video/'.$video['IMAGE_FOND']) ?>');
           background-size:cover;
           background-position:center;">

                        <a class="video-play" href="<?= esc($video['URL_VIDEO']) ?>">

                            <i class="ti-video-clapper"></i>

                        </a>

                    </div>
                </div>
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END COUNTER-->

    <!-- START WHY CHOOSE US -->
    <section class="why_choose_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_why_choose">
                        <h2>Notre Impact <br /> <br /> </h2>
                        <p>« Nous avions l’habitude de recevoir de l’assistance de la part des organisations
                            humanitaires, et maintenant nous nous sommes substiués à l’Unicef en pourvoyant le matériel
                            scolaire aux enfants vulnérables de notre communauté, grâce aux groupes d’épargne et crédit
                            encadrés par Biraturaba », Adèle IRANKUNDA, Kinama-Bujumbura</p>
                        <a class="btn_one" href="<?= base_url('about') ?>">En savoir plus</a>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0">
                    <div class="single_why_choose_img">
                        <img src="<?= base_url()?>public/assetsfront/img/impact.jpeg" class="img-fluid"
                            alt="about-image" />
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END WHY CHOOSE US-->

    <!-- START PORTFOLIO -->
    <section id="portfolio" class="portfolio_area section-padding">
        <div class="container-fluid">
            <div class="section-title text-center">
                <h2>Nos Projets</h2>
                <p>Biraturaba renforce les capacités des acteurs locaux (communautés, OSC et autorités locales) leur
                    permettant de jouer pleinement leurs rôles et facilite la création des cadres d’échange permettant
                    leur collaboration et leur travail en synergie.</p>
            </div>
            <div class="col-lg-12 text-center">
                <div class="portfolio_filter">
                </div>
            </div>
            <div class="portfolio-grid">
                <div class="row">
                    <div class="portfolio-grid">
                        <div class="row">

                            <?php if (!empty($projets)): ?>
                            <?php foreach ($projets as $projet): ?>

                            <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item">
                                <div class="single-gallery">

                                    <img src="<?= base_url('uploads/projets/' . $projet['IMAGE']) ?>" class="img-fluid"
                                        alt="<?= esc($projet['TITRE']) ?>">

                                    <a href="<?= base_url('uploads/projets/' . $projet['IMAGE']) ?>"
                                        class="gallery_enlarge_icon">
                                        <i class="ti-eye"></i>
                                    </a>

                                    <h4>
                                        <a href="<?= base_url('projet/detail/' . $projet['ID_PROJET']) ?>">
                                            <?= esc($projet['TITRE']) ?>
                                        </a>
                                    </h4>

                                    <p>
                                        <?= character_limiter(strip_tags($projet['DESCRIPTION']), 100) ?>
                                    </p>

                                </div>
                            </div>

                            <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div><!-- END ROW -->
                <div class="col-lg-12 text-center">
                    <div class="portfolio_btn">
                        <a class="btn_one" href="<?= base_url('portfolio') ?>">En savoir plus</a>
                    </div>
                </div><!-- END Col -->
            </div>
        </div>
        <!-- END CONTAINER -->
    </section>
    <!-- END PORTFOLIO -->

    <!-- SKILLS -->
    <section class="skills_area section-padding"
        style="background-image: url(public/assetsfront/img/competence.jpeg);  background-size:cover;background-position:center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-8 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0">
                    <div class="skill_bg">
                        <div class="skill_content">
                            <h2>Notre Particularité</h2>
                            <p>Pour 1$ investit dans les SILC, Biraturaba permet à un bénéficiaire d’accéder à 3.6$
                                (1.2$ de fonds propre et 2.4$ de crédit).</p>
                        </div>
                        <!-- <div class="skill_bar">
                            <div class="progress-bar-linear">
                                <p class="progress-bar-text">SILC
                                    <span>85%</span>
                                </p>
                                <div class="progress-bar">
                                    <span data-percent="85"></span>
                                </div>
                            </div>
                            <div class="progress-bar-linear">
                                <p class="progress-bar-text">Scolaire
                                    <span>70%</span>
                                </p>
                                <div class="progress-bar">
                                    <span data-percent="70"></span>
                                </div>
                            </div>
                            <div class="progress-bar-linear">
                                <p class="progress-bar-text">SGE
                                    <span>60%</span>
                                </p>
                                <div class="progress-bar">
                                    <span data-percent="60"></span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SKILLS -->

    <!-- PROMOTIONAL AREA -->
    <div class="promotional_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="promotional_content">
                        <img src="<?= base_url()?>public/assetsfront/img/promotion.jpeg" class="img-fluid"
                            alt="team-image" />
                        <p>Biraturaba renforce les capacités des acteurs locaux (communautés, OSC et autorités locales)
                            leur permettant de jouer pleinement leurs rôles et facilite la création des cadres d’échange
                            permettant leur collaboration et leur travail en synergie.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END PROMOTIONAL AREA -->

    <!-- TESTIMONIALS -->

    <!-- <div class="testimonial_area section-padding">

        <div class="container">

            <div class="section-title text-center">

                <h2>
                    Temoignages
                </h2>

                <p>
                    Temoignages
                </p>

            </div>

            <div class="row">

                <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">

                    <div class="row">

                        <?php
                        //  print_r($testimonials);
                        
                        foreach($testimonials as $item): ?>

                        <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp">

                            <div class="single_testimonial">

                                <div class="testimonial_img">

                                    <img src="<?= base_url('uploads/testimonials/'.$item['IMAGE_TESTIMONIAL']) ?>"
                                        alt="<?= esc($item['NAME']) ?>">

                                </div>

                                <p>
                                    <?= esc($item['MESSAGE']) ?>
                                </p>

                                <h4>
                                    <?= esc($item['NAME']) ?>
                                </h4>

                                <h5>
                                    <?= esc($item['ROLE']) ?>
                                </h5>

                            </div>

                        </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

    </div> -->
    <!-- END TESTIMONIALS -->

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

    <!-- CONTACT -->
    <div id="contact" class="contact_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="section-title-white">Dites bonjour, commençons quelque chose de nouveau</h2>
                <p class="section-title-white"></p>
            </div>
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-sm-12 col-xs-12 text-center wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="contact">
                        <form id="contact-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                        required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject"
                                        required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea rows="6" name="message" class="form-control"
                                        placeholder="Type your message that on your mind..."
                                        required="required"></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton"
                                        class="contact_btn" title="Submit Your Message!">Envoyer le message</button>

                                    <div id="result"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END CONTACT -->



    <?php echo view('includes/frontend/footer') ?>


    <script>
    $('#contact-form').submit(function(e) {

        e.preventDefault();

        $.ajax({
            url: "<?= base_url('contact/save') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",

            beforeSend: function() {
                $('#submitButton')
                    .prop('disabled', true)
                    .text('Envoi...');
            },

            success: function(response) {

                if (response.status) {

                    $('#result').html(
                        '<div class="alert alert-success">' +
                        response.message +
                        '</div>'
                    );

                    $('#contact-form')[0].reset();
                }
            },

            error: function() {
                $('#result').html(
                    '<div class="alert alert-danger">' +
                    'Erreur lors de l\'envoi' +
                    '</div>'
                );
            },

            complete: function() {
                $('#submitButton')
                    .prop('disabled', false)
                    .text('Send Message');
            }
        });

    });
    </script>
</body>

</html>
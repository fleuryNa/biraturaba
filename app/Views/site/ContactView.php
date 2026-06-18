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

    <!-- START ADDRESS -->
    <section class="address_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12 text-center">
                    <div class="single_address">
                        <h4>Envoyez nous des commentaires</h4>

                        <p><a href="tel:415 256 365">+257 2227181</a></p>
                        <p><a href="mailto:">info@biraturaba.bi</a></p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-12 text-center">
                    <div class="single_address">
                        <h4>Adresse Physique</h4>
                        <p class="mr_20">MUKAZA, ROHERO I <br /> Avenue de l'amitie n°8</p>
                        <!-- <p><a href="tel:415 256 365">+415 256 365</a></p>
                        <p><a href="mailto:">admin@monoline.com</a></p> -->
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END ADDRESS -->

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
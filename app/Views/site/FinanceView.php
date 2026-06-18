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
        style="background-image: url(assetsfront/img/bg/section-top.png);background-size:cover; background-position: center center;">
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

    <!-- START SERVICE MARKETING PAGE -->
    <section class="marketing_area section-padding">
        <div class="container">
            <div class="row">


                <div class="col-md-6">
                    <div id="financeByType"></div>
                </div>

                <div class="col-md-6">
                    <div id="financeByYear"></div>
                </div>


            </div><!-- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </section>
    <!-- END SERVICE MARKETING PAGE -->


    <?php echo view('includes/frontend/footer') ?>

    <script src="<?= base_url('public/assetsfront/highcharts/code/highcharts.js') ?>"></script>

    <script src="<?= base_url('public/assetsfront/highcharts/code/modules/exporting.js') ?>"></script>

    <script src="<?= base_url('public/assetsfront/highcharts/code/modules/export-data.js') ?>"></script>

    <script src="<?= base_url('public/assetsfront/highcharts/code/modules/accessibility.js') ?>"></script>
    <script src="<?= base_url('public/assetsfront/highcharts/code/themes/adaptive.js') ?>"></script>




    <script>
    $(document).ready(function() {
        // Graphique des finances par année
        $.ajax({
            url: 'finance/financeByYear',
            method: 'GET',
            success: function(response) {
                Highcharts.chart('financeByYear', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Finances par Année'
                    },
                    xAxis: {
                        categories: response.categories,
                        title: {
                            text: 'Année de Pression'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Montant Total'
                        }
                    },
                    series: [{
                        name: 'Total',
                        data: response.series
                    }]
                });
            }
        });

        // Graphique des finances par type
        $.ajax({
            url: 'finance/financeByType',
            method: 'GET',
            dataType: 'json',
            success: function(response) {

                Highcharts.chart('financeByType', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Finances par Type'
                    },
                    series: [{
                        name: 'Total',
                        colorByPoint: true,
                        data: response
                    }]
                });

            }
        });
    });
    </script>
</body>

</html>
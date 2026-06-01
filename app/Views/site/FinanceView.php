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
	<section class="section-top" style="background-image: url(assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-center">
					<div class="section-top-title">
						<h1><?= $title; ?></h1>		
					</div>
				</div><!--- END COL -->				  
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->

	<!-- START SERVICE MARKETING PAGE -->
	<section class="marketing_area section-padding">
		<div class="container">				
			<div class="row">					
				<div class="col-lg-5 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="marketing_content">
						<h2>Email Marketing is one of the best way to reach real customer to sale your product easily.</h2>
						<img src="assets/img/marketing.png" class="img-fluid" alt="marketing-image" />
					</div>
				</div><!-- END COL -->		
				<div class="col-lg-7 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="marketing_text">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book. It is a long established fact that a reader. It was popularised in the with the release.</p>
						<p>Ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book. It is a long established fact that a reader. It was popularised in the with the release.</p>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book. It is a long established fact that a reader. It was popularised in the with the release.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book. It is a long established fact that a reader. It was popularised in the with the release.</p>
					</div>
				</div><!-- END COL -->				
			</div><!-- END ROW -->				
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SERVICE MARKETING PAGE -->

	<!-- MARKETING LIST -->
	<div class="marketing_list_area section-padding">
		<div class="container">
			<div class="section-title text-center">
				<h2>marketing solutions for what you need</h2>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
			</div>				
			<div class="row">					
				<div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
							<div class="single_marketing">
								<div class="marketing_icon_img">
									<img src="assets/img/icon/marketing-1.png" alt="marketing-icon-image" />
								</div>
								<h3>Grow your audience</h3>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
							<div class="single_marketing">
								<div class="marketing_icon_img">
									<img src="assets/img/icon/envelope.png" alt="marketing-icon-image" />
								</div>
								<h3>Engage with customers</h3>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_marketing">
								<div class="marketing_icon_img">
									<img src="assets/img/icon/cart.png" alt="marketing-icon-image" />
								</div>
								<h3>Sell your Product</h3>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="single_marketing">
								<div class="marketing_icon_img">
									<img src="assets/img/icon/sales.png" alt="marketing-icon-image" />
								</div>
								<h3>Boost online sales</h3>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
							</div>
						</div><!-- END COL  -->								
					</div>
				</div>
			</div><!-- END ROW -->				
		</div><!--- END CONTAINER -->
	</div>
	<!-- END MARKETING LIST -->
	
	<!-- TESTIMONIALS -->
	<div class="testimonial_area section-padding">
		<div class="container">
			<div class="section-title text-center">
				<h2>From Our client</h2>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
			</div>				
			<div class="row">					
				<div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
							<div class="single_testimonial">
								<div class="testimonial_img">
									<img src="assets/img/testimonial/1.jpg" alt="testimonial-image" />
								</div>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
								<h4>Alex Chohan</h4>
								<h5>Director, Accurate themes</h5>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
							<div class="single_testimonial">
								<div class="testimonial_img">
									<img src="assets/img/testimonial/2.jpg" alt="testimonial-image" />
								</div>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
								<h4>Johnson Brown</h4>
								<h5>Marketing Head, Spyro themes</h5>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_testimonial">
								<div class="testimonial_img">
									<img src="assets/img/testimonial/3.jpg" alt="testimonial-image" />
								</div>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
								<h4>Devid Miller</h4>
								<h5>Founder, theme ocean</h5>
							</div>
						</div><!-- END COL  -->		
						<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="single_testimonial">
								<div class="testimonial_img">
									<img src="assets/img/testimonial/4.jpg" alt="testimonial-image" />
								</div>
								<p>Sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore.</p>
								<h4>Maya Khan</h4>
								<h5>Chairman, Web template</h5>
							</div>
						</div><!-- END COL  -->								
					</div>
				</div>
			</div><!-- END ROW -->				
		</div><!--- END CONTAINER -->
	</div>
	<!-- END TESTIMONIALS -->	
	
	<!-- START PARTNER LOGO -->
	<div class="partner-logo section-padding">
		<div class="container">										
			<div class="row text-center">
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="single_logo single_logo_bm">
						<a href="#"><img src="assets/img/partner/1.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_logo">
						<a href="#"><img src="assets/img/partner/2.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_logo single_logo_bm">
						<a href="#"><img src="assets/img/partner/3.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_logo">
						<a href="#"><img src="assets/img/partner/4.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
					<div class="single_logo">
						<a href="#"><img src="assets/img/partner/5.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
				<div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
					<div class="single_logo">
						<a href="#"><img src="assets/img/partner/6.png" alt="" class="img-fluid"/></a>
					</div>						
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->	
	</div>
	<!-- END PARTNER LOGO -->
	
	<?php echo view('includes/frontend/footer') ?> 
</body>
</html>
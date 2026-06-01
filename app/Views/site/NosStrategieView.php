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
	<section class="section-top" style="background-image: url(public/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-center">
					<div class="section-top-title">
						<h1><?= $title?></h1>		
					</div>
				</div><!--- END COL -->				  
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END SECTION TOP -->		

	<!-- START BLOG -->
	<section class="blog-page section-padding">
		<div class="container">	
			<div class="row">
				<div class="col-lg-8 col-sm-12 col-xs-12">
					<div class="post-slide-blog">
						<div class="blog-img bc_bottom">
							<img src="<?= base_url()?>public/assets/img/blog/1.jpg" class="img-fluid" alt="image" />
						</div>
						<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using is that it has a more-or-less normal distribution of letters, as opposed to using here making it look like readable English. Many desktop publishing packages. <br /><br />
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using is that it has a more-or-less normal distribution of letters, as opposed to using here making it look like readable English. Many desktop publishing packages.</p>
						<p class="bc_left">The point of using is that it has a more-or-less normal distribution of letters, as opposed to using here making it look like readable English.</p>
					</div>
					<div class="author_part">
						<h3 class="blog_head_title">About the author</h3>
						<div class="single_author">
							<img src="<?= base_url()?>public/assets/img/blog/author.jpg" alt="" />
							<h4>Marina Mojo</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies quam nisi, vel gravida enim accumsan id. Praesent justo quam, auctor et lorem in, pulvinar ornare orci.</p> 
						</div>
					</div><!--- END AUTHOR PART -->
					<div class="comments_part">
						<h3 class="blog_head_title">Comments</h3>
						<div class="single_comment">
							<img src="<?= base_url()?>public/assets/img/blog/c1.jpg" alt="" />
							<h4>Ayoub Fennouni</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies quam nisi, vel gravida enim accumsan id. Praesent justo quam, auctor et lorem in, pulvinar ornare orci.</p>
						</div><!--- END SINGLE COMMENT -->
						<div class="single_comment single_comment_mbnone">
							<img src="<?= base_url()?>public/assets/img/blog/c2.jpg" alt="" />
							<h4>Mark Linomi</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies quam nisi, vel gravida enim accumsan id. Praesent justo quam, auctor et lorem in, pulvinar ornare orci.</p>
						</div><!--- END SINGLE COMMENT -->
					</div><!--- END COMMENTS PART -->	
					<div class="comment_form">
						<h3 class="blog_head_title">Add a Comment</h3>
						<div class="contact comment-box">
							<form id="contact-form" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-6">
										<input type="text" name="name" class="form-control" id="first-name" placeholder="Name" required="required">
									</div>
									<div class="form-group col-md-6">
										<input type="email" name="email" class="form-control" id="first-email" placeholder="Email" required="required">
									</div>
									<div class="form-group col-md-12">
										<input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required="required">
									</div>
									<div class="form-group col-md-12">
										<textarea rows="6" name="message" class="form-control" id="description" placeholder="Your Message" required="required"></textarea>
									</div>
									<div class="col-md-12">
										<div class="actions">
											<button type="submit" value="Send message" name="submit" id="submitButton" class="btn btn-lg btn_one" title="Submit Your Message!">Submit Comment</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div><!--- END COMMENT FORM -->						
				</div><!-- END COL-->		
				<div class="col-lg-4 col-sm-12 col-xs-12">
					<div class="blog_search">
						<input type="text" class="form-control" placeholder="Type & Press Enter">
					</div>
					<div class="latest_blog wow fadeInRight">
						<h4 class="blog_sidebar_title">Latest Blog</h4>
						<div class="single_latest_blog">							
							<a href="#"><h4>Successful analysis can become the key to your business success.</h4></a>						
						</div>
						<div class="single_latest_blog">							
							<a href="#"><h4>How a good team can positively influence your business.</h4></a>						
						</div>
						<div class="single_latest_blog">							
							<a href="#"><h4>Good partnerships can help your company achieve better results.</h4></a>						
						</div>
					</div>
					<div class="categories">
						<h4 class="blog_sidebar_title">Categories</h4>
						<ul>
							<li><a href="#"><i class="ti-arrow-right"></i> Photography</a></li>
							<li><a href="#"><i class="ti-arrow-right"></i> Business</a></li>
							<li><a href="#"><i class="ti-arrow-right"></i> Responsive Design</a></li>
							<li><a href="#"><i class="ti-arrow-right"></i> Web Design</a></li>
							<li><a href="#"><i class="ti-arrow-right"></i> Branding</a></li>
							<li><a href="#"><i class="ti-arrow-right"></i> Marketing</a></li>
						</ul>
					</div>					
					<div class="video_post wow fadeInRight">
						<h4 class="blog_sidebar_title">Video Widget</h4>
						<iframe src="https://player.vimeo.com/video/62026718"></iframe>			
					</div>
					<div class="tag">
						<h4 class="blog_sidebar_title">Tag cloud</h4>
						<a href="#">Design</a>
						<a href="#">Development</a>
						<a href="#">Seo</a>
						<a href="#">Responsive</a>
						<a href="#">Photopgraphy</a>
						<a href="#">How to build</a>
						<a href="#">All project</a>
						<a href="#">Clean Design</a>
					</div>
					<div class="banner">
						<a href="#"><img src="<?= base_url()?>public/assets/img/blog/banner_3.jpg" class="img-fluid" alt="" /></a>
					</div>
				</div><!--- END COL -->					
			</div><!-- END ROW-->
		</div><!-- END CONTAINER-->
	</section>
	<!-- END BLOG -->		
<?php
	echo view('includes/frontend/footer');
?>
</body>
</html>
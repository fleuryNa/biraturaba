   <!-- START PARTNER LOGO -->


   <div class="partner-logo section-padding">

       <div class="container">

           <div class="row text-center">

               <?php foreach($partenaires as $p): ?>

               <div class="col-lg-2 col-sm-4 col-xs-12 no-padding wow fadeInUp">

                   <div class="single_logo <?= ($p['ID_PARTNERS'] % 2 == 0) ? 'single_logo_bm' : '' ?>">

                       <a href="<?= esc($p['LINK_PARTNER']) ?>" target="_blank">

                           <img src="<?= base_url('uploads/partners/'.$p['LOGO']) ?>" alt="<?= esc($p['NAME']) ?>"
                               class="img-fluid" />

                       </a>

                   </div>

               </div>

               <?php endforeach; ?>

           </div>

       </div>

   </div>
   <!-- END PARTNER LOGO -->


   <!-- START FOOTER -->
   <div class="footer" style="background-image: url(public/assetsfront/img/bg/footer.png);  background-size:cover;">
       <div class="container">
           <div class="row footer_bg">
               <div class="col-lg-3 col-sm-6 col-xs-12">
                   <div class="footer_logo">
                       <img src="<?= base_url('public/assetsfront/logo/biraturaba.png')?>" alt="" />
                       <p>Biraturaba est une organisation burundaise qui promeut la réalisation des droits citoyens,
                           commençant par l’autonomisation des familles pauvres (droits économiques, sociaux et
                           culturels) et évoluant vers la participation citoyenne et la redevabilité (droits civils et
                           politiques).</p>
                   </div>
                   <div class="social_profile">
                       <ul>
                           <li><a href="#" class="f_facebook"><i class="fa fa-facebook" title="Facebook"></i></a></li>
                           <li><a href="#" class="f_twitter"><i class="fa fa-youtube" title="Twitter"></i></a></li>
                           <li><a href="#" class="f_instagram"><i class="fa fa-instagram" title="Instagram"></i></a>
                           </li>
                           <li><a href="#" class="f_linkedin"><i class="fa fa-linkedin" title="LinkedIn"></i></a></li>
                       </ul>
                   </div>
               </div>
               <!--- END COL -->
               <div class="col-lg-3 col-sm-6 col-xs-12">
                   <div class="single_footer">
                       <h4></h4>
                       <ul>
                           <li><a href="<?= base_url('identite')?>" class="nav-link">Notre identite</a></li>
                           <li><a href="<?= base_url('histoire')?>" class="nav-link">Notre Histoire</a></li>
                           <li><a href="<?= base_url('finance')?>" class="nav-link">Les Finances</a></li>
                           <li><a href="<?= base_url('equipe')?>" class="nav-link">Notre Equipe</a></li>
                           <li><a href="<?= base_url('contact')?>" class="nav-link">Contact</a></li>
                       </ul>
                   </div>
               </div>
               <!--- END COL -->
               <div class="col-lg-3 col-sm-6 col-xs-1">
                   <div class="single_footer">

                       <ul>
                           <li><a href="<?= base_url('solution')?>" class="nav-link">Probleme a resoudre</a></li>
                           <li><a href="<?= base_url('strategie')?>" class="nav-link">Notre strategie</a></li>
                           <li><a href="<?= base_url('approche')?>" class="nav-link">Notre approche</a></li>
                           <li><a href="<?= base_url('suivi')?>" class="nav-link">Notre systeme de
                                   suivi-evaluation</a></li>
                       </ul>
                   </div>
               </div>
               <!--- END COL -->
               <!-- <div class="col-lg-3 col-sm-6 col-xs-12">
                  <div class="newsletter-form">
                      <h4>Subscribe for get updates</h4>
                      <form id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                          <div class="input-group input-group-lg newsletter">
                              <input type="email" name="EMAIL" class="subscribe__input" placeholder="Email Address">
                              <button type="submit" class="subs_btn">Subscribe</button>
                          </div>

                          <div id="mce-responses">
                              <div class="response" id="mce-error-response" style="display:none"></div>
                              <div class="response" id="mce-success-response" style="display:none"></div>
                          </div>
                      </form>
                  </div>
              </div> -->
               <!--- END COL -->
           </div>
           <!--- END ROW -->
           <div class="row">
               <div class="col-lg-12 text-center">
                   <div class="footer_copyright">
                       <p>&copy; 2026 JAG SOLUTIONS. All Rights Reserved by <a href="#" target="_blank">jAG</a></p>
                       <p>Distributed by <a href="#" target="_blank">ThemeWagon</a></p>
                   </div>
               </div>
           </div>
       </div>
       <!--- END CONTAINER -->
   </div>
   <!-- END FOOTER -->

   <!-- Latest jQuery -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery-1.12.4.min.js"></script>
   <!-- Latest compiled and minified Bootstrap -->
   <script src="<?= base_url()?>public/assetsfront/bootstrap/js/bootstrap.min.js"></script>
   <!-- modernizer JS -->
   <script src="<?= base_url()?>public/assetsfront/js/modernizr-2.8.3.min.js"></script>
   <!-- owl-carousel min js  -->
   <script src="<?= base_url()?>public/assetsfront/owlcarousel/js/owl.carousel.min.js"></script>
   <!-- magnific-popup js -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery.magnific-popup.min.js"></script>
   <!-- jquery mixitup js -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery.mixitup.js"></script>
   <!-- jquery appear js -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery.appear.js"></script>
   <!-- countTo js -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery.inview.min.js"></script>
   <!-- stellar js -->
   <script src="<?= base_url()?>public/assetsfront/js/jquery.stellar.min.js"></script>
   <!-- WOW - Reveal Animations When You Scroll -->
   <script src="<?= base_url()?>public/assetsfront/js/wow.min.js"></script>
   <!-- Menu js -->
   <script src="<?= base_url()?>public/assetsfront/js/menu.js"></script>
   <script src="<?= base_url()?>public/assetsfront/js/jquery.sticky.js"></script>
   <!-- form contact js -->
   <script src="<?= base_url()?>public/assetsfront/js/form-contact.js"></script>
   <!-- scrolltopcontrol js -->
   <script src="<?= base_url()?>public/assetsfront/js/scrolltopcontrol.js"></script>
   <!-- scripts js -->
   <script src="<?= base_url()?>public/assetsfront/js/scripts.js"></script>
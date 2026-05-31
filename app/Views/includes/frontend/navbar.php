<div class="site-mobile-menu site-navbar-target">
  <div class="site-mobile-menu-header">
    <div class="site-mobile-menu-close mt-3">
      <span class="icon-close2 js-menu-toggle"></span>
    </div>
  </div>
  <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar js-sticky-header site-navbar-target" role="banner">
  <div class="container">
    <div class="row align-items-center">       
      <div class="col-6 col-xl-2">
        <h1 class="mb-0 site-logo"><a href="index.html"><img src="<?= base_url()?>public/assets/img/logo.png" alt=""></a></h1>
      </div>
      <div class="col-12 col-md-10 d-none d-xl-block">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            <li class="has-children">
              <a href="<?= base_url()?>mono_index/index.html" class="nav-link">A propos de nous</a>
              <ul class="dropdown">
                <li><a href="<?= base_url()?>mono_index/index_two.html" class="nav-link">Notre identite</a></li>
                <li><a href="<?= base_url()?>mono_index/index_three.html" class="nav-link">Notre Histoire</a></li>
                <li><a href="<?= base_url()?>mono_index/index_three.html" class="nav-link">Les Finances</a></li>
                <li><a href="<?= base_url()?>mono_index/index_three.html" class="nav-link">Notre Equipe</a></li>
                <li><a href="<?= base_url()?>mono_index/index_three.html" class="nav-link">Contact</a></li>
                

              </ul>
            </li>   
            <li class="has-children">
              <a href="<?= base_url()?>mono_index/service.html" class="nav-link">Ce que nous faisons</a>
              <ul class="dropdown">
                <li><a href="<?= base_url()?>mono_index/single_service.html" class="nav-link">Probleme a resoudre</a></li>
                <li><a href="<?= base_url()?>mono_index/single_service.html" class="nav-link">Notre strategie</a></li>
                <li><a href="<?= base_url()?>mono_index/single_service.html" class="nav-link">Notre approche</a></li>
                <li><a href="<?= base_url()?>mono_index/single_service.html" class="nav-link">Notre systeme de suivi-evaluation</a></li>
              

              </ul>
            </li>                    
            <li><a class="nav-link" href="<?= base_url()?>mono_index/casestudy.html">Notre impact</a></li>  <li><a class="nav-link" href="contact.html">Notre particularite</a></li>                                
            
            <li><a class="nav-link" href="contact.html">Documentation
            </a></li>  
            <li><a href="<?= base_url('cartograph')?>" class="nav-link">SIG</a></li>                 
          </ul>
        </nav>
      </div>
      <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
       <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>
     </div>
   </div>
 </div>
</header>
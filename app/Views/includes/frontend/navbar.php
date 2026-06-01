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
        <h1 class="mb-0 site-logo"><a href="index.html"><img style="width:65px;height:auto;" src="<?= base_url()?>public/assets/logo/biraturaba.png" alt=""></a></h1>
      </div>
      <div class="col-12 col-md-10 d-none d-xl-block">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            <li class="has-children">
              <a href="<?= base_url()?>" class="nav-link">A propos de nous</a>
              <ul class="dropdown">
                <li><a href="<?= base_url('identite')?>" class="nav-link">Notre identite</a></li>
                <li><a href="<?= base_url('histoire')?>" class="nav-link">Notre Histoire</a></li>
                <li><a href="<?= base_url('finance')?>" class="nav-link">Les Finances</a></li>
                <li><a href="<?= base_url('equipe')?>" class="nav-link">Notre Equipe</a></li>
                <li><a href="<?= base_url('contact')?>" class="nav-link">Contact</a></li>
              </ul>
            </li>   
            <li class="has-children">
              <a href="#" class="nav-link">Ce que nous faisons</a>
              <ul class="dropdown">
                <li><a href="<?= base_url('solution')?>" class="nav-link">Probleme a resoudre</a></li>
                <li><a href="<?= base_url('strategie')?>" class="nav-link">Notre strategie</a></li>
                <li><a href="<?= base_url('approche')?>" class="nav-link">Notre approche</a></li>
                <li><a href="<?= base_url('suivi')?>" class="nav-link">Notre systeme de suivi-evaluation</a></li>
                
              </ul>
            </li>                    
            <li><a class="nav-link" href="<?= base_url('impact')?>">Notre impact</a></li> 

             <li><a class="nav-link" href="<?= base_url('part')?>">Notre particularite</a></li>                                
            
            <li><a class="nav-link" href="<?= base_url('documentation')?>">Documentation
            </a></li>                   
          </ul>
        </nav>
      </div>
      <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
       <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>
     </div>
   </div>
 </div>
</header>
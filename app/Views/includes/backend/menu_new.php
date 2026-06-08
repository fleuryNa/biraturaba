<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="<?= base_url()?>/public/assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">test </div><small>Administrateur</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="<?= base_url()?>Acceuil"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">MODULES</li>

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Admnistration</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?= base_url()?>administration/Profil_Droit">Accès</a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>administration/User">Utilisateurs</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Saisie & donnees</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?= base_url()?>stock_matieres/Fournisseur">Fournisseur</a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>stock_matieres/Type_matieres">Type Matieres</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Site</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?= base_url('formexample')?>">Membres</a>
                    </li>
                    <li>
                        <a href="<?= base_url('projet')?>">Projets</a>
                    </li>
                    <li>
                        <a href="<?= base_url('partenaire')?>">Partenaires</a>
                    </li>

                    <li>
                        <a href="<?= base_url('features')?>">Caracteristiques</a>
                    </li>

                    <li>
                        <a href="<?= base_url('services')?>">Services</a>
                    </li>

                    <li>
                        <a href="<?= base_url('testimonials')?>">Témoignages</a>
                    </li>
                    <li>
                        <a href="<?= base_url('contacts')?>">Messages de contact</a>
                    </li>
                    <li>
                        <a href="<?= base_url('blogs')?>">Blogs</a>
                    </li>
                    <li>
                        <a href="<?= base_url('videos')?>">Vidéos</a>
                    </li>

                    <li>
                        <a href="<?= base_url('about')?>">À propos</a>
                    </li>

                    <li>
                        <a href="<?= base_url('team')?>">Équipe</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="<?= base_url()?>/public/assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">
                    <?= session()->get('SUPERBAT_NOM') . ' ' . session()->get('SUPERBAT_PRENOM') ?>
                </div>
                <small>Utilisateur</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <!-- <a class="active" href="<?= base_url()?>Acceuil"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a> -->
            </li>
            <!-- ADMINISTRATION -->
            <?php if (has_droit(1) || has_droit(2)): ?>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span>Administration</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>

                <ul class="nav-2-level collapse">

                    <?php if (has_droit(1)): ?>
                    <li>
                        <a href="<?= base_url('administration/profil-droit') ?>">
                            Accès
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (has_droit(2)): ?>
                    <li>
                        <a href="<?= base_url('administration/user') ?>">
                            Utilisateurs
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </li>
            <?php endif; ?>
            <?php if (has_droit(3)): ?>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Cartes</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?= base_url('formexample')?>">Membres</a>
                    </li>

                </ul>
            </li>
            <?php endif; ?>

            <?php if (has_droit(10)): ?>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Site</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

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

                    <li>
                        <a href="<?= base_url('finances')?>">Finance</a>
                    </li>

                    <li>
                        <a href="<?= base_url('objectifs')?>">Strategie</a>
                    </li>
                    <li>
                        <a href="<?= base_url('activites')?>">Approches</a>
                    </li>
                    <li>
                        <a href="<?= base_url('systeme-suivi')?>">Système de suivi</a>
                    </li>

                    <li>
                        <a href="<?= base_url('impacts')?>">Impact</a>
                    </li>


                    <li>
                        <a href="<?= base_url('particularites')?>">Particularités</a>
                    </li>



                </ul>
            </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>
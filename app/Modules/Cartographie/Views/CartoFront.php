<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Biraturaba - Cartographie">
    <meta name="keywords" content="cartographie, burundi, intervention">
    <title>Biraturaba - Cartographie</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/assetsfront/logo/favicon.ico') ?>">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/bootstrap/css/bootstrap.min.css') ?>">
    
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/fonts/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/fonts/themify-icons.css') ?>">
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/owlcarousel/css/owl.carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/owlcarousel/css/owl.theme.css') ?>">
    
    <!-- Other CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/fonts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/menu.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assetsfront/css/responsive.css') ?>">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        color: #555;
        line-height: 1.6;
    }
    
    /* Harmonisation avec welcome_message.php */
    h1, h2, h3, h4, h5, h6 {
        color: #1a1a2e;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
    }
    
    .container-fluid {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .section-title h2 {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 32px;
        margin-bottom: 15px;
    }
    
    .section-title p {
        color: #555;
        font-size: 16px;
    }
    
    /* Layout en grille : 8 colonnes pour la carte, 4 pour la légende */
    .map-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .map-col {
        flex: 0 0 66.666%;
        width: 66.666%;
    }
    
    .legend-col {
        flex: 0 0 33.333%;
        width: 33.333%;
    }
    
    #map {
        width: 100%;
        height: 100vh;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    /* Panneau de légende stylisé */
    .legend-panel {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .legend-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: white;
        padding: 18px 20px;
    }
    
    .legend-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        color: white !important;
    }
    
    .legend-header h3:before {
        content: "📋";
        font-size: 20px;
    }
    
    .legend-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }
    
    /* Liste des groupes */
    .groups-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .group-card {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 15px;
        transition: all 0.3s ease;
        border-left: 4px solid;
        cursor: pointer;
    }
    
    .group-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .group-card.group1 { border-left-color: #FF0000; }
    .group-card.group2 { border-left-color: #00FF00; }
    .group-card.group3 { border-left-color: #0000FF; }
    .group-card.group4 { border-left-color: #800080; }
    
    .group-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    
    .group-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }
    
    .group-icon.group1 { background: linear-gradient(135deg, #FF0000, #CC0000); }
    .group-icon.group2 { background: linear-gradient(135deg, #00FF00, #00CC00); }
    .group-icon.group3 { background: linear-gradient(135deg, #0000FF, #0000CC); }
    .group-icon.group4 { background: linear-gradient(135deg, #800080, #660066); }
    
    .group-info {
        flex: 1;
    }
    
    .group-name {
        font-weight: 700;
        font-size: 16px;
        color: #1a1a2e !important;
    }
    
    .group-count {
        font-size: 12px;
        color: #666;
        margin-top: 2px;
    }
    
    .group-stats {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #e0e0e0;
    }
    
    .stat-badge {
        text-align: center;
        flex: 1;
    }
    
    .stat-number {
        font-size: 20px;
        font-weight: 700;
        display: block;
    }
    
    .stat-label {
        font-size: 10px;
        color: #888;
        text-transform: uppercase;
    }
    
    .stat-number.group1 { color: #FF0000; }
    .stat-number.group2 { color: #00CC00; }
    .stat-number.group3 { color: #0000FF; }
    .stat-number.group4 { color: #800080; }
    
    /* Liste des points */
    .points-section {
        margin-top: 20px;
    }
    
    .points-title {
        font-weight: 600;
        font-size: 14px;
        color: #1a1a2e;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .points-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .point-item {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        border-left: 3px solid;
    }
    
    .point-item:hover {
        transform: translateX(3px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .point-item.group1 { border-left-color: #FF0000; }
    .point-item.group2 { border-left-color: #00FF00; }
    .point-item.group3 { border-left-color: #0000FF; }
    .point-item.group4 { border-left-color: #800080; }
    
    .point-name {
        font-weight: 600;
        font-size: 13px;
        color: #1a1a2e;
    }
    
    .point-coord {
        font-size: 10px;
        color: #999;
        margin-top: 3px;
    }
    
    /* Légende des clusters */
    .cluster-legend {
        background: #f0f2f5;
        border-radius: 12px;
        padding: 15px;
        margin-top: 20px;
    }
    
    .cluster-legend h4 {
        font-size: 13px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
    }
    
    .cluster-items {
        display: flex;
        gap: 15px;
        justify-content: space-around;
    }
    
    .cluster-demo {
        text-align: center;
    }
    
    .cluster-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin: 0 auto 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 12px;
    }
    
    .cluster-circle.small { background: linear-gradient(135deg, #FF6B6B, #EE5A5A); width: 32px; height: 32px; }
    .cluster-circle.medium { background: linear-gradient(135deg, #FF8E53, #FF6B6B); width: 42px; height: 42px; font-size: 14px; }
    .cluster-circle.large { background: linear-gradient(135deg, #F7971E, #FFD200); width: 52px; height: 52px; font-size: 16px; }
    
    .cluster-label {
        font-size: 10px;
        color: #666;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .map-col, .legend-col {
            flex: 0 0 100%;
            width: 100%;
        }
        
        .legend-panel {
            height: auto;
            margin-top: 20px;
        }
        
        #map {
            height: 50vh;
        }
    }
    
    /* Scrollbar personnalisée */
    .legend-body::-webkit-scrollbar,
    .points-list::-webkit-scrollbar {
        width: 5px;
    }
    
    .legend-body::-webkit-scrollbar-track,
    .points-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .legend-body::-webkit-scrollbar-thumb,
    .points-list::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    
    /* Total stats - harmonisé avec welcome_message */
    .total-stats {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 15px;
        border-radius: 12px;
        color: white;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .total-stats .big-number {
        font-size: 28px;
        font-weight: 700;
        color: white;
    }
    
    .total-stats div {
        color: white;
    }
    
    /* Boutons style welcome_message */
    .btn_one, .contact_btn, .home_b_btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }
    
    .btn_one:hover, .contact_btn:hover, .home_b_btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
    }
    
    /* Liens */
    a {
        color: #667eea;
        transition: color 0.3s ease;
        text-decoration: none;
    }
    
    a:hover {
        color: #764ba2;
        text-decoration: none;
    }
    
    /* Preloader */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .spinner {
        width: 60px;
        height: 60px;
        position: relative;
    }
    
    .double-bounce1, .double-bounce2 {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }
    
    .double-bounce2 {
        animation-delay: -1.0s;
    }
    
    @keyframes sk-bounce {
        0%, 100% { transform: scale(0.0); }
        50% { transform: scale(1.0); }
    }
</style>
    
    <style>
    /* ======================================== */
    /* HARMONISATION AVEC WELCOME_MESSAGE.PHP   */
    /* ======================================== */
    
    /* Corps de page */
    body {
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        color: #555 !important;
        line-height: 1.6 !important;
    }
    
    /* Titres */
    h1, h2, h3, h4, h5, h6,
    .section-title h2,
    .legend-header h3,
    .group-name,
    .points-title,
    .point-name,
    .cluster-legend h4 {
        color: #1a1a2e !important;
        font-weight: 700 !important;
        font-family: 'Poppins', sans-serif !important;
    }
    
    /* Texte des descriptions */
    p, .group-count, .stat-label, .point-coord, .cluster-label {
        color: #555 !important;
    }
    
    /* Section title comme dans welcome */
    .section-title h2 {
        font-size: 32px !important;
        margin-bottom: 15px !important;
    }
    
    .section-title p {
        color: #555 !important;
        font-size: 16px !important;
    }
    
    /* Cards et groupes */
    .group-card, .point-item, .legend-panel {
        background: #f8f9fa !important;
    }
    
    /* Total stats - dégradé violet comme dans welcome */
    .total-stats {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    
    .total-stats .big-number,
    .total-stats div {
        color: white !important;
    }
    
    /* Boutons style welcome */
    .btn_one, .contact_btn, .home_b_btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        border: none !important;
        color: white !important;
        padding: 10px 25px !important;
        border-radius: 30px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
    }
    
    .btn_one:hover, .contact_btn:hover, .home_b_btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
        transform: translateY(-2px) !important;
    }
    
    /* Liens */
    a, .point-item a {
        color: #667eea !important;
        transition: color 0.3s ease !important;
    }
    
    a:hover, .point-item a:hover {
        color: #764ba2 !important;
    }
    
    /* Statistiques */
    .stat-number {
        font-weight: 700 !important;
    }
    
    /* Header de la légende */
    .legend-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e) !important;
    }
    
    .legend-header h3 {
        color: white !important;
    }
    
    /* Preloader avec les couleurs welcome */
    .preloader .spinner .double-bounce1,
    .preloader .spinner .double-bounce2 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    
    /* Clusters avec les couleurs welcome */
    .cluster-circle.small { background: linear-gradient(135deg, #FF6B6B, #EE5A5A) !important; }
    .cluster-circle.medium { background: linear-gradient(135deg, #FF8E53, #FF6B6B) !important; }
    .cluster-circle.large { background: linear-gradient(135deg, #F7971E, #FFD200) !important; }
    
    /* Groupes - conservation des couleurs spécifiques */
    .group-card.group1 { border-left-color: #FF0000 !important; }
    .group-card.group2 { border-left-color: #00FF00 !important; }
    .group-card.group3 { border-left-color: #0000FF !important; }
    .group-card.group4 { border-left-color: #800080 !important; }
    
    .stat-number.group1 { color: #FF0000 !important; }
    .stat-number.group2 { color: #00CC00 !important; }
    .stat-number.group3 { color: #0000FF !important; }
    .stat-number.group4 { color: #800080 !important; }
    
    /* Responsive */
    @media (max-width: 768px) {
        .map-col, .legend-col {
            flex: 0 0 100% !important;
            width: 100% !important;
        }
        
        .legend-panel {
            height: auto !important;
            margin-top: 20px !important;
        }
        
        #map {
            height: 50vh !important;
        }
    }
    
    /* Scrollbar */
    .legend-body::-webkit-scrollbar,
    .points-list::-webkit-scrollbar {
        width: 5px !important;
    }
    
    .legend-body::-webkit-scrollbar-track,
    .points-list::-webkit-scrollbar-track {
        background: #f1f1f1 !important;
        border-radius: 10px !important;
    }
    
    .legend-body::-webkit-scrollbar-thumb,
    .points-list::-webkit-scrollbar-thumb {
        background: #ccc !important;
        border-radius: 10px !important;
    }

    .filter-group {
    margin-bottom: 12px;
}
.filter-group label {
    display: block;
    font-size: 11px;
    font-weight: bold;
    margin-bottom: 4px;
    color: #555;
}
.filter-group select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 12px;
    background: white;
    cursor: pointer;
}
.filter-group select:disabled {
    background: #e9ecef;
    cursor: not-allowed;
    opacity: 0.7;
}
</style>
</head>

<body data-spy="scroll" data-offset="80">

    <!-- START PRELOADER -->
    <div class="preloader" id="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!-- END PRELOADER -->

    <!-- START NAVBAR -->
    <?php echo view('includes/frontend/navbar'); ?>
    <!-- END NAVBAR-->

    <!-- START SECTION TOP -->
    <section class="section-top" style="background-image: url('<?= base_url('public/assetsfront/img/bg/section-top.png') ?>'); background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                    <div class="section-top-title">
                        <h1>CARTOGRAPHIE</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION TOP -->

    <!-- START CASE STUDY TOP CONTENT -->
    <section class="case_content_top_area section-padding">
        <div class="container">
            <div class="map-container">
                <div class="map-col">
                    <div id="map"></div>
                </div>
                
                <div class="legend-col">
                    <div class="legend-panel">
                        <div class="legend-header">
                            <h3>Tableau de bord</h3>
                        </div>
                        <div class="legend-body">
                            <div class="total-stats">
                                <div class="big-number" id="totalPointsDisplay">0</div>
                                <div>Points d'intervention</div>
                                <div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">🏥 🏫 🏛️ 🏟️</div>
                            </div>

                            <div class="filter-box">
    <h4>🔍 Filtres hiérarchiques</h4>
    
    <!-- Filtre Province -->
    <div class="filter-group">
        <label>🏢 Province</label>
        <select id="filterProvince">
            <option value="all">Toutes les provinces</option>
        </select>
    </div>
    
    <!-- Filtre Commune -->
    <div class="filter-group">
        <label>🏛️ Commune</label>
        <select id="filterCommune" disabled>
            <option value="all">Toutes les communes</option>
        </select>
    </div>
    
    <!-- Filtre Zone -->
    <div class="filter-group">
        <label>📍 Zone</label>
        <select id="filterZone" disabled>
            <option value="all">Toutes les zones</option>
        </select>
    </div>
    
    <!-- Filtre Colline -->
    <div class="filter-group">
        <label>🏥 Colline (Site)</label>
        <select id="filterColline" disabled>
            <option value="all">Toutes les collines</option>
        </select>
    </div>
    
    <button id="resetFilters">🔄 Réinitialiser</button>
</div>
                            
                            <div class="groups-list" id="groupsList">
                                <div style="text-align: center; color: #999; padding: 20px;">Chargement des groupes...</div>
                            </div>
                            
                            <div class="points-section">
                                <div class="points-title"><span>📍</span> Points récents</div>
                                <div class="points-list" id="pointsList">
                                    <div style="text-align: center; color: #999; padding: 20px;">Chargement...</div>
                                </div>
                            </div>
                            
                            <!-- <div class="cluster-legend">
                                <h4>📊 Zones regroupées (Clusters)</h4> -->
                                <!-- <div class="cluster-items">
                                    <div class="cluster-demo"><div class="cluster-circle small">3</div><div class="cluster-label">1-4 points</div></div>
                                    <div class="cluster-demo"><div class="cluster-circle medium">12</div><div class="cluster-label">5-14 points</div></div>
                                    <div class="cluster-demo"><div class="cluster-circle large">28</div><div class="cluster-label">15+ points</div></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END CASE STUDY TOP CONTENT -->

    <?php echo view('includes/frontend/footer'); ?>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    
    <!-- jQuery (obligatoire pour fermer le preloader et pour Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="<?= base_url('public/assetsfront/bootstrap/js/bootstrap.min.js') ?>"></script>
    
    <script>
        // Cacher le preloader après chargement
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        });
        
        // Données PHP - Vérifier si elles existent
        const mesdonnees = <?= isset($mesdonnees) && !empty($mesdonnees) ? json_encode($mesdonnees) : json_encode('') ?>;
        const mesdonnees2 = <?= isset($mesdonnees2) && !empty($mesdonnees2) ? json_encode($mesdonnees2) : json_encode('') ?>;
        const mesdonnees3 = <?= isset($mesdonnees3) && !empty($mesdonnees3) ? json_encode($mesdonnees3) : json_encode('') ?>;
        const mesdonnees4 = <?= isset($mesdonnees4) && !empty($mesdonnees4) ? json_encode($mesdonnees4) : json_encode('') ?>;
        
        console.log('Données chargées:', { 
            mesdonnees: mesdonnees ? mesdonnees.substring(0, 100) : 'vide', 
            mesdonnees2: mesdonnees2 ? mesdonnees2.substring(0, 100) : 'vide' 
        });
        
        // Configuration des groupes
        const groupConfig = {
            group1: { color: '#FF0000', gradient: 'linear-gradient(135deg, #FF0000, #CC0000)', icon: '🏥', name: 'Provinces' },
            group2: { color: '#00FF00', gradient: 'linear-gradient(135deg, #00FF00, #00CC00)', icon: '🏫', name: 'Communes' },
            group3: { color: '#0000FF', gradient: 'linear-gradient(135deg, #0000FF, #0000CC)', icon: '🏛️', name: 'Zones' },
            group4: { color: '#800080', gradient: 'linear-gradient(135deg, #800080, #660066)', icon: '🏟️', name: 'Collines' }
        };
        
        // Initialisation de la carte
        const map = L.map('map').setView([-3.3804751, 29.3604533], 11);
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        
        // Cluster group
        const markers = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 60,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                let className = 'cluster-circle small';
                let size = 32;
                if (count >= 5 && count < 15) { className = 'cluster-circle medium'; size = 42; }
                else if (count >= 15) { className = 'cluster-circle large'; size = 52; }
                return L.divIcon({
                    html: `<div class="${className}" style="display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;">${count}</div>`,
                    className: 'custom-marker',
                    iconSize: L.point(size, size),
                    iconAnchor: L.point(size/2, size/2)
                });
            }
        });
        
        let allPoints = [];
        let groupCounts = { group1: 0, group2: 0, group3: 0, group4: 0 };
        
        function createMarker(lat, lng, config, id, title, description, extra) {
            const iconHtml = `<div style="background: ${config.gradient}; width: 28px; height: 28px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer;">${config.icon}</div>`;
            const icon = L.divIcon({ html: iconHtml, className: 'custom-marker', iconSize: [28, 28], popupAnchor: [0, -14] });
            const marker = L.marker([lat, lng], { icon: icon });
            const popupContent = `<div style="min-width: 220px;"><div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">${config.icon} ${title}</div><div style="padding: 12px;"><p><strong>🏷️ ID:</strong> ${id}</p><p><strong>📝 Description:</strong> ${description || 'Non renseignée'}</p>${extra ? `<p><strong>ℹ️ Info:</strong> ${extra}</p>` : ''}</div><div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">📍 ${parseFloat(lat).toFixed(6)}, ${parseFloat(lng).toFixed(6)}</div></div>`;
            marker.bindPopup(popupContent);
            return marker;
        }
        
        function parseData(rawData, group) {
            if (!rawData || typeof rawData !== 'string' || rawData.trim() === '') return;
            const points = rawData.split('@');
            for (let i = 0; i < points.length; i++) {
                if (!points[i] || points[i].trim() === '') continue;
                const parts = points[i].split('<>');
                if (parts.length < 4) continue;
                const id = parts[0] || 'N/A';
                const title = parts[1] || 'Sans titre';
                const lat = parseFloat(parts[2]);
                const lng = parseFloat(parts[3]);
                const description = parts[4] || '';
                const extra = parts[5] || '';
                if (isNaN(lat) || isNaN(lng)) continue;
                const config = groupConfig[group];
                if (!config) continue;
                const marker = createMarker(lat, lng, config, id, title, description, extra);
                markers.addLayer(marker);
                allPoints.push({ id, title, lat, lng, description, extra, group: group, groupName: config.name, groupIcon: config.icon, groupColor: config.color });
                groupCounts[group] = (groupCounts[group] || 0) + 1;
            }
        }
        
        // Parse des données
        parseData(mesdonnees, 'group1');
        parseData(mesdonnees2, 'group2');
        parseData(mesdonnees3, 'group3');
        parseData(mesdonnees4, 'group4');
        
        // Mise à jour de l'interface
        const totalPoints = allPoints.length;
        const totalPointsDisplay = document.getElementById('totalPointsDisplay');
        if (totalPointsDisplay) totalPointsDisplay.innerText = totalPoints;
        
        // Mise à jour des compteurs de groupes
        for (let i = 1; i <= 4; i++) {
            const countElement = document.getElementById(`group${i}Count`);
            if (countElement) countElement.innerText = groupCounts[`group${i}`] || 0;
        }
        
        // Génération dynamique des groupes
        const groupsListDiv = document.getElementById('groupsList');
        if (groupsListDiv && allPoints.length > 0) {
            const uniqueGroups = [...new Map(allPoints.map(p => [p.group, { group: p.group, groupName: p.groupName, groupIcon: p.groupIcon }])).values()];
            groupsListDiv.innerHTML = uniqueGroups.map(g => `
                <div class="group-card ${g.group}" data-group="${g.group}">
                    <div class="group-header">
                        <div class="group-icon ${g.group}">${g.groupIcon}</div>
                        <div class="group-info">
                            <div class="group-name">${g.groupName}</div>
                            <div class="group-count"></div>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="stat-badge">
                            <span class="stat-number ${g.group}" id="${g.group}Count">${groupCounts[g.group] || 0}</span>
                            <span class="stat-label">Points</span>
                        </div>
                    </div>
                </div>
            `).join('');
        } else if (groupsListDiv) {
            groupsListDiv.innerHTML = '<div style="text-align: center; color: #999; padding: 20px;">Aucun groupe disponible</div>';
        }
        
        // Liste des points récents
        const recentPoints = allPoints.slice(-10).reverse();
        const pointsListDiv = document.getElementById('pointsList');
        if (pointsListDiv) {
            if (recentPoints.length > 0) {
                pointsListDiv.innerHTML = recentPoints.map(point => `
                    <div class="point-item ${point.group}" onclick="flyToPoint(${point.lat}, ${point.lng})">
                        <div class="point-name">${point.groupIcon} ${point.title}</div>
                        <div class="point-coord">📌 ${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}</div>
                    </div>
                `).join('');
            } else {
                pointsListDiv.innerHTML = '<div style="text-align: center; color: #999; padding: 20px;">Aucun point à afficher</div>';
            }
        }
        
        map.addLayer(markers);
        
        if (totalPoints > 0) {
            const bounds = markers.getBounds();
            if (bounds.isValid()) map.fitBounds(bounds, { padding: [60, 60] });
        }
        
        L.control.scale({ metric: true, imperial: false, position: 'bottomright' }).addTo(map);
        
        window.flyToPoint = function(lat, lng) {
            map.flyTo([lat, lng], 15, { duration: 1.5 });
            setTimeout(() => {
                const popup = L.popup().setLatLng([lat, lng]).setContent('📍 Point sélectionné').openOn(map);
                setTimeout(() => map.closePopup(popup), 2000);
            }, 1500);
        };
        
        document.querySelectorAll('.group-card').forEach(card => {
            card.addEventListener('click', function(e) {
                e.stopPropagation();
                const groupClass = this.classList.toString().match(/group\d/);
                if (groupClass) {
                    const group = groupClass[0];
                    const groupPoints = allPoints.filter(p => p.group === group);
                    if (groupPoints.length > 0) {
                        const bounds = L.latLngBounds(groupPoints.map(p => [p.lat, p.lng]));
                        map.fitBounds(bounds, { padding: [80, 80] });
                    }
                }
            });
        });
        
        console.log(`✅ Carte chargée : ${totalPoints} points`);
        console.log(`📊 Répartition: G1=${groupCounts.group1}, G2=${groupCounts.group2}, G3=${groupCounts.group3}, G4=${groupCounts.group4}`);
    </script>

   <script type="text/javascript">
    // ==================== SYSTÈME DE FILTRES HIÉRARCHIQUES CORRIGÉ ====================
    
    // Variables globales
    let markersLayer = null;
    let allMarkersList = [];
    
    // Éléments DOM
    const selectProvince = document.getElementById('filterProvince');
    const selectCommune = document.getElementById('filterCommune');
    const selectZone = document.getElementById('filterZone');
    const selectColline = document.getElementById('filterColline');
    const btnResetFiltres = document.getElementById('resetFilters');
    
    // Données hiérarchiques
    let hierarchieData = {
        provinces: [],
        communes: [],
        zones: [],
        collines: []
    };
    
    // Mapper les IDs des points pour les relations
    let pointsMap = {
        byProvinceId: {},
        byCommuneId: {},
        byZoneId: {},
        byCollineId: {}
    };
    
    // ------------------------------------------------------------------
    // FONCTION 1 : Extraire les données hiérarchiques depuis les points
    // ------------------------------------------------------------------
    function extraireHierarchie() {
        console.log('Extraction de la hiérarchie depuis', allPoints.length, 'points');
        
        // Réinitialisation
        hierarchieData = {
            provinces: [],
            communes: [],
            zones: [],
            collines: []
        };
        
        pointsMap = {
            byProvinceId: {},
            byCommuneId: {},
            byZoneId: {},
            byCollineId: {}
        };
        
        // Extraire les provinces (groupe 1)
        const provincesUniques = new Map();
        allPoints.filter(p => p.group === 'group1').forEach(point => {
            if (!provincesUniques.has(point.id)) {
                const province = {
                    id: point.id,
                    nom: point.title,
                    lat: point.lat,
                    lng: point.lng
                };
                provincesUniques.set(point.id, province);
                hierarchieData.provinces.push(province);
            }
            pointsMap.byProvinceId[point.id] = point;
        });
        
        // Extraire les communes (groupe 2) et les lier aux provinces via les points de zone et colline
        const communesUniques = new Map();
        allPoints.filter(p => p.group === 'group2').forEach(point => {
            if (!communesUniques.has(point.id)) {
                let provinceId = null;
                // Chercher la province associée via le nom dans l'info
                if (point.info) {
                    const match = point.info.match(/🏛️ (.+)/);
                    if (match) {
                        const provinceNom = match[1];
                        const provinceTrouvee = hierarchieData.provinces.find(p => p.nom === provinceNom);
                        if (provinceTrouvee) provinceId = provinceTrouvee.id;
                    }
                }
                const commune = {
                    id: point.id,
                    nom: point.title,
                    province_id: provinceId,
                    lat: point.lat,
                    lng: point.lng
                };
                communesUniques.set(point.id, commune);
                hierarchieData.communes.push(commune);
            }
            pointsMap.byCommuneId[point.id] = point;
        });
        
        // Extraire les zones (groupe 3)
        const zonesUniques = new Map();
        allPoints.filter(p => p.group === 'group3').forEach(point => {
            if (!zonesUniques.has(point.id)) {
                let communeId = null;
                // Chercher la commune associée via l'info
                if (point.info) {
                    const match = point.info.match(/📍 (.+)/);
                    if (match) {
                        const communeNom = match[1];
                        const communeTrouvee = hierarchieData.communes.find(c => c.nom === communeNom);
                        if (communeTrouvee) communeId = communeTrouvee.id;
                    }
                }
                const zone = {
                    id: point.id,
                    nom: point.title,
                    commune_id: communeId,
                    lat: point.lat,
                    lng: point.lng
                };
                zonesUniques.set(point.id, zone);
                hierarchieData.zones.push(zone);
            }
            pointsMap.byZoneId[point.id] = point;
        });
        
        // Extraire les collines (groupe 4)
        const collinesUniques = new Map();
        allPoints.filter(p => p.group === 'group4').forEach(point => {
            if (!collinesUniques.has(point.id)) {
                let zoneId = null;
                let nbMembres = 0;
                // Extraire le nombre de membres du detail
                if (point.detail) {
                    const match = point.detail.match(/👥 (\d+) membres/);
                    if (match) nbMembres = parseInt(match[1]) || 0;
                }
                // Chercher la zone associée via l'info
                if (point.info) {
                    const match = point.info.match(/🏥 (.+?) \|/);
                    if (match) {
                        const zoneNom = match[1];
                        const zoneTrouvee = hierarchieData.zones.find(z => z.nom === zoneNom);
                        if (zoneTrouvee) zoneId = zoneTrouvee.id;
                    }
                }
                const colline = {
                    id: point.id,
                    nom: point.title,
                    zone_id: zoneId,
                    nb_membres: nbMembres,
                    lat: point.lat,
                    lng: point.lng,
                    detail: point.detail
                };
                collinesUniques.set(point.id, colline);
                hierarchieData.collines.push(colline);
            }
            pointsMap.byCollineId[point.id] = point;
        });
        
        console.log('Hiérarchie extraite:', {
            provinces: hierarchieData.provinces.length,
            communes: hierarchieData.communes.length,
            zones: hierarchieData.zones.length,
            collines: hierarchieData.collines.length
        });
    }
    
    // ------------------------------------------------------------------
    // FONCTION 2 : Remplir le select des provinces
    // ------------------------------------------------------------------
    function remplirProvinces() {
        selectProvince.innerHTML = '<option value="all">🌍 Toutes les provinces</option>';
        hierarchieData.provinces.forEach(province => {
            selectProvince.innerHTML += `<option value="${province.id}">🏢 ${province.nom}</option>`;
        });
        selectProvince.disabled = false;
    }
    
    // ------------------------------------------------------------------
    // FONCTION 3 : Mettre à jour les communes selon la province
    // ------------------------------------------------------------------
    function mettreAJourCommunes(provinceId) {
        selectCommune.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
        selectCommune.disabled = true;
        selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
        selectZone.disabled = true;
        selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        selectColline.disabled = true;
        
        if (provinceId === 'all') {
            selectCommune.disabled = false;
            hierarchieData.communes.forEach(commune => {
                selectCommune.innerHTML += `<option value="${commune.id}">🏛️ ${commune.nom}</option>`;
            });
        } else {
            const communesFiltrees = hierarchieData.communes.filter(c => c.province_id == provinceId);
            if (communesFiltrees.length > 0) {
                selectCommune.disabled = false;
                communesFiltrees.forEach(commune => {
                    selectCommune.innerHTML += `<option value="${commune.id}">🏛️ ${commune.nom}</option>`;
                });
            } else {
                selectCommune.innerHTML = '<option value="all">❌ Aucune commune</option>';
            }
        }
    }
    
    // ------------------------------------------------------------------
    // FONCTION 4 : Mettre à jour les zones selon la commune
    // ------------------------------------------------------------------
    function mettreAJourZones(communeId) {
        selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
        selectZone.disabled = true;
        selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        selectColline.disabled = true;
        
        if (communeId === 'all') {
            selectZone.disabled = false;
            hierarchieData.zones.forEach(zone => {
                selectZone.innerHTML += `<option value="${zone.id}">📍 ${zone.nom}</option>`;
            });
        } else {
            const zonesFiltrees = hierarchieData.zones.filter(z => z.commune_id == communeId);
            if (zonesFiltrees.length > 0) {
                selectZone.disabled = false;
                zonesFiltrees.forEach(zone => {
                    selectZone.innerHTML += `<option value="${zone.id}">📍 ${zone.nom}</option>`;
                });
            } else {
                selectZone.innerHTML = '<option value="all">❌ Aucune zone</option>';
            }
        }
    }
    
    // ------------------------------------------------------------------
    // FONCTION 5 : Mettre à jour les collines selon la zone
    // ------------------------------------------------------------------
    function mettreAJourCollines(zoneId) {
        selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        selectColline.disabled = true;
        
        if (zoneId === 'all') {
            selectColline.disabled = false;
            hierarchieData.collines.forEach(colline => {
                let badge = colline.nb_membres > 0 ? ` (${colline.nb_membres} membres)` : '';
                selectColline.innerHTML += `<option value="${colline.id}">🏥 ${colline.nom}${badge}</option>`;
            });
        } else {
            const collinesFiltrees = hierarchieData.collines.filter(c => c.zone_id == zoneId);
            if (collinesFiltrees.length > 0) {
                selectColline.disabled = false;
                collinesFiltrees.sort((a, b) => b.nb_membres - a.nb_membres);
                collinesFiltrees.forEach(colline => {
                    let badge = colline.nb_membres > 0 ? ` (${colline.nb_membres} membres)` : '';
                    selectColline.innerHTML += `<option value="${colline.id}">🏥 ${colline.nom}${badge}</option>`;
                });
            } else {
                selectColline.innerHTML = '<option value="all">❌ Aucune colline</option>';
            }
        }
    }
    
    // ------------------------------------------------------------------
    // FONCTION 6 : Appliquer les filtres sur la carte
    // ------------------------------------------------------------------
    function appliquerFiltres() {
        const provinceId = selectProvince.value;
        const communeId = selectCommune.value;
        const zoneId = selectZone.value;
        const collineId = selectColline.value;
        
        // Récupérer les IDs à afficher
        let idsToShow = new Set();
        
        if (collineId !== 'all') {
            // Filtre par colline spécifique
            idsToShow.add(parseInt(collineId));
        } 
        else if (zoneId !== 'all') {
            // Filtre par zone - afficher la zone et toutes ses collines
            idsToShow.add(parseInt(zoneId));
            hierarchieData.collines.filter(c => c.zone_id == zoneId).forEach(c => {
                idsToShow.add(c.id);
            });
        } 
        else if (communeId !== 'all') {
            // Filtre par commune - afficher la commune, ses zones et ses collines
            idsToShow.add(parseInt(communeId));
            hierarchieData.zones.filter(z => z.commune_id == communeId).forEach(z => {
                idsToShow.add(z.id);
                hierarchieData.collines.filter(c => c.zone_id == z.id).forEach(c => {
                    idsToShow.add(c.id);
                });
            });
        } 
        else if (provinceId !== 'all') {
            // Filtre par province - afficher la province, ses communes, zones et collines
            idsToShow.add(parseInt(provinceId));
            hierarchieData.communes.filter(c => c.province_id == provinceId).forEach(c => {
                idsToShow.add(c.id);
                hierarchieData.zones.filter(z => z.commune_id == c.id).forEach(z => {
                    idsToShow.add(z.id);
                    hierarchieData.collines.filter(cl => cl.zone_id == z.id).forEach(cl => {
                        idsToShow.add(cl.id);
                    });
                });
            });
        } 
        else {
            // Aucun filtre - afficher tout
            allPoints.forEach(point => {
                idsToShow.add(point.id);
            });
        }
        
        // Rafraîchir la carte
        refresherCarte(idsToShow);
        
        // Mettre à jour les compteurs
        mettreAJourCompteurs(idsToShow);
        
        // Mettre à jour la liste des points
        mettreAJourListePoints(idsToShow);
    }
    
    // ------------------------------------------------------------------
    // FONCTION 7 : Rafraîchir la carte avec les points filtrés
    // ------------------------------------------------------------------
    function refresherCarte(idsToShow) {
        // Supprimer les anciens marqueurs
        if (markersLayer) {
            map.removeLayer(markersLayer);
        }
        
        // Créer un nouveau groupe de marqueurs
        markersLayer = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 60,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                let className = 'cluster-circle small';
                let size = 32;
                if (count >= 5 && count < 15) { 
                    className = 'cluster-circle medium'; 
                    size = 42; 
                } else if (count >= 15) { 
                    className = 'cluster-circle large'; 
                    size = 52; 
                }
                return L.divIcon({
                    html: `<div class="${className}" style="display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;">${count}</div>`,
                    className: 'custom-marker',
                    iconSize: L.point(size, size),
                    iconAnchor: L.point(size/2, size/2)
                });
            }
        });
        
        // Ajouter les points filtrés
        allPoints.forEach(point => {
            if (idsToShow.has(point.id)) {
                const config = groupConfig[point.group];
                if (config) {
                    const marker = creerMarqueur(point.lat, point.lng, config, point.id, point.title, point.info || '', point.group);
                    markersLayer.addLayer(marker);
                }
            }
        });
        
        map.addLayer(markersLayer);
        
        // Ajuster la vue si des points sont visibles
        if (idsToShow.size > 0 && idsToShow.size !== 1) {
            try {
                const bounds = markersLayer.getBounds();
                if (bounds.isValid()) {
                    map.fitBounds(bounds, { padding: [50, 50] });
                }
            } catch(e) {
                console.log('Erreur ajustement vue:', e);
            }
        }
    }
    
    // ------------------------------------------------------------------
    // FONCTION 8 : Mettre à jour les compteurs
    // ------------------------------------------------------------------
    function mettreAJourCompteurs(idsToShow) {
        let counts = { group1: 0, group2: 0, group3: 0, group4: 0 };
        
        allPoints.forEach(point => {
            if (idsToShow.has(point.id)) {
                if (counts[point.group] !== undefined) {
                    counts[point.group]++;
                }
            }
        });
        
        // Mettre à jour l'affichage
        for (let i = 1; i <= 4; i++) {
            const element = document.getElementById(`group${i}Count`);
            if (element) element.innerText = counts[`group${i}`];
        }
        
        const totalPointsDisplay = document.getElementById('totalPointsDisplay');
        if (totalPointsDisplay) {
            const total = counts.group1 + counts.group2 + counts.group3 + counts.group4;
            totalPointsDisplay.innerText = total;
        }
    }
    
    // ------------------------------------------------------------------
    // FONCTION 9 : Mettre à jour la liste des points
    // ------------------------------------------------------------------
    function mettreAJourListePoints(idsToShow) {
        const pointsListDiv = document.getElementById('pointsList');
        if (!pointsListDiv) return;
        
        const pointsFiltres = allPoints.filter(p => idsToShow.has(p.id));
        const pointsRecents = pointsFiltres.slice(-15).reverse();
        
        if (pointsRecents.length === 0) {
            pointsListDiv.innerHTML = '<div style="text-align:center;color:#999;padding:20px;">📍 Aucun point trouvé</div>';
            return;
        }
        
        pointsListDiv.innerHTML = pointsRecents.map(point => `
            <div class="point-item ${point.group}" onclick="volerVersPoint(${point.lat}, ${point.lng})">
                <div class="point-name">${groupConfig[point.group]?.icon || '📍'} ${point.title}</div>
                <div class="point-coord">📌 ${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}</div>
                <div class="point-info" style="font-size:11px;color:#777;margin-top:5px;">${(point.info || '').substring(0, 50)}${(point.info || '').length > 50 ? '...' : ''}</div>
            </div>
        `).join('');
    }
    
    // ------------------------------------------------------------------
    // FONCTION 10 : Réinitialiser tous les filtres
    // ------------------------------------------------------------------
    function reinitialiserFiltres() {
        selectProvince.value = 'all';
        mettreAJourCommunes('all');
        mettreAJourZones('all');
        mettreAJourCollines('all');
        appliquerFiltres();
    }
    
    // ------------------------------------------------------------------
    // FONCTION 11 : Fonction pour voler vers un point
    // ------------------------------------------------------------------
    window.volerVersPoint = function(lat, lng) {
        map.flyTo([lat, lng], 16, { duration: 1.2 });
        setTimeout(() => {
            L.popup()
                .setLatLng([lat, lng])
                .setContent('📍 Point sélectionné')
                .openOn(map);
            setTimeout(() => map.closePopup(), 2000);
        }, 1200);
    };
    
    // ------------------------------------------------------------------
    // FONCTION 12 : Créer un marqueur
    // ------------------------------------------------------------------
    function creerMarqueur(lat, lng, config, id, title, info, group) {
        const iconHtml = `<div style="background: ${config.gradient}; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer;">${config.icon}</div>`;
        const icon = L.divIcon({ 
            html: iconHtml, 
            className: 'custom-marker', 
            iconSize: [30, 30], 
            popupAnchor: [0, -15] 
        });
        const marker = L.marker([lat, lng], { icon: icon });
        
        const popupContent = `
            <div style="min-width: 250px;">
                <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">
                    ${config.icon} ${title}
                </div>
                <div style="padding: 12px;">
                    <p><strong>🏷️ ID:</strong> ${id}</p>
                    <p><strong>📝 Description:</strong> ${info || 'Non renseignée'}</p>
                </div>
                <div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">
                    📍 ${typeof lat === 'number' ? lat.toFixed(6) : lat}, ${typeof lng === 'number' ? lng.toFixed(6) : lng}
                </div>
            </div>
        `;
        marker.bindPopup(popupContent);
        return marker;
    }
    
    // ------------------------------------------------------------------
    // INITIALISATION
    // ------------------------------------------------------------------
    function initialiserFiltres() {
        if (allPoints.length === 0) {
            setTimeout(initialiserFiltres, 500);
            return;
        }
        
        console.log('🚀 Initialisation des filtres avec', allPoints.length, 'points');
        
        // Extraire la hiérarchie depuis les points
        extraireHierarchie();
        
        // Remplir les selects
        remplirProvinces();
        mettreAJourCommunes('all');
        mettreAJourZones('all');
        mettreAJourCollines('all');
        
        // Attacher les événements
        selectProvince.addEventListener('change', function() {
            mettreAJourCommunes(this.value);
            appliquerFiltres();
        });
        
        selectCommune.addEventListener('change', function() {
            mettreAJourZones(this.value);
            appliquerFiltres();
        });
        
        selectZone.addEventListener('change', function() {
            mettreAJourCollines(this.value);
            appliquerFiltres();
        });
        
        selectColline.addEventListener('change', function() {
            appliquerFiltres();
        });
        
        if (btnResetFiltres) {
            btnResetFiltres.addEventListener('click', reinitialiserFiltres);
        }
        
        // Initialiser le layer des marqueurs
        markersLayer = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 60
        });
        
        console.log('✅ Système de filtres initialisé');
    }
    
    // Lancer l'initialisation après un court délai
    setTimeout(initialiserFiltres, 1000);
</script>
</body>

</html>
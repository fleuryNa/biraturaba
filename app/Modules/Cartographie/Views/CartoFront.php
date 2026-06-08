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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    
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
    
    h1, h2, h3, h4, h5, h6 {
        color: #1a1a2e;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
    }
    
    #map {
        width: 100%;
        height: 100vh;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
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
    
    /* Légende des niveaux */
    .legend-levels {
        background: #f0f2f5;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .legend-levels h4 {
        font-size: 13px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
    }
    
    .legend-level-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .legend-level-item:last-child {
        border-bottom: none;
    }
    
    .legend-color {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        flex-shrink: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .legend-info {
        flex: 1;
    }
    
    .legend-info strong {
        display: block;
        font-size: 13px;
        color: #1a1a2e;
    }
    
    .legend-info span {
        font-size: 11px;
        color: #888;
    }
    
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
    
    .filter-box {
        background: #f0f2f5;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .filter-box h4 {
        font-size: 14px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
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
    
    #resetFilters {
        width: 100%;
        margin-top: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 8px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }
    
    #resetFilters:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
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
    
    .info-banner {
        background: linear-gradient(135deg, #2c3e50, #1a1a2e);
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 20px;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .info-banner h5 {
        color: white;
        margin: 0 0 8px 0;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .info-banner p {
        color: #ccc;
        margin: 0;
        font-size: 12px;
        line-height: 1.5;
    }
    
    .info-banner .legend-icons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    
    .info-banner .legend-icons span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        background: rgba(255,255,255,0.15);
        padding: 4px 10px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .info-banner .legend-icons span:hover {
        background: rgba(255,255,255,0.3);
        transform: scale(1.02);
    }
    
    .type-groupes-filters {
        background: #f0f2f5;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .type-groupes-filters h4 {
        font-size: 13px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
    }
    
    /* Style pour le select du type de groupe */
    #typeGroupeSelect {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 13px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    #typeGroupeSelect:hover {
        border-color: #667eea;
    }
    
    #typeGroupeSelect:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
    }
    
    .type-badge {
        display: inline-block;
        padding: 6px 14px;
        margin: 3px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    
    .type-badge:hover {
        transform: scale(1.05);
    }
    
    .type-badge.active {
        box-shadow: 0 0 0 2px white, 0 0 0 4px #667eea;
    }
    
    .type-badge.all {
        background-color: #95a5a6;
        color: white;
    }
    
    .type-badge.slc {
        background-color: #3498db;
        color: white;
    }
    
    .type-badge.fonctionnels {
        background-color: #e67e22;
        color: white;
    }
    
    .type-groupes-stats {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .type-groupes-stats h4 {
        font-size: 13px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
    }
    
    /* Modal Styles */
    .detail-modal .modal-content {
        border-radius: 16px;
        overflow: hidden;
    }
    
    .detail-modal .modal-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: white;
        border-bottom: none;
        padding: 20px 25px;
    }
    
    .detail-modal .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
    }
    
    .detail-modal .modal-header .close:hover {
        opacity: 1;
    }
    
    .detail-modal .modal-body {
        padding: 25px;
        background: #f8f9fa;
    }
    
    .detail-modal .modal-footer {
        background: white;
        border-top: 1px solid #e0e0e0;
        padding: 15px 25px;
    }
    
    .stats-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    
    .stats-table th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 10px;
        text-align: center;
        font-weight: 600;
    }
    
    .stats-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #e0e0e0;
        background: white;
    }
    
    .stats-table tr:hover td {
        background: #f0f2f5;
    }
    
    .stats-table .total-row {
        background: #e8e8e8;
        font-weight: 700;
    }
    
    .stats-table .total-row td {
        background: #e8e8e8;
        font-weight: 700;
    }
    
    .colline-info-card {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .colline-info-card h6 {
        color: #667eea;
        margin-bottom: 10px;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
    }
    
    .btn-detail:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
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
        .stats-table {
            font-size: 10px;
        }
        .stats-table th, .stats-table td {
            padding: 6px 4px;
        }
    }
    
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
            <div class="row">
                <div class="col-md-8">
                    <div class="info-banner">
                        <h5><i class="fa fa-info-circle"></i> Comment utiliser cette carte ?</h5>
                        <p>
                            🗺️ Cette carte montre l'ensemble des sites d'intervention du projet Biraturaba. 
                            Cliquez sur les marqueurs pour voir les détails de chaque site.
                        </p>
                        <div class="legend-icons" id="dynamicLegendIcons"></div>
                    </div>
                    <div id="map"></div>
                </div>
                
                <div class="col-md-4">
                    <div class="legend-panel">
                        <div class="legend-header">
                            <h3>Tableau de bord</h3>
                        </div>
                        <div class="legend-body">
                            <div class="total-stats">
                                <div class="big-number" id="totalPointsDisplay">0</div>
                                <div>Points d'intervention</div>
                            </div>

                            <!-- NOUVELLE LÉGENDE DES NIVEAUX -->
                            <div class="legend-levels">
                                <h4><i class="fa fa-layer-group"></i> Légende des niveaux</h4>
                                <div class="legend-level-item province">
                                    <div class="legend-color" style="background: #FF0000;"></div>
                                    <div class="legend-info">
                                        <strong>🏢 Provinces</strong>
                                        <span>Sites provinciaux</span>
                                    </div>
                                </div>
                                <div class="legend-level-item commune">
                                    <div class="legend-color" style="background: #00FF00;"></div>
                                    <div class="legend-info">
                                        <strong>🏛️ Communes</strong>
                                        <span>Chefs-lieux de commune</span>
                                    </div>
                                </div>
                                <div class="legend-level-item zone">
                                    <div class="legend-color" style="background: #0000FF;"></div>
                                    <div class="legend-info">
                                        <strong>📍 Zones</strong>
                                        <span>Zones de regroupement</span>
                                    </div>
                                </div>
                                <div class="legend-level-item colline">
                                    <div class="legend-color" style="background: #800080;"></div>
                                    <div class="legend-info">
                                        <strong>🏥 Collines</strong>
                                        <span>Sites d'intervention</span>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTRE TYPE DE GROUPE - EN SELECT -->
                            <div class="type-groupes-filters">
                                <h4><i class="fa fa-tags"></i> Filtrer par type de groupement</h4>
                                <div class="filter-group">
                                    <select id="typeGroupeSelect" class="form-control">
                                        <option value="all">📋 Tous les types</option>
                                        <option value="SLC">🏪 SLC (SILC)</option>
                                        <option value="Fonctionnels">⚙️ Groupes Fonctionnels</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filter-box">
                                <h4>🔍 Filtres hiérarchiques</h4>
                                
                                <div class="filter-group">
                                    <label>🏢 Province</label>
                                    <select id="filterProvince">
                                        <option value="all">Toutes les provinces</option>
                                    </select>
                                </div>
                                
                                <div class="filter-group">
                                    <label>🏛️ Commune</label>
                                    <select id="filterCommune" disabled>
                                        <option value="all">Toutes les communes</option>
                                    </select>
                                </div>
                                
                                <div class="filter-group">
                                    <label>📍 Zone</label>
                                    <select id="filterZone" disabled>
                                        <option value="all">Toutes les zones</option>
                                    </select>
                                </div>
                                
                                <div class="filter-group">
                                    <label>🏥 Colline (Site)</label>
                                    <select id="filterColline" disabled>
                                        <option value="all">Toutes les collines</option>
                                    </select>
                                </div>
                                
                                <button id="resetFilters">🔄 Réinitialiser</button>
                            </div>
                            
                            <!-- <div class="type-groupes-stats">
                                <h4><i class="fa fa-pie-chart"></i> Statistiques par type</h4>
                                <div id="typeGroupesStats" style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="text-align: center; color: #999; padding: 10px;">Chargement...</div>
                                </div>
                            </div> -->
                            
                            <!-- <div class="groups-list" id="groupsList">
                                <div style="text-align: center; color: #999; padding: 20px;">Chargement des groupes...</div>
                            </div> -->
                            
                            <!-- <div class="points-section">
                                <div class="points-title"><span>📍</span> Points récents</div>
                                <div class="points-list" id="pointsList">
                                    <div style="text-align: center; color: #999; padding: 20px;">Chargement...</div>
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

    <!-- Modal de détails -->
    <div class="modal fade detail-modal" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fa fa-chart-bar"></i> Statistiques détaillées
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalCollineInfo"></div>
                    <div id="modalStatsTable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i> Fermer
                    </button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fa fa-print"></i> Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="<?= base_url('public/assetsfront/bootstrap/js/bootstrap.min.js') ?>"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <script>
        // Cacher le preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        });
        
        // Données PHP
        const mesdonnees = <?= isset($mesdonnees) && !empty($mesdonnees) ? json_encode($mesdonnees) : json_encode('') ?>;
        const mesdonnees2 = <?= isset($mesdonnees2) && !empty($mesdonnees2) ? json_encode($mesdonnees2) : json_encode('') ?>;
        const mesdonnees3 = <?= isset($mesdonnees3) && !empty($mesdonnees3) ? json_encode($mesdonnees3) : json_encode('') ?>;
        const mesdonnees4 = <?= isset($mesdonnees4) && !empty($mesdonnees4) ? json_encode($mesdonnees4) : json_encode('') ?>;
        
        // Données des types de groupes
        const typeGroupesStats = <?= isset($type_groupes_stats) && !empty($type_groupes_stats) ? json_encode($type_groupes_stats) : json_encode([]) ?>;
        
        console.log('Données chargées');
        
        // Configuration des groupes
        const groupConfig = {
            group1: { color: '#FF0000', gradient: 'linear-gradient(135deg, #FF0000, #CC0000)', icon: '🏢', name: 'Provinces' },
            group2: { color: '#00FF00', gradient: 'linear-gradient(135deg, #00FF00, #00CC00)', icon: '🏛️', name: 'Communes' },
            group3: { color: '#0000FF', gradient: 'linear-gradient(135deg, #0000FF, #0000CC)', icon: '📍', name: 'Zones' },
            group4: { color: '#800080', gradient: 'linear-gradient(135deg, #800080, #660066)', icon: '🏥', name: 'Collines' }
        };
        
        // Initialisation de la carte
        const map = L.map('map').setView([-3.3858874, 28.6053531], 8);
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        
        // Variables globales
        let allPoints = [];
        let markersCluster = null;
        let groupCounts = { group1: 0, group2: 0, group3: 0, group4: 0 };
        
        // Données pour les filtres
        let provincesList = [];
        let communesList = [];
        let zonesList = [];
        let collinesList = [];
        
        // Filtre par type de groupe
        let currentTypeFilter = 'all';
        let availableTypes = {};
        
        // Données pour les statistiques détaillées
        let allMembresData = [];
        
        // Fonction pour parser les données avec conservation des stats détaillées
        function parseData(rawData, group) {
            if (!rawData || typeof rawData !== 'string' || rawData.trim() === '') return [];
            const points = rawData.split('@');
            const result = [];
            for (let i = 0; i < points.length; i++) {
                if (!points[i] || points[i].trim() === '') continue;
                const parts = points[i].split('<>');
                if (parts.length < 4) continue;
                const id = parts[0] || 'N/A';
                const title = parts[1] || 'Sans titre';
                const lat = parseFloat(parts[2]);
                const lng = parseFloat(parts[3]);
                const info = parts[4] || '';
                const detail = parts[5] || '';
                if (isNaN(lat) || isNaN(lng)) continue;
                
                // Extraire les statistiques pour les collines
                let stats = {};
                if (group === 'group4' && detail) {
                    const membresMatch = detail.match(/👥 (\d+) membres/);
                    const hommesMatch = detail.match(/👨 (\d+) H/);
                    const femmesMatch = detail.match(/👩 (\d+) F/);
                    const groupesMatch = detail.match(/📊 (\d+) groupes/);
                    
                    stats = {
                        nb_membres: membresMatch ? parseInt(membresMatch[1]) : 0,
                        nb_hommes: hommesMatch ? parseInt(hommesMatch[1]) : 0,
                        nb_femmes: femmesMatch ? parseInt(femmesMatch[1]) : 0,
                        nb_groupes: groupesMatch ? parseInt(groupesMatch[1]) : 0
                    };
                }
                
                // Extraire le type de groupe
                let typeGroupe = null;
                if (group === 'group4' && info) {
                    const typeMatch = info.match(/Type: (SLC|Fonctionnels)/i);
                    if (typeMatch) {
                        typeGroupe = typeMatch[1];
                    }
                }
                
                // Extraire les noms de la hiérarchie
                let zoneNom = '', communeNom = '', provinceNom = '';
                if (group === 'group4' && info) {
                    const parts = info.split(' | ');
                    if (parts.length >= 3) {
                        zoneNom = parts[0].replace('🏥 ', '');
                        communeNom = parts[1];
                        provinceNom = parts[2].split(' |')[0];
                    }
                }
                
                const pointData = { 
                    id, title, lat, lng, info, detail, 
                    group: group, 
                    groupName: groupConfig[group].name, 
                    groupIcon: groupConfig[group].icon,
                    groupColor: groupConfig[group].color,
                    typeGroupe: typeGroupe,
                    stats: stats,
                    zoneNom: zoneNom,
                    communeNom: communeNom,
                    provinceNom: provinceNom
                };
                
                // Stocker les données pour les statistiques détaillées
                if (group === 'group4') {
                    allMembresData.push(pointData);
                }
                
                result.push(pointData);
            }
            return result;
        }
        
        // Charger tous les points
        const points1 = parseData(mesdonnees, 'group1');
        const points2 = parseData(mesdonnees2, 'group2');
        const points3 = parseData(mesdonnees3, 'group3');
        const points4 = parseData(mesdonnees4, 'group4');
        
        allPoints = [...points1, ...points2, ...points3, ...points4];
        
        // Compter les points par groupe
        allPoints.forEach(p => {
            if (groupCounts[p.group] !== undefined) groupCounts[p.group]++;
        });
        
        console.log('Total points:', allPoints.length, groupCounts);
        
        // Mettre à jour l'affichage
        document.getElementById('totalPointsDisplay').innerText = allPoints.length;
        
        // Générer la légende dynamique
        function generateDynamicLegend() {
            const container = document.getElementById('dynamicLegendIcons');
            if (!container) return;
            
            const activeGroups = [];
            for (let i = 1; i <= 4; i++) {
                const groupKey = `group${i}`;
                if (groupCounts[groupKey] > 0) {
                    activeGroups.push({
                        id: i,
                        name: groupConfig[groupKey].name,
                        icon: groupConfig[groupKey].icon,
                        color: groupConfig[groupKey].color,
                        count: groupCounts[groupKey]
                    });
                }
            }
            
            let html = '';
            activeGroups.forEach(group => {
                html += `
                    <span onclick="flyToGroup('${group.id}')" style="cursor: pointer;">
                        <span style="background:${group.color}; width:12px;height:12px;display:inline-block;border-radius:50%;"></span> 
                        ${group.icon} ${group.name} (${group.count})
                    </span>
                `;
            });
            
            html += `
                <span onclick="map.zoomIn()" style="cursor: pointer;"><i class="fa fa-search-plus"></i> Zoom +</span>
                <span onclick="map.zoomOut()" style="cursor: pointer;"><i class="fa fa-search-minus"></i> Zoom -</span>
                <span onclick="resetView()" style="cursor: pointer;"><i class="fa fa-globe"></i> Vue globale</span>
                <span onclick="document.querySelector('#resetFilters').click()" style="cursor: pointer;"><i class="fa fa-filter"></i> Réinitialiser</span>
            `;
            
            container.innerHTML = html;
        }
        
        window.flyToGroup = function(groupId) {
            const groupKey = `group${groupId}`;
            const groupPoints = allPoints.filter(p => p.group === groupKey);
            if (groupPoints.length > 0) {
                const bounds = L.latLngBounds(groupPoints.map(p => [p.lat, p.lng]));
                map.fitBounds(bounds, { padding: [80, 80] });
            }
        };
        
        window.resetView = function() {
            if (allPoints.length > 0 && markersCluster) {
                const bounds = markersCluster.getBounds();
                if (bounds.isValid()) {
                    map.fitBounds(bounds, { padding: [60, 60] });
                } else {
                    map.setView([-3.3858874, 28.6053531], 8);
                }
            } else {
                map.setView([-3.3858874, 28.6053531], 8);
            }
        };
        
        generateDynamicLegend();
        
        // Générer les groupes dynamiquement
        const groupsListDiv = document.getElementById('groupsList');
        if (groupsListDiv && allPoints.length > 0) {
            groupsListDiv.innerHTML = `
                <div class="group-card group1" data-group="group1">
                    <div class="group-header">
                        <div class="group-icon group1">🏢</div>
                        <div class="group-info">
                            <div class="group-name">Provinces</div>
                            <div class="group-count">Sites provinciaux</div>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="stat-badge">
                            <span class="stat-number group1" id="group1Count">${groupCounts.group1}</span>
                            <span class="stat-label">Points</span>
                        </div>
                    </div>
                </div>
                <div class="group-card group2" data-group="group2">
                    <div class="group-header">
                        <div class="group-icon group2">🏛️</div>
                        <div class="group-info">
                            <div class="group-name">Communes</div>
                            <div class="group-count">Chefs-lieux</div>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="stat-badge">
                            <span class="stat-number group2" id="group2Count">${groupCounts.group2}</span>
                            <span class="stat-label">Points</span>
                        </div>
                    </div>
                </div>
                <div class="group-card group3" data-group="group3">
                    <div class="group-header">
                        <div class="group-icon group3">📍</div>
                        <div class="group-info">
                            <div class="group-name">Zones</div>
                            <div class="group-count">Regroupements</div>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="stat-badge">
                            <span class="stat-number group3" id="group3Count">${groupCounts.group3}</span>
                            <span class="stat-label">Points</span>
                        </div>
                    </div>
                </div>
                <div class="group-card group4" data-group="group4">
                    <div class="group-header">
                        <div class="group-icon group4">🏥</div>
                        <div class="group-info">
                            <div class="group-name">Collines</div>
                            <div class="group-count">Sites d'intervention</div>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="stat-badge">
                            <span class="stat-number group4" id="group4Count">${groupCounts.group4}</span>
                            <span class="stat-label">Points</span>
                        </div>
                    </div>
                </div>
            `;
        }
        
        // Points récents
        const recentPoints = allPoints.slice(-10).reverse();
        const pointsListDiv = document.getElementById('pointsList');
        if (pointsListDiv) {
            pointsListDiv.innerHTML = recentPoints.map(point => `
                <div class="point-item ${point.group}" onclick="flyToPoint(${point.lat}, ${point.lng})">
                    <div class="point-name">${point.groupIcon} ${point.title}</div>
                    <div class="point-coord">📌 ${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}</div>
                </div>
            `).join('');
        }
        
        // Fonction pour créer un marqueur avec bouton détails
        function createMarker(point) {
            const config = groupConfig[point.group];
            const iconHtml = `<div style="background: ${config.gradient}; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer;">${config.icon}</div>`;
            const icon = L.divIcon({ html: iconHtml, className: 'custom-marker', iconSize: [30, 30], popupAnchor: [0, -15] });
            const marker = L.marker([point.lat, point.lng], { icon: icon });
            
            // Pour les collines, ajouter un bouton détails dans le popup
            let buttonDetail = '';
            if (point.group === 'group4') {
                buttonDetail = `<button class="btn-detail" onclick="showDetails('${point.id}')">📊 Voir les détails statistiques</button>`;
            }
            
            const popupContent = `
                <div style="min-width: 280px;">
                    <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">
                        ${config.icon} ${point.title}
                    </div>
                    <div style="padding: 12px;">
                        <p><strong>🏷️ ID:</strong> ${point.id}</p>
                        <p><strong>📝 Info:</strong> ${point.info || 'Non renseignée'}</p>
                        ${point.detail ? `<p><strong>📊 Détail:</strong> ${point.detail}</p>` : ''}
                        ${buttonDetail}
                    </div>
                    <div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">
                        📍 ${point.lat.toFixed(6)}, ${point.lng.toFixed(6)}
                    </div>
                </div>
            `;
            marker.bindPopup(popupContent);
            return marker;
        }
        
        // Fonction pour afficher les détails dans le modal
        window.showDetails = function(collineId) {
            const colline = allPoints.find(p => p.group === 'group4' && p.id == collineId);
            if (!colline) return;
            
            // Récupérer toutes les données de la même commune, zone, province
            const communeData = allMembresData.filter(c => c.communeNom === colline.communeNom);
            const zoneData = allMembresData.filter(c => c.zoneNom === colline.zoneNom);
            const provinceData = allMembresData.filter(c => c.provinceNom === colline.provinceNom);
            
            // Calculer les totaux par commune
            const communesStats = new Map();
            allMembresData.forEach(item => {
                if (!communesStats.has(item.communeNom)) {
                    communesStats.set(item.communeNom, {
                        commune: item.communeNom,
                        zoneCount: 0,
                        collineCount: 0,
                        nb_membres: 0,
                        nb_hommes: 0,
                        nb_femmes: 0
                    });
                }
                const stats = communesStats.get(item.communeNom);
                stats.zoneCount = [...new Set(allMembresData.filter(c => c.communeNom === item.communeNom).map(c => c.zoneNom))].length;
                stats.collineCount++;
                stats.nb_membres += item.stats.nb_membres;
                stats.nb_hommes += item.stats.nb_hommes;
                stats.nb_femmes += item.stats.nb_femmes;
            });
            
            // Préparer les lignes du tableau
            let tableRows = '';
            let totalZones = 0, totalCollines = 0, totalMembres = 0, totalHommes = 0, totalFemmes = 0;
            
            communesStats.forEach(stat => {
                tableRows += `
                    <tr>
                        <td>${stat.commune}</td>
                        <td>${stat.zoneCount}</td>
                        <td>${stat.collineCount}</td>
                        <td>-</td>
                        <td>${stat.nb_membres.toLocaleString()}</td>
                        <td>${stat.nb_hommes.toLocaleString()}</td>
                        <td>${stat.nb_femmes.toLocaleString()}</td>
                    </tr>
                `;
                totalZones += stat.zoneCount;
                totalCollines += stat.collineCount;
                totalMembres += stat.nb_membres;
                totalHommes += stat.nb_hommes;
                totalFemmes += stat.nb_femmes;
            });
            
            // Ajouter la ligne totale
            tableRows += `
                <tr class="total-row" style="background: #e8e8e8; font-weight: 700;">
                    <td><strong>TOTAL</strong></td>
                    <td><strong>${totalZones}</strong></td>
                    <td><strong>${totalCollines}</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>${totalMembres.toLocaleString()}</strong></td>
                    <td><strong>${totalHommes.toLocaleString()}</strong></td>
                    <td><strong>${totalFemmes.toLocaleString()}</strong></td>
                </tr>
            `;
            
            // Afficher les informations de la colline
            document.getElementById('modalCollineInfo').innerHTML = `
                <div class="colline-info-card">
                    <h6><i class="fa fa-map-marker"></i> Colline sélectionnée</h6>
                    <p><strong>Nom:</strong> ${colline.title}</p>
                    <p><strong>Zone:</strong> ${colline.zoneNom}</p>
                    <p><strong>Commune:</strong> ${colline.communeNom}</p>
                    <p><strong>Province:</strong> ${colline.provinceNom}</p>
                    <p><strong>Type de groupement:</strong> ${colline.typeGroupe || 'Non défini'}</p>
                    <p><strong>Membres:</strong> ${colline.stats.nb_membres} | <strong>Hommes:</strong> ${colline.stats.nb_hommes} | <strong>Femmes:</strong> ${colline.stats.nb_femmes} | <strong>Groupes:</strong> ${colline.stats.nb_groupes}</p>
                </div>
            `;
            
            // Afficher le tableau des statistiques
            document.getElementById('modalStatsTable').innerHTML = `
                <h6 style="margin-bottom: 15px; color: #1a1a2e;">
                    <i class="fa fa-table"></i> Statistiques par commune
                </h6>
                <div style="overflow-x: auto;">
                    <table class="stats-table" id="detailsTable">
                        <thead>
                            <tr>
                                <th>Commune</th>
                                <th>Zones</th>
                                <th>Collines</th>
                                <th>Groupes SILC</th>
                                <th>Total bénéficiaires</th>
                                <th>Hommes</th>
                                <th>Femmes</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tableRows}
                        </tbody>
                    </table>
                </div>
            `;
            
            // Initialiser DataTable
            setTimeout(() => {
                if ($.fn.DataTable.isDataTable('#detailsTable')) {
                    $('#detailsTable').DataTable().destroy();
                }
                $('#detailsTable').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
                    },
                    pageLength: 10,
                    scrollX: true
                });
            }, 100);
            
            $('#detailModal').modal('show');
        };
        
        // Initialiser les marqueurs
        function initMarkers() {
            if (markersCluster) {
                map.removeLayer(markersCluster);
            }
            markersCluster = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                maxClusterRadius: 60,
                iconCreateFunction: function(cluster) {
                    const count = cluster.getChildCount();
                    let size = 32;
                    if (count >= 5 && count < 15) size = 42;
                    else if (count >= 15) size = 52;
                    return L.divIcon({
                        html: `<div style="background: linear-gradient(135deg, #667eea, #764ba2); width: ${size}px; height: ${size}px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: ${size > 40 ? '16px' : '12px'};">${count}</div>`,
                        className: 'custom-marker',
                        iconSize: L.point(size, size),
                        iconAnchor: L.point(size/2, size/2)
                    });
                }
            });
            
            allPoints.forEach(point => {
                markersCluster.addLayer(createMarker(point));
            });
            
            map.addLayer(markersCluster);
            
            if (allPoints.length > 0) {
                const bounds = markersCluster.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [60, 60] });
            }
        }
        
        initMarkers();
        
        // ==================== FILTRES ====================
        
        const selectProvince = document.getElementById('filterProvince');
        const selectCommune = document.getElementById('filterCommune');
        const selectZone = document.getElementById('filterZone');
        const selectColline = document.getElementById('filterColline');
        const btnReset = document.getElementById('resetFilters');
        
        provincesList = allPoints.filter(p => p.group === 'group1').map(p => ({ id: p.id, name: p.title }));
        
        function fillProvinces() {
            selectProvince.innerHTML = '<option value="all">🌍 Toutes les provinces</option>';
            provincesList.forEach(p => {
                selectProvince.innerHTML += `<option value="${p.id}">🏢 ${p.name}</option>`;
            });
            selectProvince.disabled = false;
        }
        
        function updateCommunes(provinceId) {
            selectCommune.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
            selectCommune.disabled = true;
            selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
            selectZone.disabled = true;
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (provinceId === 'all') {
                communesList = allPoints.filter(p => p.group === 'group2').map(p => ({ id: p.id, name: p.title }));
            } else {
                communesList = [];
                allPoints.filter(p => p.group === 'group2').forEach(commune => {
                    const hasZonesWithData = allPoints.some(z => z.group === 'group3' && z.info.includes(commune.title));
                    if (hasZonesWithData) {
                        communesList.push({ id: commune.id, name: commune.title });
                    }
                });
            }
            
            if (communesList.length > 0) {
                selectCommune.disabled = false;
                communesList.forEach(c => {
                    selectCommune.innerHTML += `<option value="${c.id}">🏛️ ${c.name}</option>`;
                });
            } else {
                selectCommune.innerHTML = '<option value="all">❌ Aucune commune</option>';
            }
        }
        
        function updateZones(communeId) {
            selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
            selectZone.disabled = true;
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (communeId === 'all') {
                zonesList = allPoints.filter(p => p.group === 'group3').map(p => ({ id: p.id, name: p.title }));
            } else {
                const commune = allPoints.find(p => p.group === 'group2' && p.id == communeId);
                if (commune) {
                    zonesList = allPoints.filter(p => p.group === 'group3' && p.info.includes(commune.title)).map(p => ({ id: p.id, name: p.title }));
                } else {
                    zonesList = [];
                }
            }
            
            if (zonesList.length > 0) {
                selectZone.disabled = false;
                zonesList.forEach(z => {
                    selectZone.innerHTML += `<option value="${z.id}">📍 ${z.name}</option>`;
                });
            } else {
                selectZone.innerHTML = '<option value="all">❌ Aucune zone</option>';
            }
        }
        
        function updateCollines(zoneId) {
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (zoneId === 'all') {
                collinesList = allPoints.filter(p => p.group === 'group4').map(p => ({ id: p.id, name: p.title }));
            } else {
                const zone = allPoints.find(p => p.group === 'group3' && p.id == zoneId);
                if (zone) {
                    collinesList = allPoints.filter(p => p.group === 'group4' && p.info.includes(zone.title)).map(p => ({ id: p.id, name: p.title }));
                } else {
                    collinesList = [];
                }
            }
            
            if (collinesList.length > 0) {
                selectColline.disabled = false;
                collinesList.forEach(c => {
                    selectColline.innerHTML += `<option value="${c.id}">🏥 ${c.name}</option>`;
                });
            } else {
                selectColline.innerHTML = '<option value="all">❌ Aucune colline</option>';
            }
        }
        
        function applyFilters() {
            const provinceId = selectProvince.value;
            const communeId = selectCommune.value;
            const zoneId = selectZone.value;
            const collineId = selectColline.value;
            
            let filteredPoints = [...allPoints];
            
            // Filtre par type de groupe
            if (currentTypeFilter !== 'all') {
                filteredPoints = filteredPoints.filter(p => {
                    if (p.group === 'group4') {
                        return p.typeGroupe === currentTypeFilter;
                    }
                    if (p.group === 'group1') {
                        return allPoints.some(c => c.group === 'group4' && c.info && c.info.includes(p.title) && c.typeGroupe === currentTypeFilter);
                    }
                    if (p.group === 'group2') {
                        return allPoints.some(c => c.group === 'group4' && c.info && c.info.includes(p.title) && c.typeGroupe === currentTypeFilter);
                    }
                    if (p.group === 'group3') {
                        return allPoints.some(c => c.group === 'group4' && c.info && c.info.includes(p.title) && c.typeGroupe === currentTypeFilter);
                    }
                    return true;
                });
            }
            
            if (collineId !== 'all') {
                filteredPoints = filteredPoints.filter(p => p.group === 'group4' && p.id == collineId);
            }
            else if (zoneId !== 'all') {
                const zone = allPoints.find(p => p.group === 'group3' && p.id == zoneId);
                if (zone) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group3' && p.id == zoneId) ||
                        (p.group === 'group4' && p.info && p.info.includes(zone.title))
                    );
                }
            }
            else if (communeId !== 'all') {
                const commune = allPoints.find(p => p.group === 'group2' && p.id == communeId);
                if (commune) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group2' && p.id == communeId) ||
                        (p.group === 'group3' && p.info && p.info.includes(commune.title)) ||
                        (p.group === 'group4' && p.info && p.info.includes(commune.title))
                    );
                }
            }
            else if (provinceId !== 'all') {
                const province = allPoints.find(p => p.group === 'group1' && p.id == provinceId);
                if (province) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group1' && p.id == provinceId) ||
                        (p.group === 'group4' && p.info && p.info.includes(province.title))
                    );
                }
            }
            
            if (markersCluster) {
                map.removeLayer(markersCluster);
            }
            
            markersCluster = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                maxClusterRadius: 60,
                iconCreateFunction: function(cluster) {
                    const count = cluster.getChildCount();
                    let size = 32;
                    if (count >= 5 && count < 15) size = 42;
                    else if (count >= 15) size = 52;
                    return L.divIcon({
                        html: `<div style="background: linear-gradient(135deg, #667eea, #764ba2); width: ${size}px; height: ${size}px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: ${size > 40 ? '16px' : '12px'};">${count}</div>`,
                        className: 'custom-marker',
                        iconSize: L.point(size, size),
                        iconAnchor: L.point(size/2, size/2)
                    });
                }
            });
            
            filteredPoints.forEach(point => {
                markersCluster.addLayer(createMarker(point));
            });
            
            map.addLayer(markersCluster);
            
            if (filteredPoints.length > 0) {
                const bounds = markersCluster.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [50, 50] });
            }
            
            const newCounts = { group1: 0, group2: 0, group3: 0, group4: 0 };
            filteredPoints.forEach(p => { if (newCounts[p.group] !== undefined) newCounts[p.group]++; });
            
            if (document.getElementById('group1Count')) document.getElementById('group1Count').innerText = newCounts.group1;
            if (document.getElementById('group2Count')) document.getElementById('group2Count').innerText = newCounts.group2;
            if (document.getElementById('group3Count')) document.getElementById('group3Count').innerText = newCounts.group3;
            if (document.getElementById('group4Count')) document.getElementById('group4Count').innerText = newCounts.group4;
            document.getElementById('totalPointsDisplay').innerText = filteredPoints.length;
            
            const pointsRecents = filteredPoints.slice(-10).reverse();
            if (pointsListDiv) {
                pointsListDiv.innerHTML = pointsRecents.map(point => `
                    <div class="point-item ${point.group}" onclick="flyToPoint(${point.lat}, ${point.lng})">
                        <div class="point-name">${point.groupIcon} ${point.title}</div>
                        <div class="point-coord">📌 ${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}</div>
                    </div>
                `).join('');
            }
        }
        
        function resetAllFilters() {
            selectProvince.value = 'all';
            selectCommune.value = 'all';
            selectZone.value = 'all';
            selectColline.value = 'all';
            selectCommune.disabled = true;
            selectZone.disabled = true;
            selectColline.disabled = true;
            currentTypeFilter = 'all';
            
            // Réinitialiser le select type groupe
            const typeSelect = document.getElementById('typeGroupeSelect');
            if (typeSelect) {
                typeSelect.value = 'all';
            }
            
            applyFilters();
        }
        
        // Initialisation du select pour le filtre type de groupe
        function initTypeGroupeSelect() {
            const select = document.getElementById('typeGroupeSelect');
            if (!select) return;
            
            // Vérifier quels types existent dans les données
            const typesExistants = new Set();
            allPoints.filter(p => p.group === 'group4').forEach(p => {
                if (p.typeGroupe) {
                    typesExistants.add(p.typeGroupe);
                }
            });
            
            // Activer/désactiver les options selon les données
            const slcOption = select.querySelector('option[value="SLC"]');
            const fonctionnelsOption = select.querySelector('option[value="Fonctionnels"]');
            
            if (slcOption && !typesExistants.has('SLC')) {
                slcOption.disabled = true;
                slcOption.textContent = '🏪 SLC (aucune donnée)';
            }
            if (fonctionnelsOption && !typesExistants.has('Fonctionnels')) {
                fonctionnelsOption.disabled = true;
                fonctionnelsOption.textContent = '⚙️ Fonctionnels (aucune donnée)';
            }
            
            select.addEventListener('change', function() {
                currentTypeFilter = this.value;
                applyFilters();
            });
        }
        
        fillProvinces();
        updateCommunes('all');
        
        selectProvince.addEventListener('change', function() {
            updateCommunes(this.value);
            applyFilters();
        });
        
        selectCommune.addEventListener('change', function() {
            updateZones(this.value);
            applyFilters();
        });
        
        selectZone.addEventListener('change', function() {
            updateCollines(this.value);
            applyFilters();
        });
        
        selectColline.addEventListener('change', function() {
            applyFilters();
        });
        
        if (btnReset) {
            btnReset.addEventListener('click', resetAllFilters);
        }
        
        document.querySelectorAll('.group-card').forEach(card => {
            card.addEventListener('click', function() {
                const group = this.getAttribute('data-group');
                flyToGroup(group.replace('group', ''));
            });
        });
        
        window.flyToPoint = function(lat, lng) {
            map.flyTo([lat, lng], 15, { duration: 1.5 });
            setTimeout(() => {
                L.popup().setLatLng([lat, lng]).setContent('📍 Point sélectionné').openOn(map);
                setTimeout(() => map.closePopup(), 2000);
            }, 1500);
        };
        
        // Initialiser le filtre type groupe
        initTypeGroupeSelect();
        
        console.log('✅ Carte initialisée avec', allPoints.length, 'points');
    </script>
</body>

</html>
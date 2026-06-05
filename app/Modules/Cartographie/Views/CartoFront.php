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
    
  /*  .map-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    */
    .map-col {
        flex: 0 0 66.666%;
        width: 66.666%;
    }
    
    /*.legend-col {
        flex: 0 0 33.333%;
        width: 33.333%;
    }
    */
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
            <div class="map-container">

                <div class="row"><div class="col-md-8">
                  
                <!-- <div class="map-col"> -->
                    <div id="map"></div>
                <!-- </div> -->
                </div>
                <div class="col-md-4">
                   
                <div class="legend-col">
                    <div class="legend-panel">
                        <div class="legend-header">
                            <h3>Tableau de bord</h3>
                        </div>
                        <div class="legend-body">
                            <div class="total-stats">
                                <div class="big-number" id="totalPointsDisplay">0</div>
                                <div>Points d'intervention</div>
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
                            
                            <div class="groups-list" id="groupsList">
                                <div style="text-align: center; color: #999; padding: 20px;">Chargement des groupes...</div>
                            </div>
                            
                            <div class="points-section">
                                <div class="points-title"><span>📍</span> Points récents</div>
                                <div class="points-list" id="pointsList">
                                    <div style="text-align: center; color: #999; padding: 20px;">Chargement...</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="<?= base_url('public/assetsfront/bootstrap/js/bootstrap.min.js') ?>"></script>
    
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
        
        // Fonction pour parser les données
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
                result.push({ id, title, lat, lng, info, detail, group: group, groupName: groupConfig[group].name, groupIcon: groupConfig[group].icon });
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
        
        // Fonction pour créer un marqueur
        function createMarker(point) {
            const config = groupConfig[point.group];
            const iconHtml = `<div style="background: ${config.gradient}; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer;">${config.icon}</div>`;
            const icon = L.divIcon({ html: iconHtml, className: 'custom-marker', iconSize: [30, 30], popupAnchor: [0, -15] });
            const marker = L.marker([point.lat, point.lng], { icon: icon });
            const popupContent = `<div style="min-width: 250px;"><div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">${config.icon} ${point.title}</div><div style="padding: 12px;"><p><strong>🏷️ ID:</strong> ${point.id}</p><p><strong>📝 Info:</strong> ${point.info || 'Non renseignée'}</p>${point.detail ? `<p><strong>📊 Détail:</strong> ${point.detail}</p>` : ''}</div><div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">📍 ${point.lat.toFixed(6)}, ${point.lng.toFixed(6)}</div></div>`;
            marker.bindPopup(popupContent);
            return marker;
        }
        
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
                    let className = 'cluster-circle small';
                    let size = 32;
                    if (count >= 5 && count < 15) { className = 'cluster-circle medium'; size = 42; }
                    else if (count >= 15) { className = 'cluster-circle large'; size = 52; }
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
            
            // Ajuster la vue
            if (allPoints.length > 0) {
                const bounds = markersCluster.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [60, 60] });
            }
        }
        
        initMarkers();
        
        // ==================== SYSTÈME DE FILTRES SIMPLIFIÉ ====================
        
        // Éléments DOM
        const selectProvince = document.getElementById('filterProvince');
        const selectCommune = document.getElementById('filterCommune');
        const selectZone = document.getElementById('filterZone');
        const selectColline = document.getElementById('filterColline');
        const btnReset = document.getElementById('resetFilters');
        
        // Extraire les provinces depuis les points (TOUTES les provinces avec données)
        provincesList = allPoints.filter(p => p.group === 'group1').map(p => ({ id: p.id, name: p.title }));
        
        // Remplir le select des provinces
        function fillProvinces() {
            selectProvince.innerHTML = '<option value="all">🌍 Toutes les provinces</option>';
            provincesList.forEach(p => {
                selectProvince.innerHTML += `<option value="${p.id}">🏢 ${p.name}</option>`;
            });
            selectProvince.disabled = false;
        }
        
        // Mettre à jour les communes selon la province sélectionnée
        function updateCommunes(provinceId) {
            selectCommune.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
            selectCommune.disabled = true;
            selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
            selectZone.disabled = true;
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (provinceId === 'all') {
                communesList = allPoints.filter(p => p.group === 'group2').map(p => ({ id: p.id, name: p.title, province_id: null }));
            } else {
                // Trouver les communes qui appartiennent à cette province
                // Pour cela, on cherche les zones de cette province, puis les communes des zones
                const zonesOfProvince = allPoints.filter(p => p.group === 'group3').filter(zone => {
                    // Extraire le nom de la commune depuis l'info de la zone
                    const match = zone.info.match(/📍 (.+)/);
                    if (match) {
                        const communeName = match[1];
                        const commune = allPoints.find(c => c.group === 'group2' && c.title === communeName);
                        if (commune && commune.id == provinceId) return true;
                    }
                    return false;
                });
                
                communesList = [];
                allPoints.filter(p => p.group === 'group2').forEach(commune => {
                    // Vérifier si cette commune a des zones qui ont des collines avec membres
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
        
        // Mettre à jour les zones selon la commune sélectionnée
        function updateZones(communeId) {
            selectZone.innerHTML = '<option value="all">📍 Toutes les zones</option>';
            selectZone.disabled = true;
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (communeId === 'all') {
                zonesList = allPoints.filter(p => p.group === 'group3').map(p => ({ id: p.id, name: p.title, commune_id: null }));
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
        
        // Mettre à jour les collines selon la zone sélectionnée
        function updateCollines(zoneId) {
            selectColline.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
            selectColline.disabled = true;
            
            if (zoneId === 'all') {
                collinesList = allPoints.filter(p => p.group === 'group4').map(p => ({ id: p.id, name: p.title, zone_id: null }));
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
        
        // Appliquer les filtres sur la carte
        function applyFilters() {
            const provinceId = selectProvince.value;
            const communeId = selectCommune.value;
            const zoneId = selectZone.value;
            const collineId = selectColline.value;
            
            let filteredPoints = [...allPoints];
            
            if (collineId !== 'all') {
                filteredPoints = filteredPoints.filter(p => p.group === 'group4' && p.id == collineId);
            }
            else if (zoneId !== 'all') {
                const zone = allPoints.find(p => p.group === 'group3' && p.id == zoneId);
                if (zone) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group3' && p.id == zoneId) ||
                        (p.group === 'group4' && p.info.includes(zone.title))
                    );
                }
            }
            else if (communeId !== 'all') {
                const commune = allPoints.find(p => p.group === 'group2' && p.id == communeId);
                if (commune) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group2' && p.id == communeId) ||
                        (p.group === 'group3' && p.info.includes(commune.title)) ||
                        (p.group === 'group4' && p.info.includes(commune.title))
                    );
                }
            }
            else if (provinceId !== 'all') {
                const province = allPoints.find(p => p.group === 'group1' && p.id == provinceId);
                if (province) {
                    filteredPoints = filteredPoints.filter(p => 
                        (p.group === 'group1' && p.id == provinceId) ||
                        (p.group === 'group4' && p.info.includes(province.title))
                    );
                }
            }
            
            // Rafraîchir la carte
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
            
            // Ajuster la vue
            if (filteredPoints.length > 0) {
                const bounds = markersCluster.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [50, 50] });
            }
            
            // Mettre à jour les compteurs
            const newCounts = { group1: 0, group2: 0, group3: 0, group4: 0 };
            filteredPoints.forEach(p => { if (newCounts[p.group] !== undefined) newCounts[p.group]++; });
            
            document.getElementById('group1Count').innerText = newCounts.group1;
            document.getElementById('group2Count').innerText = newCounts.group2;
            document.getElementById('group3Count').innerText = newCounts.group3;
            document.getElementById('group4Count').innerText = newCounts.group4;
            document.getElementById('totalPointsDisplay').innerText = filteredPoints.length;
            
            // Mettre à jour la liste des points
            const pointsRecents = filteredPoints.slice(-10).reverse();
            pointsListDiv.innerHTML = pointsRecents.map(point => `
                <div class="point-item ${point.group}" onclick="flyToPoint(${point.lat}, ${point.lng})">
                    <div class="point-name">${point.groupIcon} ${point.title}</div>
                    <div class="point-coord">📌 ${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}</div>
                </div>
            `).join('');
        }
        
        // Réinitialiser tous les filtres
        function resetAllFilters() {
            selectProvince.value = 'all';
            selectCommune.value = 'all';
            selectZone.value = 'all';
            selectColline.value = 'all';
            selectCommune.disabled = true;
            selectZone.disabled = true;
            selectColline.disabled = true;
            applyFilters();
        }
        
        // Événements
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
        
        // Groupe click
        document.querySelectorAll('.group-card').forEach(card => {
            card.addEventListener('click', function() {
                const group = this.getAttribute('data-group');
                const groupPoints = allPoints.filter(p => p.group === group);
                if (groupPoints.length > 0) {
                    const bounds = L.latLngBounds(groupPoints.map(p => [p.lat, p.lng]));
                    map.fitBounds(bounds, { padding: [80, 80] });
                }
            });
        });
        
        // Fonction pour voler vers un point
        window.flyToPoint = function(lat, lng) {
            map.flyTo([lat, lng], 15, { duration: 1.5 });
            setTimeout(() => {
                L.popup().setLatLng([lat, lng]).setContent('📍 Point sélectionné').openOn(map);
                setTimeout(() => map.closePopup(), 2000);
            }, 1500);
        };
        
        console.log('✅ Carte initialisée avec', allPoints.length, 'points');
    </script>
</body>

</html>
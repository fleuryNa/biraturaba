<!doctype html>
<html lang="fr">
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Biraturaba - <?= $title ?? ' Cartographie' ?></title>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <!-- Primary Meta Tags -->
    <meta name="title" content="Biraturaba | Administration" />
    <meta name="author" content="Biraturaba" />
    <meta name="description" content="Interface cartographie Biraturaba" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />

    <!-- Bootstrap Icons (CDN - plus rapide) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />

    <!-- ApexCharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />

    <!-- Vos fichiers locaux (corrigés pour CodeIgniter 4) -->
    <link rel="stylesheet" href="<?= base_url('public/dist/css/adminlte.css') ?>" />
    
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="<?= base_url('public/dist/css/custom.css') ?>" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('public/dist/img/favicon.png') ?>" />
    
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        }
        
        .container-fluid {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        h1 {
            margin-bottom: 20px;
            color: #1a1a2e;
            font-weight: 700;
            font-size: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        h1:before {
            content: "🗺️";
            font-size: 32px;
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
            height: 70vh;
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
            height: 70vh;
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
            color: #333;
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
            color: #333;
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
            color: #333;
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
            color: #555;
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
        
        /* Badges */
        .badge-pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 500;
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
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
 



<?= view('includes/backend/sidebarmenu') ?>





      <!--end::Header-->
      <!--begin::Sidebar-->



<?= view('includes/backend/menu') ?>
    <div class="container-fluid">
        <h1>Zones d'Intervention</h1>
        
        <!-- Layout: 8 colonnes carte / 4 colonnes légende -->
        <div class="map-container">
            <!-- Colonne carte (8/12 = 66.66%) -->
            <div class="map-col">
                <div id="map"></div>
            </div>
            
            <!-- Colonne légende (4/12 = 33.33%) -->
            <div class="legend-col">
                <div class="legend-panel">
                    <div class="legend-header">
                        <h3>Tableau de bord</h3>
                    </div>
                    <div class="legend-body">
                        <!-- Statistiques totales -->
                        <div class="total-stats">
                            <div class="big-number" id="totalPointsDisplay">0</div>
                            <div>Points d'intervention</div>
                            <div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏥 🏫 🏛️ 🏟️
                            </div>
                        </div>
                        
                        <!-- Liste des groupes -->
                        <div class="groups-list">
                            <div class="group-card group1" data-group="group1">
                                <div class="group-header">
                                    <div class="group-icon group1">🏥</div>
                                    <div class="group-info">
                                        <div class="group-name">Santé & Social</div>
                                        <div class="group-count" id="group1Name">Groupe 1</div>
                                    </div>
                                </div>
                                <div class="group-stats">
                                    <div class="stat-badge">
                                        <span class="stat-number group1" id="group1Count">0</span>
                                        <span class="stat-label">Points</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group-card group2" data-group="group2">
                                <div class="group-header">
                                    <div class="group-icon group2">🏫</div>
                                    <div class="group-info">
                                        <div class="group-name">Éducation & Formation</div>
                                        <div class="group-count" id="group2Name">Groupe 2</div>
                                    </div>
                                </div>
                                <div class="group-stats">
                                    <div class="stat-badge">
                                        <span class="stat-number group2" id="group2Count">0</span>
                                        <span class="stat-label">Points</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group-card group3" data-group="group3">
                                <div class="group-header">
                                    <div class="group-icon group3">🏛️</div>
                                    <div class="group-info">
                                        <div class="group-name">Administration & Services</div>
                                        <div class="group-count" id="group3Name">Groupe 3</div>
                                    </div>
                                </div>
                                <div class="group-stats">
                                    <div class="stat-badge">
                                        <span class="stat-number group3" id="group3Count">0</span>
                                        <span class="stat-label">Points</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group-card group4" data-group="group4">
                                <div class="group-header">
                                    <div class="group-icon group4">🏟️</div>
                                    <div class="group-info">
                                        <div class="group-name">Sports & Culture</div>
                                        <div class="group-count" id="group4Name">Groupe 4</div>
                                    </div>
                                </div>
                                <div class="group-stats">
                                    <div class="stat-badge">
                                        <span class="stat-number group4" id="group4Count">0</span>
                                        <span class="stat-label">Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Liste des points récents -->
                        <div class="points-section">
                            <div class="points-title">
                                <span>📍</span> Points récents
                            </div>
                            <div class="points-list" id="pointsList">
                                <div style="text-align: center; color: #999; padding: 20px;">
                                    Chargement...
                                </div>
                            </div>
                        </div>
                        
                        <!-- Légende des clusters -->
                        <div class="cluster-legend">
                            <h4>📊 Zones regroupées (Clusters)</h4>
                            <div class="cluster-items">
                                <div class="cluster-demo">
                                    <div class="cluster-circle small">3</div>
                                    <div class="cluster-label">1-4 points</div>
                                </div>
                                <div class="cluster-demo">
                                    <div class="cluster-circle medium">12</div>
                                    <div class="cluster-label">5-14 points</div>
                                </div>
                                <div class="cluster-demo">
                                    <div class="cluster-circle large">28</div>
                                    <div class="cluster-label">15+ points</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    
    <script>
        // Données PHP
        const mesdonnees = '<?= addslashes($mesdonnees ?? "") ?>';
        const mesdonnees2 = '<?= addslashes($mesdonnees2 ?? "") ?>';
        const mesdonnees3 = '<?= addslashes($mesdonnees3 ?? "") ?>';
        const mesdonnees4 = '<?= addslashes($mesdonnees4 ?? "") ?>';
        
        // Configuration des groupes
        const groupConfig = {
            group1: {
                color: '#FF0000',
                gradient: 'linear-gradient(135deg, #FF0000, #CC0000)',
                icon: '🏥',
                name: 'Santé & Social'
            },
            group2: {
                color: '#00FF00',
                gradient: 'linear-gradient(135deg, #00FF00, #00CC00)',
                icon: '🏫',
                name: 'Éducation & Formation'
            },
            group3: {
                color: '#0000FF',
                gradient: 'linear-gradient(135deg, #0000FF, #0000CC)',
                icon: '🏛️',
                name: 'Administration & Services'
            },
            group4: {
                color: '#800080',
                gradient: 'linear-gradient(135deg, #800080, #660066)',
                icon: '🏟️',
                name: 'Sports & Culture'
            }
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
        
        // Stockage des points
        let allPoints = [];
        let groupCounts = { group1: 0, group2: 0, group3: 0, group4: 0 };
        
        // Fonction pour créer un marqueur
        function createMarker(lat, lng, config, id, title, description, extra) {
            const iconHtml = `
                <div style="
                    background: ${config.gradient};
                    width: 28px;
                    height: 28px;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 0 2px ${config.color}, 0 4px 12px rgba(0,0,0,0.3);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 14px;
                    cursor: pointer;
                ">
                    ${config.icon}
                </div>
            `;
            
            const icon = L.divIcon({
                html: iconHtml,
                className: 'custom-marker',
                iconSize: [28, 28],
                popupAnchor: [0, -14]
            });
            
            const marker = L.marker([lat, lng], { icon: icon });
            
            const popupContent = `
                <div style="min-width: 220px;">
                    <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">
                        ${config.icon} ${title}
                    </div>
                    <div style="padding: 12px;">
                        <p><strong>🏷️ ID:</strong> ${id}</p>
                        <p><strong>📝 Description:</strong> ${description || 'Non renseignée'}</p>
                        ${extra ? `<p><strong>ℹ️ Info:</strong> ${extra}</p>` : ''}
                    </div>
                    <div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">
                        📍 ${lat.toFixed(6)}, ${lng.toFixed(6)}
                    </div>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            return marker;
        }
        
        // Traitement des données
        const dataGroups = [
            { raw: mesdonnees, group: 'group1' },
            { raw: mesdonnees2, group: 'group2' },
            { raw: mesdonnees3, group: 'group3' },
            { raw: mesdonnees4, group: 'group4' }
        ];
        
        dataGroups.forEach(({ raw, group }) => {
            if (!raw || raw.trim() === '') return;
            
            const points = raw.split('@');
            for (let i = 0; i < points.length; i++) {
                const parts = points[i].split('<>');
                if (parts.length < 4) continue;
                
                const id = parts[0];
                const title = parts[1];
                const lat = parseFloat(parts[2]);
                const lng = parseFloat(parts[3]);
                const description = parts[4] || '';
                const extra = parts[5] || '';
                
                if (isNaN(lat) || isNaN(lng)) continue;
                
                const config = groupConfig[group];
                const marker = createMarker(lat, lng, config, id, title, description, extra);
                markers.addLayer(marker);
                
                allPoints.push({
                    id, title, lat, lng, description, extra,
                    group: group,
                    groupName: config.name,
                    groupIcon: config.icon,
                    groupColor: config.color
                });
                
                groupCounts[group]++;
            }
        });
        
        // Mise à jour de l'interface
        const totalPoints = allPoints.length;
        document.getElementById('totalPointsDisplay').innerText = totalPoints;
        document.getElementById('group1Count').innerText = groupCounts.group1;
        document.getElementById('group2Count').innerText = groupCounts.group2;
        document.getElementById('group3Count').innerText = groupCounts.group3;
        document.getElementById('group4Count').innerText = groupCounts.group4;
        
        // Liste des points récents (les 10 derniers)
        const recentPoints = allPoints.slice(-10).reverse();
        const pointsListDiv = document.getElementById('pointsList');
        
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
        
        // Ajout des marqueurs à la carte
        map.addLayer(markers);
        
        // Ajustement de la vue
        if (totalPoints > 0) {
            const bounds = markers.getBounds();
            if (bounds.isValid()) {
                map.fitBounds(bounds, { padding: [60, 60] });
            }
        }
        
        // Échelle
        L.control.scale({ metric: true, imperial: false, position: 'bottomright' }).addTo(map);
        
        // Fonction pour voler vers un point
        window.flyToPoint = function(lat, lng) {
            map.flyTo([lat, lng], 15, {
                duration: 1.5
            });
            setTimeout(() => {
                const popup = L.popup()
                    .setLatLng([lat, lng])
                    .setContent('📍 Point sélectionné')
                    .openOn(map);
                setTimeout(() => map.closePopup(popup), 2000);
            }, 1500);
        };
        
        // Click sur les groupes pour zoomer sur leurs points
        document.querySelectorAll('.group-card').forEach(card => {
            card.addEventListener('click', function() {
                const group = this.dataset.group;
                const groupPoints = allPoints.filter(p => p.group === group);
                
                if (groupPoints.length > 0) {
                    const bounds = L.latLngBounds(groupPoints.map(p => [p.lat, p.lng]));
                    map.fitBounds(bounds, { padding: [80, 80] });
                }
            });
        });
        
        console.log(`✅ Carte chargée : ${totalPoints} points`);
    </script>
</body>
</html>

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
    
    #map {
        width: 100%;
        height: 110vh;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .legend-panel {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        height: auto;
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
        color: white !important;
    }
    
    .legend-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        max-height: 600px;
    }
    
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
    }
    
    .legend-info {
        flex: 1;
    }
    
    .legend-info strong {
        display: block;
        font-size: 13px;
        color: #1a1a2e;
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
    
    .type-structure-filter {
        background: #f0f2f5;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .type-structure-filter h4 {
        font-size: 13px;
        margin-bottom: 12px;
        color: #1a1a2e;
        font-weight: 600;
    }
    
    #typeStructureSelect {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 13px;
        background: white;
        cursor: pointer;
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
    
    .btn-detail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        cursor: pointer;
        margin-top: 8px;
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
    
    @media (max-width: 768px) {
        .map-col, .legend-col {
            flex: 0 0 100%;
            width: 100%;
        }
        #map {
            height: 50vh;
        }
    }
    </style>
</head>

<body>

    <!-- START PRELOADER -->
    <div class="preloader" id="preloader" style="position:fixed;top:0;left:0;width:100%;height:100%;background:white;z-index:9999;display:flex;align-items:center;justify-content:center;">
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
    <section class="section-top" style="background-image: url('<?= base_url('public/assetsfront/img/bg/section-top.png') ?>'); background-size: cover; background-position: center center; padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-top-title">
                        <h1>CARTOGRAPHIE</h1>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- END SECTION TOP -->

    <!-- START MAP SECTION -->
    <section class="case_content_top_area section-padding" style="padding: 60px 0;">
        <div class="container">
        <!-- DESCRIPTION DE LA CARTE -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="info-banner" style="background: linear-gradient(135deg, #2c3e50, #1a1a2e); border-radius: 12px; padding: 15px 20px; margin-bottom: 20px; color: white;">
            <h5 style="color: white; margin: 0 0 8px 0;"><i class="fa fa-info-circle"></i> Comment utiliser cette carte ?</h5>
            <p style="color: #ccc; margin: 0; font-size: 13px;">
                🗺️ Cette carte montre l'ensemble des sites d'intervention du projet Biraturaba.<br>
                • 🏢 Les provinces (rouge) - 🏛️ Les communes (vert) - 📍 Les zones (bleu) - 🏥 Les collines (violet)<br>
                • Cliquez sur les marqueurs pour voir les détails de chaque site.<br>
                • Utilisez les filtres ci-contre pour affiner votre recherche par province, commune, zone ou type de structure.<br>
                • Les clusters (cercles avec chiffres) regroupent les points proches - cliquez dessus pour les déployer.
            </p>
            <div class="legend-icons" style="display: flex; gap: 15px; margin-top: 10px; flex-wrap: wrap;">
                <span style="cursor: pointer;" onclick="flyToGroup('province')"><span style="background:#FF0000; width:12px;height:12px;display:inline-block;border-radius:50%;"></span> 🏢 Provinces</span>
                <span style="cursor: pointer;" onclick="flyToGroup('commune')"><span style="background:#00FF00; width:12px;height:12px;display:inline-block;border-radius:50%;"></span> 🏛️ Communes</span>
                <span style="cursor: pointer;" onclick="flyToGroup('zone')"><span style="background:#0000FF; width:12px;height:12px;display:inline-block;border-radius:50%;"></span> 📍 Zones</span>
                <span style="cursor: pointer;" onclick="flyToGroup('colline')"><span style="background:#800080; width:12px;height:12px;display:inline-block;border-radius:50%;"></span> 🏥 Collines</span>
            </div>
        </div>
    </div>
</div>

            <div class="row">
                <div class="col-md-8 map-col">
                    <div id="map"></div>
                </div>
                
                <div class="col-md-4 legend-col">
                    <div class="legend-panel">
                        <div class="legend-header">
                            <h3><i class="fa fa-dashboard"></i> Tableau de bord</h3>
                        </div>
                        <div class="legend-body">
                            <div class="total-stats">
                                <div class="big-number" id="totalPointsDisplay">0</div>
                                <div>Points d'intervention</div>
                            </div>

                            <div class="legend-levels">
                                <h4><i class="fa fa-layer-group"></i> Légende</h4>
                                <div class="legend-level-item">
                                    <div class="legend-color" style="background: #FF0000;"></div>
                                    <div class="legend-info">
                                        <strong>🏢 Provinces</strong>
                                        <span>Sites provinciaux</span>
                                    </div>
                                </div>
                                <div class="legend-level-item">
                                    <div class="legend-color" style="background: #00FF00;"></div>
                                    <div class="legend-info">
                                        <strong>🏛️ Communes</strong>
                                        <span>Chefs-lieux de commune</span>
                                    </div>
                                </div>
                                <div class="legend-level-item">
                                    <div class="legend-color" style="background: #0000FF;"></div>
                                    <div class="legend-info">
                                        <strong>📍 Zones</strong>
                                        <span>Zones de regroupement</span>
                                    </div>
                                </div>
                                <div class="legend-level-item">
                                    <div class="legend-color" style="background: #800080;"></div>
                                    <div class="legend-info">
                                        <strong>🏥 Collines</strong>
                                        <span>Sites d'intervention</span>
                                    </div>
                                </div>
                            </div>

                            <div class="type-structure-filter">
                                <h4><i class="fa fa-tags"></i> Filtrer par type de structure</h4>
                                <select id="typeStructureSelect" class="form-control">
                                    <option value="all">📋 Tous les types</option>
                                    <option value="SLC">🏪 SLC (SILC)</option>
                                    <option value="Fonctionnels">⚙️ Structures Fonctionnelles</option>
                                </select>
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
                                    <label>🏥 Colline</label>
                                    <select id="filterColline" disabled>
                                        <option value="all">Toutes les collines</option>
                                    </select>
                                </div>
                                <button id="resetFilters">🔄 Réinitialiser</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAP SECTION -->

    <?php echo view('includes/frontend/footer'); ?>

    <!-- Modal -->
    <div class="modal fade detail-modal" id="detailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white;">
                    <h5 class="modal-title"><i class="fa fa-chart-bar"></i> Statistiques détaillées</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalCollineInfo"></div>
                    <div id="modalStatsTable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="<?= base_url('public/assetsfront/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        // Données PHP converties en JSON
        const provinces = <?= $provinces ?: '[]' ?>;
        const communes = <?= $communes ?: '[]' ?>;
        const zones = <?= $zones ?: '[]' ?>;
        const collines = <?= $collines ?: '[]' ?>;
        const stats = <?= json_encode($stats) ?: '{}' ?>;

        console.log('Provinces:', provinces.length);
        console.log('Communes:', communes.length);
        console.log('Zones:', zones.length);
        console.log('Collines:', collines.length);

        // Configuration des groupes
        const groupConfig = {
            province: { color: '#FF0000', gradient: 'linear-gradient(135deg, #FF0000, #CC0000)', icon: '🏢', name: 'Provinces', level: 1 },
            commune: { color: '#00FF00', gradient: 'linear-gradient(135deg, #00FF00, #00CC00)', icon: '🏛️', name: 'Communes', level: 2 },
            zone: { color: '#0000FF', gradient: 'linear-gradient(135deg, #0000FF, #0000CC)', icon: '📍', name: 'Zones', level: 3 },
            colline: { color: '#800080', gradient: 'linear-gradient(135deg, #800080, #660066)', icon: '🏥', name: 'Collines', level: 4 }
        };

        // Initialisation de la carte
        const map = L.map('map').setView([-3.3858874, 28.6053531], 8);
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        let allPoints = [];
        let markersCluster = null;
        let currentTypeFilter = 'all';

        // Créer un marqueur personnalisé
        function createMarker(point, config) {
            const iconHtml = `<div style="background: ${config.gradient}; width: 32px; height: 32px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer;">${config.icon}</div>`;
            const icon = L.divIcon({ html: iconHtml, className: 'custom-marker', iconSize: [32, 32], popupAnchor: [0, -16] });
            const marker = L.marker([point.lat, point.lng], { icon: icon });
            
            let buttonDetail = '';
            if (config.level === 4) {
                buttonDetail = `<button class="btn-detail" onclick="showDetails('${point.id}')">📊 Voir les détails</button>`;
            }
            
            const popupContent = `
                <div style="min-width: 280px;">
                    <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">
                        ${config.icon} ${point.nom}
                    </div>
                    <div style="padding: 12px;">
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

        // Initialiser tous les marqueurs
        function initMarkers() {
            allPoints = [];
            
            // Ajouter les provinces
            provinces.forEach(p => {
                allPoints.push({ ...p, type: 'province', config: groupConfig.province });
            });
            
            // Ajouter les communes
            communes.forEach(c => {
                allPoints.push({ ...c, type: 'commune', config: groupConfig.commune });
            });
            
            // Ajouter les zones
            zones.forEach(z => {
                allPoints.push({ ...z, type: 'zone', config: groupConfig.zone });
            });
            
            // Ajouter les collines
            collines.forEach(c => {
                allPoints.push({ ...c, type: 'colline', config: groupConfig.colline });
            });
            
            console.log('Total points à afficher:', allPoints.length);
            
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
                    let size = 40;
                    if (count >= 10) size = 50;
                    if (count >= 50) size = 60;
                    return L.divIcon({
                        html: `<div style="background: linear-gradient(135deg, #667eea, #764ba2); width: ${size}px; height: ${size}px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: ${size > 45 ? '16px' : '12px'};">${count}</div>`,
                        className: 'custom-marker',
                        iconSize: L.point(size, size),
                        iconAnchor: L.point(size/2, size/2)
                    });
                }
            });
            
            allPoints.forEach(point => {
                markersCluster.addLayer(createMarker(point, point.config));
            });
            
            map.addLayer(markersCluster);
            
            // Mettre à jour l'affichage du total
            document.getElementById('totalPointsDisplay').innerText = allPoints.length;
            
            // Ajuster la vue
            if (allPoints.length > 0 && markersCluster.getBounds().isValid()) {
                map.fitBounds(markersCluster.getBounds(), { padding: [50, 50] });
            }
        }

        // Appliquer les filtres
       // Appliquer les filtres
function applyFilters() {
    if (!markersCluster) return;
    
    const provinceId = document.getElementById('filterProvince').value;
    const communeId = document.getElementById('filterCommune').value;
    const zoneId = document.getElementById('filterZone').value;
    const collineId = document.getElementById('filterColline').value;
    
    let filtered = [...allPoints];
    
    // Filtre par type de structure (uniquement pour les collines)
    if (currentTypeFilter !== 'all') {
        filtered = filtered.filter(point => {
            if (point.type === 'colline') {
                return point.type_structure_nom === currentTypeFilter;
            }
            // Pour les provinces, communes, zones : on garde si elles ont des collines du type sélectionné
            if (point.type === 'province') {
                return collines.some(c => c.province_nom === point.nom && c.type_structure_nom === currentTypeFilter);
            }
            if (point.type === 'commune') {
                return collines.some(c => c.commune_nom === point.nom && c.type_structure_nom === currentTypeFilter);
            }
            if (point.type === 'zone') {
                return collines.some(c => c.zone_nom === point.nom && c.type_structure_nom === currentTypeFilter);
            }
            return true;
        });
    }
    
    // Filtres hiérarchiques
    if (collineId !== 'all') {
        filtered = filtered.filter(p => p.type === 'colline' && p.id == collineId);
    } else if (zoneId !== 'all') {
        filtered = filtered.filter(p => (p.type === 'zone' && p.id == zoneId) || (p.type === 'colline' && p.zone_id == zoneId));
    } else if (communeId !== 'all') {
        filtered = filtered.filter(p => (p.type === 'commune' && p.id == communeId) || (p.type === 'zone' && p.commune_id == communeId) || (p.type === 'colline' && p.commune_id == communeId));
    } else if (provinceId !== 'all') {
        filtered = filtered.filter(p => (p.type === 'province' && p.id == provinceId) || (p.type === 'commune' && p.province_id == provinceId) || (p.type === 'zone' && p.province_id == provinceId) || (p.type === 'colline' && p.province_id == provinceId));
    }
    
    // Reconstruire les marqueurs
    markersCluster.clearLayers();
    filtered.forEach(point => {
        markersCluster.addLayer(createMarker(point, point.config));
    });
    map.addLayer(markersCluster);
    
    document.getElementById('totalPointsDisplay').innerText = filtered.length;
}

      // Remplir les selects de filtres
function initFilters() {
    const provinceSelect = document.getElementById('filterProvince');
    const communeSelect = document.getElementById('filterCommune');
    const zoneSelect = document.getElementById('filterZone');
    const collineSelect = document.getElementById('filterColline');
    
    // Provinces
    provinceSelect.innerHTML = '<option value="all">🌍 Toutes les provinces</option>';
    provinces.forEach(p => {
        provinceSelect.innerHTML += `<option value="${p.id}">🏢 ${p.nom}</option>`;
    });
    
    // Initialiser les communes (toutes)
    communeSelect.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
    communes.forEach(c => {
        communeSelect.innerHTML += `<option value="${c.id}">🏛️ ${c.nom}</option>`;
    });
    communeSelect.disabled = false;
    
    // Initialiser les zones (toutes)
    zoneSelect.innerHTML = '<option value="all">📍 Toutes les zones</option>';
    zones.forEach(z => {
        zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
    });
    zoneSelect.disabled = false;
    
    // Initialiser les collines (toutes)
    collineSelect.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
    collines.forEach(c => {
        collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
    });
    collineSelect.disabled = false;
    
    // Événement Province
    provinceSelect.addEventListener('change', function() {
        const provinceId = this.value;
        communeSelect.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
        zoneSelect.innerHTML = '<option value="all">📍 Toutes les zones</option>';
        collineSelect.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        
        if (provinceId !== 'all') {
            const communesFiltered = communes.filter(c => c.province_id == provinceId);
            communesFiltered.forEach(c => {
                communeSelect.innerHTML += `<option value="${c.id}">🏛️ ${c.nom}</option>`;
            });
            
            const zonesFiltered = zones.filter(z => z.province_id == provinceId);
            zonesFiltered.forEach(z => {
                zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
            });
            
            const collinesFiltered = collines.filter(c => c.province_id == provinceId);
            collinesFiltered.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        } else {
            // Réafficher toutes les communes
            communes.forEach(c => {
                communeSelect.innerHTML += `<option value="${c.id}">🏛️ ${c.nom}</option>`;
            });
            zones.forEach(z => {
                zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
            });
            collines.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        }
        applyFilters();
    });
    
    // Événement Commune
    communeSelect.addEventListener('change', function() {
        const communeId = this.value;
        zoneSelect.innerHTML = '<option value="all">📍 Toutes les zones</option>';
        collineSelect.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        
        if (communeId !== 'all') {
            const zonesFiltered = zones.filter(z => z.commune_id == communeId);
            zonesFiltered.forEach(z => {
                zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
            });
            
            const collinesFiltered = collines.filter(c => c.commune_id == communeId);
            collinesFiltered.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        } else {
            zones.forEach(z => {
                zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
            });
            collines.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        }
        applyFilters();
    });
    
    // Événement Zone
    zoneSelect.addEventListener('change', function() {
        const zoneId = this.value;
        collineSelect.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        
        if (zoneId !== 'all') {
            const collinesFiltered = collines.filter(c => c.zone_id == zoneId);
            collinesFiltered.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        } else {
            collines.forEach(c => {
                collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
            });
        }
        applyFilters();
    });
    
    collineSelect.addEventListener('change', function() {
        applyFilters();
    });
    
    // Filtre type de structure
    const typeSelect = document.getElementById('typeStructureSelect');
    typeSelect.addEventListener('change', function() {
        currentTypeFilter = this.value;
        applyFilters();
    });
    
    // Reset
    document.getElementById('resetFilters').addEventListener('click', function() {
        provinceSelect.value = 'all';
        communeSelect.value = 'all';
        zoneSelect.value = 'all';
        collineSelect.value = 'all';
        typeSelect.value = 'all';
        currentTypeFilter = 'all';
        
        // Réinitialiser les listes
        communeSelect.innerHTML = '<option value="all">🏛️ Toutes les communes</option>';
        zoneSelect.innerHTML = '<option value="all">📍 Toutes les zones</option>';
        collineSelect.innerHTML = '<option value="all">🏥 Toutes les collines</option>';
        
        communes.forEach(c => {
            communeSelect.innerHTML += `<option value="${c.id}">🏛️ ${c.nom}</option>`;
        });
        zones.forEach(z => {
            zoneSelect.innerHTML += `<option value="${z.id}">📍 ${z.nom}</option>`;
        });
        collines.forEach(c => {
            collineSelect.innerHTML += `<option value="${c.id}">🏥 ${c.nom}</option>`;
        });
        
        applyFilters();
        if (markersCluster && markersCluster.getBounds().isValid()) {
            map.fitBounds(markersCluster.getBounds(), { padding: [50, 50] });
        }
    });
}

// Fonction pour voler vers un groupe
function flyToGroup(groupType) {
    let points = [];
    if (groupType === 'province') points = provinces;
    else if (groupType === 'commune') points = communes;
    else if (groupType === 'zone') points = zones;
    else if (groupType === 'colline') points = collines;
    
    if (points.length > 0) {
        const bounds = L.latLngBounds(points.map(p => [p.lat, p.lng]));
        map.fitBounds(bounds, { padding: [50, 50] });
    }
}
        // Afficher les détails dans le modal
        window.showDetails = function(collineId) {
            const colline = collines.find(c => c.id == collineId);
            if (!colline) return;
            
            // Récupérer toutes les collines de la même commune
            const communeCollines = collines.filter(c => c.commune_nom === colline.commune_nom);
            
            // Calculer les stats par zone
            const zonesStats = new Map();
            communeCollines.forEach(c => {
                if (!zonesStats.has(c.zone_nom)) {
                    zonesStats.set(c.zone_nom, {
                        zone: c.zone_nom,
                        collineCount: 0,
                        nb_membres: 0,
                        nb_hommes: 0,
                        nb_femmes: 0,
                        nb_structures: 0
                    });
                }
                const stats = zonesStats.get(c.zone_nom);
                stats.collineCount++;
                stats.nb_membres += c.nb_membres;
                stats.nb_hommes += c.nb_hommes;
                stats.nb_femmes += c.nb_femmes;
                stats.nb_structures += c.nb_structures;
            });
            
            let tableRows = '';
            let totalCollines = 0, totalMembres = 0, totalHommes = 0, totalFemmes = 0, totalStructures = 0;
            
            zonesStats.forEach(stat => {
                tableRows += `
                    <tr>
                        <td>${stat.zone}</td>
                        <td>${stat.collineCount}</td>
                        <td>${stat.nb_membres.toLocaleString()}</td>
                        <td>${stat.nb_hommes.toLocaleString()}</td>
                        <td>${stat.nb_femmes.toLocaleString()}</td>
                        <td>${stat.nb_structures}</td>
                    </tr>
                `;
                totalCollines += stat.collineCount;
                totalMembres += stat.nb_membres;
                totalHommes += stat.nb_hommes;
                totalFemmes += stat.nb_femmes;
                totalStructures += stat.nb_structures;
            });
            
            tableRows += `
                <tr class="total-row">
                    <td><strong>TOTAL (${colline.commune_nom})</strong></td>
                    <td><strong>${totalCollines}</strong></td>
                    <td><strong>${totalMembres.toLocaleString()}</strong></td>
                    <td><strong>${totalHommes.toLocaleString()}</strong></td>
                    <td><strong>${totalFemmes.toLocaleString()}</strong></td>
                    <td><strong>${totalStructures}</strong></td>
                </tr>
            `;
            
            document.getElementById('modalCollineInfo').innerHTML = `
                <div class="colline-info-card">
                    <h6><i class="fa fa-map-marker"></i> ${colline.nom}</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Zone:</strong> ${colline.zone_nom}</p>
                            <p><strong>Commune:</strong> ${colline.commune_nom}</p>
                            <p><strong>Province:</strong> ${colline.province_nom}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Type de structure:</strong> <span class="badge" style="background: ${colline.type_structure_nom === 'SLC' ? '#3498db' : '#e67e22'}; color: white; padding: 3px 10px; border-radius: 20px;">${colline.type_structure_nom || 'Non défini'}</span></p>
                            <p><strong>Membres:</strong> ${colline.nb_membres} | <strong>Hommes:</strong> ${colline.nb_hommes} | <strong>Femmes:</strong> ${colline.nb_femmes}</p>
                            <p><strong>Structures:</strong> ${colline.nb_structures}</p>
                        </div>
                    </div>
                </div>
                <div class="colline-info-card">
                    <h6>Statistiques de la commune: ${colline.commune_nom}</h6>
                    <div style="overflow-x: auto;">
                        <table class="stats-table" id="detailsTable">
                            <thead>
                                <tr>
                                    <th>Zone</th>
                                    <th>Collines</th>
                                    <th>Bénéficiaires</th>
                                    <th>Hommes</th>
                                    <th>Femmes</th>
                                    <th>Structures</th>
                                </tr>
                            </thead>
                            <tbody>${tableRows}</tbody>
                        </table>
                    </div>
                </div>
            `;
            
            setTimeout(() => {
                if ($.fn.DataTable.isDataTable('#detailsTable')) {
                    $('#detailsTable').DataTable().destroy();
                }
                $('#detailsTable').DataTable({
                    language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json' },
                    pageLength: 10,
                    scrollX: true
                });
            }, 100);
            
            $('#detailModal').modal('show');
        };

        // Chargement initial
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
            initMarkers();
            initFilters();
        });
    </script>
</body>
</html>
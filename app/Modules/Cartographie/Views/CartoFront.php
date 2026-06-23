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
        height: 115vh;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .legend-panel {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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

    /* Styles pour le modal amélioré */
    .modal-content {
        border-radius: 16px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border-bottom: none;
        padding: 20px 25px;
    }

    .modal-header .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
        transition: opacity 0.2s;
        font-size: 28px;
        font-weight: 300;
        background: transparent;
        border: none;
        padding: 0;
        margin: 0;
        line-height: 1;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 25px;
        background: #f8f9fa;
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 15px 25px;
        background: white;
    }

    .modal-footer .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 8px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }

    .modal-footer .btn-secondary:hover {
        background: #5a6268;
    }

    .colline-detail-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        color: white;
    }

    .colline-detail-header h4 {
        margin: 0 0 15px 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .detail-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .detail-info-item {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        padding: 10px 12px;
    }

    .detail-info-item label {
        display: block;
        font-size: 10px;
        opacity: 0.8;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-info-item .value {
        font-size: 14px;
        font-weight: 600;
        word-break: break-word;
    }

    .badge-type {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-slc {
        background: #3498db;
        color: white;
    }

    .badge-fonctionnel {
        background: #e67e22;
        color: white;
    }

    .stats-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .stats-section h5 {
        color: #1a1a2e;
        font-size: 1rem;
        margin: 0 0 20px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
        display: inline-block;
    }

    .stats-table-wrapper {
        overflow-x: auto;
        margin-top: 15px;
    }

    .stats-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .stats-table thead tr {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stats-table thead th {
        padding: 12px 15px;
        color: white;
        font-weight: 600;
        font-size: 13px;
        text-align: center;
        border: none;
    }

    .stats-table thead th:first-child {
        text-align: left;
        border-radius: 8px 0 0 0;
    }

    .stats-table thead th:last-child {
        border-radius: 0 8px 0 0;
    }

    .stats-table tbody tr {
        transition: background 0.2s ease;
        border-bottom: 1px solid #e9ecef;
    }

    .stats-table tbody tr:hover {
        background: #f8f9fa;
    }

    .stats-table tbody td {
        padding: 10px 15px;
        text-align: center;
        border: none;
    }

    .stats-table tbody td:first-child {
        text-align: left;
        font-weight: 500;
    }

    .stats-table .total-row {
        background: #e8e8e8;
        font-weight: 700;
        border-top: 2px solid #667eea;
    }

    .stats-table .total-row td {
        padding: 10px 15px;
        font-weight: 700;
    }

    .stats-table .total-row td:first-child {
        text-align: left;
    }

    .description-box {
        background: #fff9e6;
        border-left: 4px solid #667eea;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .description-box p {
        margin: 0;
        font-size: 13px;
        line-height: 1.6;
        color: #555;
    }

    /* Styles DataTables personnalisés */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin: 0 2px;
        border-radius: 4px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white !important;
        border: none;
    }

    @media (max-width: 992px) {
        .detail-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {

        .map-col,
        .legend-col {
            flex: 0 0 100%;
            width: 100%;
        }

        #map {
            height: 50vh;
        }

        .detail-info-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .stats-table thead th,
        .stats-table tbody td {
            padding: 8px 10px;
            font-size: 11px;
        }
    }

    /* Styles pour le tableau de bord des statistiques par type */
    .stats-dashboard {
        transition: all 0.3s ease;
    }

    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: default;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
    }

    .stat-card .fa {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .stat-card {
            padding: 14px !important;
        }

        .stat-card div[style*="font-size: 22px"] {
            font-size: 18px !important;
        }
    }
    </style>
</head>

<body>

    <!-- START PRELOADER -->
    <div class="preloader" id="preloader"
        style="position:fixed;top:0;left:0;width:100%;height:100%;background:white;z-index:9999;display:flex;align-items:center;justify-content:center;">
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
    <section class="section-top"
        style="background-image: url('<?= base_url('public/assetsfront/img/bg/section-top.png') ?>'); background-size: cover; background-position: center center; padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br><br><br>
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
                    <div class="info-banner"
                        style="background: linear-gradient(135deg, #2c3e50, #1a1a2e); border-radius: 12px; padding: 15px 20px; margin-bottom: 20px; color: white;">
                        <h5 style="color: white; margin: 0 0 8px 0;"><i class="fa fa-info-circle"></i> Comment utiliser
                            cette carte ?</h5>
                        <p style="color: #ccc; margin: 0; font-size: 13px;">
                            Cette carte montre l'ensemble des zones d'intervention de Biraturaba ASBL.<br>
                            - Provinces (rouge) - Communes (vert) - Zones (bleu) - Collines (violet)<br>
                            - Cliquez sur les marqueurs pour voir les détails de chaque site.<br>
                            - Utilisez les filtres ci-contre pour affiner votre recherche par province, commune, zone ou
                            type de structure.<br>
                            - Les clusters (cercles avec chiffres) regroupent les points proches - cliquez dessus pour
                            les déployer.
                        </p>
                        <div class="legend-icons" style="display: flex; gap: 15px; margin-top: 10px; flex-wrap: wrap;">
                            <span style="cursor: pointer;" onclick="flyToGroup('province')"><span
                                    style="background:#FF0000; width:12px;height:12px;display:inline-block;border-radius:50%;"></span>
                                Provinces</span>
                            <span style="cursor: pointer;" onclick="flyToGroup('commune')"><span
                                    style="background:#00FF00; width:12px;height:12px;display:inline-block;border-radius:50%;"></span>
                                Communes</span>
                            <span style="cursor: pointer;" onclick="flyToGroup('zone')"><span
                                    style="background:#0000FF; width:12px;height:12px;display:inline-block;border-radius:50%;"></span>
                                Zones</span>
                            <span style="cursor: pointer;" onclick="flyToGroup('colline')"><span
                                    style="background:#800080; width:12px;height:12px;display:inline-block;border-radius:50%;"></span>
                                Collines</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLEAU DE BORD DES STATISTIQUES PAR TYPE DE STRUCTURE (DYNAMIQUE) -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="stats-dashboard"
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                        <h4 style="color: #1a1a2e; margin-bottom: 20px; font-weight: 600;">
                            <i class="fa fa-pie-chart" style="color: #667eea;"></i>
                            Statistiques par type de structure
                            <span id="statsFilterInfo"
                                style="font-size: 12px; font-weight: 400; color: #888; margin-left: 10px;"></span>
                        </h4>
                        <div id="statsContainer">
                            <!-- Les statistiques seront générées dynamiquement en JavaScript -->
                            <div class="text-center text-muted" style="padding: 20px 0;">
                                <i class="fa fa-spinner fa-spin" style="font-size: 24px;"></i>
                                <p style="margin-top: 10px;">Chargement des statistiques...</p>
                            </div>
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
                                <div>Points d'intervention (Collines)</div>
                            </div>

                            <div class="type-structure-filter">
                                <h4><i class="fa fa-tags"></i> Filtrer par type de structure</h4>
                                <select id="typeStructureSelect" class="form-control">
                                    <option value="all">Tous les types</option>
                                    <?php foreach ($types_structure as $type): ?>
                                    <option value="<?= esc($type['nom']) ?>"><?= esc($type['nom']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="filter-box">
                                <h4>Filtres hierarchiques</h4>
                                <div class="filter-group">
                                    <label>Province</label>
                                    <select id="filterProvince">
                                        <option value="all">Toutes les provinces</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Commune</label>
                                    <select id="filterCommune" disabled>
                                        <option value="all">Toutes les communes</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Zone</label>
                                    <select id="filterZone" disabled>
                                        <option value="all">Toutes les zones</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Colline</label>
                                    <select id="filterColline" disabled>
                                        <option value="all">Toutes les collines</option>
                                    </select>
                                </div>
                                <button id="resetFilters">Reinitialiser</button>
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
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fa fa-chart-bar"></i> Statistiques detaillees
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalCollineInfo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles additionnels pour Leaflet et DataTables -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    <!-- Scripts additionnels -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
    // Données PHP converties en JSON
    const provinces = <?= $provinces ?: '[]' ?>;
    const communes = <?= $communes ?: '[]' ?>;
    const zones = <?= $zones ?: '[]' ?>;
    const collines = <?= $collines ?: '[]' ?>;
    const stats = <?= json_encode($stats) ?: '{}' ?>;

    console.log('Données reçues:');
    console.log('Provinces:', provinces);
    console.log('Communes:', communes);
    console.log('Zones:', zones);
    console.log('Collines:', collines);

    // ============================================
    // FONCTIONS UTILITAIRES
    // ============================================

    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/\n/g, '<br>');
    }

    function formatNumber(num) {
        if (!num && num !== 0) return '0';
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    function getUniqueByName(data) {
        const uniqueMap = new Map();
        data.forEach(item => {
            const name = item.nom;
            if (name && !uniqueMap.has(name)) {
                uniqueMap.set(name, {
                    value: name,
                    label: name,
                    id: item.id,
                    lat: item.lat,
                    lng: item.lng,
                    province_nom: item.province_nom || null,
                    province_id: item.province_id || null,
                    commune_nom: item.commune_nom || null,
                    commune_id: item.commune_id || null,
                    zone_nom: item.zone_nom || null,
                    zone_id: item.zone_id || null,
                    info: item.info || null,
                    detail: item.detail || null
                });
            }
        });
        return Array.from(uniqueMap.values());
    }

    function populateSelect(selectElement, items, defaultText = 'Tous') {
        const currentValue = selectElement.value;
        selectElement.innerHTML = `<option value="all">${defaultText}</option>`;
        items.forEach(item => {
            const value = item.value || item.nom;
            const text = item.label || item.nom;
            selectElement.innerHTML += `<option value="${value}">${escapeHtml(text)}</option>`;
        });
        selectElement.disabled = false;
        if (currentValue && Array.from(selectElement.options).some(opt => opt.value === currentValue)) {
            selectElement.value = currentValue;
        } else {
            selectElement.value = 'all';
        }
    }

    // ============================================
    // DONNÉES UNIQUES PAR NOM
    // ============================================

    const uniqueProvinces = getUniqueByName(provinces);
    const uniqueCommunes = getUniqueByName(communes);
    const uniqueZones = getUniqueByName(zones);
    const uniqueCollines = getUniqueByName(collines);

    console.log('Données uniques:');
    console.log('Provinces uniques:', uniqueProvinces.length);
    console.log('Communes uniques:', uniqueCommunes.length);
    console.log('Zones uniques:', uniqueZones.length);
    console.log('Collines uniques:', uniqueCollines.length);

    // ============================================
    // STATISTIQUES DYNAMIQUES
    // ============================================

    function calculateStatsByType(filteredCollines) {
        const statsMap = new Map();

        filteredCollines.forEach(colline => {
            const type = colline.type_structure_nom || 'Non défini';

            if (!statsMap.has(type)) {
                statsMap.set(type, {
                    type_structure: type,
                    nb_collines: 0,
                    total_membres: 0,
                    total_hommes: 0,
                    total_femmes: 0,
                    total_structures: 0
                });
            }

            const stat = statsMap.get(type);
            stat.nb_collines++;
            stat.total_membres += colline.nb_membres || 0;
            stat.total_hommes += colline.nb_hommes || 0;
            stat.total_femmes += colline.nb_femmes || 0;
            stat.total_structures += colline.nb_structures || 0;
        });

        return Array.from(statsMap.values()).sort((a, b) => b.total_membres - a.total_membres);
    }

    function getTypeColor(type) {
        const typeLower = type ? type.toLowerCase() : '';
        if (typeLower.includes('slc') || typeLower.includes('silc')) {
            return '#3498db';
        } else if (typeLower.includes('fonctionnel')) {
            return '#e67e22';
        } else if (typeLower.includes('coop')) {
            return '#27ae60';
        } else {
            return '#667eea';
        }
    }

    function updateStatsDashboard(filteredCollines) {
        const statsContainer = document.getElementById('statsContainer');
        const statsFilterInfo = document.getElementById('statsFilterInfo');

        if (!statsContainer) return;

        const stats = calculateStatsByType(filteredCollines);

        if (statsFilterInfo) {
            statsFilterInfo.textContent = `(${filteredCollines.length} collines affichées)`;
        }

        if (stats.length === 0) {
            statsContainer.innerHTML = `
                <div class="text-center text-muted" style="padding: 30px 0;">
                    <i class="fa fa-info-circle" style="font-size: 24px;"></i>
                    <p style="margin-top: 10px;">Aucune donnée correspondant aux filtres actuels</p>
                </div>
            `;
            return;
        }

        let html = '<div class="row">';
        stats.forEach(stat => {
            const badgeColor = getTypeColor(stat.type_structure);
            html += `
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="stat-card" style="background: ${badgeColor}; border-radius: 12px; padding: 18px; color: white; height: 100%; transition: transform 0.2s; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-size: 14px; font-weight: 500; opacity: 0.9;">
                                <i class="fa fa-tag"></i> ${escapeHtml(stat.type_structure)}
                            </span>
                            <span style="background: rgba(255,255,255,0.2); padding: 2px 12px; border-radius: 20px; font-size: 12px;">
                                ${stat.nb_collines} collines
                            </span>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                            <div>
                                <div style="font-size: 22px; font-weight: 700;">${formatNumber(stat.total_membres)}</div>
                                <div style="font-size: 11px; opacity: 0.8;">Total membres</div>
                            </div>
                            <div>
                                <div style="font-size: 22px; font-weight: 700;">${formatNumber(stat.total_structures)}</div>
                                <div style="font-size: 11px; opacity: 0.8;">Structures</div>
                            </div>
                        </div>
                        <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.2); display: flex; justify-content: space-between; font-size: 13px;">
                            <span><i class="fa fa-male"></i> Hommes: ${formatNumber(stat.total_hommes)}</span>
                            <span><i class="fa fa-female"></i> Femmes: ${formatNumber(stat.total_femmes)}</span>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        statsContainer.innerHTML = html;
    }

    // ============================================
    // CARTE ET MARQUEURS
    // ============================================

    const markerColors = {
        province: {
            bg: '#FF0000',
            name: 'Province'
        },
        commune: {
            bg: '#00FF00',
            name: 'Commune'
        },
        zone: {
            bg: '#0000FF',
            name: 'Zone'
        },
        colline: {
            bg: '#800080',
            name: 'Colline'
        }
    };

    const map = L.map('map').setView([-3.3858874, 28.6053531], 8);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);

    let allPoints = [];
    let markersCluster = null;
    let currentTypeFilter = 'all';

    function createCustomColoredMarker(point, type) {
        const colorConfig = markerColors[type];

        const markerHtml = `
            <svg width="25" height="41" viewBox="0 0 25 41" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="grad-${type}" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:${colorConfig.bg};stop-opacity:1" />
                        <stop offset="100%" style="stop-color:${colorConfig.bg};stop-opacity:0.8" />
                    </linearGradient>
                    <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                        <feDropShadow dx="1" dy="2" stdDeviation="2" flood-opacity="0.3"/>
                    </filter>
                </defs>
                <g filter="url(#shadow)">
                    <path d="M12.5 0C5.6 0 0 5.6 0 12.5C0 21.875 12.5 41 12.5 41C12.5 41 25 21.875 25 12.5C25 5.6 19.4 0 12.5 0Z" 
                          fill="url(#grad-${type})" stroke="white" stroke-width="1.5"/>
                    <circle cx="12.5" cy="12.5" r="4" fill="white" opacity="0.3"/>
                </g>
            </svg>
        `;

        const icon = L.divIcon({
            html: markerHtml,
            className: 'custom-marker',
            iconSize: [25, 41],
            iconAnchor: [12.5, 41],
            popupAnchor: [0, -35]
        });

        const marker = L.marker([point.lat, point.lng], {
            icon: icon
        });

        let buttonDetail = '';
        let descriptionHtml = '';

        // Déterminer le label info en fonction du type
        let infoLabel = 'Info';
        if (type === 'province') {
            infoLabel = 'Communes';
        } else if (type === 'commune') {
            infoLabel = 'Province';
        } else if (type === 'zone') {
            infoLabel = 'Commune';
        } else if (type === 'colline') {
            infoLabel = 'Zone';
        }

        let detailLabel = '';
        if (type === 'province') {
            detailLabel = 'Detail';
        } else if (type === 'commune') {
            detailLabel = 'Statistiques';
        } else if (type === 'zone') {
            detailLabel = 'Statistiques';
        } else if (type === 'colline') {
            detailLabel = 'Detail';
        }

        if (type === 'colline') {
            buttonDetail = `<button class="btn-detail" onclick="showDetails('${point.id}')">Voir les détails</button>`;

            if (point.description && point.description.trim() !== '') {
                let description = point.description;
                if (description.length > 150) {
                    description = description.substring(0, 150) + '...';
                }
                descriptionHtml = `
                    <div style="margin-top: 10px; padding-top: 8px; border-top: 1px solid #e0e0e0;">
                        <strong>Description:</strong>
                        <p style="margin-top: 5px; font-size: 12px; line-height: 1.4; color: #555;">${escapeHtml(description)}</p>
                    </div>
                `;
            }
        }

        const pointName = point.nom || point.label || point.value || 'Point sans nom';

        const popupContent = `
            <div style="min-width: 280px; max-width: 350px;">
                <div style="background: ${colorConfig.bg}; color: white; padding: 10px 12px; border-radius: 12px 12px 0 0;">
                    ${escapeHtml(pointName)}
                </div>
                <div style="padding: 12px;">
                    <p><strong>${infoLabel}:</strong> ${point.info || 'Non renseignée'}</p>
                    ${point.detail ? `<p><strong>${detailLabel}:</strong> ${point.detail}</p>` : ''}
                    ${descriptionHtml}
                    ${buttonDetail}
                </div>
                <div style="background: #f8f9fa; padding: 8px 12px; border-radius: 0 0 12px 12px; font-size: 11px; color: #666;">
                    ${point.lat.toFixed(6)}, ${point.lng.toFixed(6)}
                </div>
            </div>
        `;
        marker.bindPopup(popupContent);
        return marker;
    }

    let totalCollinesCount = 0;

    function initMarkers() {
        allPoints = [];

        uniqueProvinces.forEach(p => {
            allPoints.push({
                ...p,
                type: 'province'
            });
        });

        uniqueCommunes.forEach(c => {
            allPoints.push({
                ...c,
                type: 'commune'
            });
        });

        uniqueZones.forEach(z => {
            allPoints.push({
                ...z,
                type: 'zone'
            });
        });

        // Utiliser les collines dédupliquées par COLLINE_ID
        // On garde toutes les collines uniques (déjà dédupliquées dans le PHP)
        collines.forEach(c => {
            allPoints.push({
                ...c,
                type: 'colline',
                description: c.description || ''
            });
        });

        // totalCollinesCount = nombre de collines uniques (déjà calculé dans le PHP)
        totalCollinesCount = collines.length;

        console.log('Total points à afficher:', allPoints.length);
        console.log('Total collines uniques:', totalCollinesCount);

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
                    iconAnchor: L.point(size / 2, size / 2)
                });
            }
        });

        allPoints.forEach(point => {
            markersCluster.addLayer(createCustomColoredMarker(point, point.type));
        });

        map.addLayer(markersCluster);

        document.getElementById('totalPointsDisplay').innerText = totalCollinesCount;

        if (allPoints.length > 0 && markersCluster.getBounds().isValid()) {
            map.fitBounds(markersCluster.getBounds(), {
                padding: [50, 50]
            });
        }
    }

    // ============================================
    // FILTRES HIÉRARCHIQUES
    // ============================================

    function initFilters() {
        const provinceSelect = document.getElementById('filterProvince');
        const communeSelect = document.getElementById('filterCommune');
        const zoneSelect = document.getElementById('filterZone');
        const collineSelect = document.getElementById('filterColline');

        populateSelect(provinceSelect, uniqueProvinces, 'Toutes les provinces');
        populateSelect(communeSelect, uniqueCommunes, 'Toutes les communes');
        populateSelect(zoneSelect, uniqueZones, 'Toutes les zones');
        populateSelect(collineSelect, uniqueCollines, 'Toutes les collines');

        provinceSelect.addEventListener('change', function() {
            const provinceId = this.value;
            console.log('Province sélectionnée:', provinceId);

            let communesFiltered, zonesFiltered, collinesFiltered;

            if (provinceId !== 'all') {
                const selectedProvince = provinces.find(p => p.nom === provinceId);
                const provinceIdValue = selectedProvince ? selectedProvince.id : null;

                communesFiltered = getUniqueByName(communes.filter(c => c.province_id == provinceIdValue));
                zonesFiltered = getUniqueByName(zones.filter(z => z.province_id == provinceIdValue));
                collinesFiltered = getUniqueByName(collines.filter(c => c.province_id == provinceIdValue));
            } else {
                communesFiltered = uniqueCommunes;
                zonesFiltered = uniqueZones;
                collinesFiltered = uniqueCollines;
            }

            populateSelect(communeSelect, communesFiltered, 'Toutes les communes');
            populateSelect(zoneSelect, zonesFiltered, 'Toutes les zones');
            populateSelect(collineSelect, collinesFiltered, 'Toutes les collines');

            communeSelect.value = 'all';
            zoneSelect.value = 'all';
            collineSelect.value = 'all';

            applyFilters();
        });

        communeSelect.addEventListener('change', function() {
            const communeId = this.value;
            const provinceId = provinceSelect.value;
            console.log('Commune sélectionnée:', communeId);

            let zonesFiltered, collinesFiltered;

            if (communeId !== 'all') {
                const selectedCommune = communes.find(c => c.nom === communeId);
                const communeIdValue = selectedCommune ? selectedCommune.id : null;

                zonesFiltered = getUniqueByName(zones.filter(z => z.commune_id == communeIdValue));
                collinesFiltered = getUniqueByName(collines.filter(c => c.commune_id == communeIdValue));
            } else if (provinceId !== 'all') {
                const selectedProvince = provinces.find(p => p.nom === provinceId);
                const provinceIdValue = selectedProvince ? selectedProvince.id : null;

                zonesFiltered = getUniqueByName(zones.filter(z => z.province_id == provinceIdValue));
                collinesFiltered = getUniqueByName(collines.filter(c => c.province_id == provinceIdValue));
            } else {
                zonesFiltered = uniqueZones;
                collinesFiltered = uniqueCollines;
            }

            populateSelect(zoneSelect, zonesFiltered, 'Toutes les zones');
            populateSelect(collineSelect, collinesFiltered, 'Toutes les collines');

            zoneSelect.value = 'all';
            collineSelect.value = 'all';

            applyFilters();
        });

        zoneSelect.addEventListener('change', function() {
            const zoneId = this.value;
            const communeId = communeSelect.value;
            const provinceId = provinceSelect.value;
            console.log('Zone sélectionnée:', zoneId);

            let collinesFiltered;

            if (zoneId !== 'all') {
                const selectedZone = zones.find(z => z.nom === zoneId);
                const zoneIdValue = selectedZone ? selectedZone.id : null;

                collinesFiltered = getUniqueByName(collines.filter(c => c.zone_id == zoneIdValue));
            } else if (communeId !== 'all') {
                const selectedCommune = communes.find(c => c.nom === communeId);
                const communeIdValue = selectedCommune ? selectedCommune.id : null;

                collinesFiltered = getUniqueByName(collines.filter(c => c.commune_id == communeIdValue));
            } else if (provinceId !== 'all') {
                const selectedProvince = provinces.find(p => p.nom === provinceId);
                const provinceIdValue = selectedProvince ? selectedProvince.id : null;

                collinesFiltered = getUniqueByName(collines.filter(c => c.province_id == provinceIdValue));
            } else {
                collinesFiltered = uniqueCollines;
            }

            populateSelect(collineSelect, collinesFiltered, 'Toutes les collines');
            collineSelect.value = 'all';

            applyFilters();
        });

        collineSelect.addEventListener('change', function() {
            applyFilters();
        });

        const typeSelect = document.getElementById('typeStructureSelect');
        typeSelect.addEventListener('change', function() {
            currentTypeFilter = this.value;
            applyFilters();
        });

        document.getElementById('resetFilters').addEventListener('click', function() {
            provinceSelect.value = 'all';
            communeSelect.value = 'all';
            zoneSelect.value = 'all';
            collineSelect.value = 'all';
            typeSelect.value = 'all';
            currentTypeFilter = 'all';

            populateSelect(provinceSelect, uniqueProvinces, 'Toutes les provinces');
            populateSelect(communeSelect, uniqueCommunes, 'Toutes les communes');
            populateSelect(zoneSelect, uniqueZones, 'Toutes les zones');
            populateSelect(collineSelect, uniqueCollines, 'Toutes les collines');

            applyFilters();

            if (markersCluster && markersCluster.getBounds().isValid()) {
                map.fitBounds(markersCluster.getBounds(), {
                    padding: [50, 50]
                });
            }
        });
    }

    function applyFilters() {
        if (!markersCluster) return;

        const provinceId = document.getElementById('filterProvince').value;
        const communeId = document.getElementById('filterCommune').value;
        const zoneId = document.getElementById('filterZone').value;
        const collineId = document.getElementById('filterColline').value;

        console.log('Filtres appliqués:', {
            provinceId,
            communeId,
            zoneId,
            collineId
        });

        let filtered = [...allPoints];

        if (currentTypeFilter !== 'all') {
            filtered = filtered.filter(point => {
                if (point.type === 'colline') {
                    return point.type_structure_nom === currentTypeFilter;
                }
                return true;
            });
        }

        if (collineId !== 'all') {
            filtered = filtered.filter(p => p.type === 'colline' && p.nom === collineId);
        } else if (zoneId !== 'all') {
            const selectedZone = zones.find(z => z.nom === zoneId);
            const zoneIdValue = selectedZone ? selectedZone.id : null;

            filtered = filtered.filter(p =>
                (p.type === 'zone' && p.nom === zoneId) ||
                (p.type === 'colline' && p.zone_id == zoneIdValue)
            );
        } else if (communeId !== 'all') {
            const selectedCommune = communes.find(c => c.nom === communeId);
            const communeIdValue = selectedCommune ? selectedCommune.id : null;

            filtered = filtered.filter(p =>
                (p.type === 'commune' && p.nom === communeId) ||
                (p.type === 'zone' && p.commune_id == communeIdValue) ||
                (p.type === 'colline' && p.commune_id == communeIdValue)
            );
        } else if (provinceId !== 'all') {
            const selectedProvince = provinces.find(p => p.nom === provinceId);
            const provinceIdValue = selectedProvince ? selectedProvince.id : null;

            filtered = filtered.filter(p =>
                (p.type === 'province' && p.nom === provinceId) ||
                (p.type === 'commune' && p.province_id == provinceIdValue) ||
                (p.type === 'zone' && p.province_id == provinceIdValue) ||
                (p.type === 'colline' && p.province_id == provinceIdValue)
            );
        }

        console.log('Points filtrés:', filtered.length);

        markersCluster.clearLayers();
        filtered.forEach(point => {
            markersCluster.addLayer(createCustomColoredMarker(point, point.type));
        });
        map.addLayer(markersCluster);

        const filteredCollinesCount = filtered.filter(point => point.type === 'colline').length;
        document.getElementById('totalPointsDisplay').innerText = filteredCollinesCount;

        const filteredCollines = filtered.filter(p => p.type === 'colline');
        updateStatsDashboard(filteredCollines);
    }

    // ============================================
    // FLY TO GROUP
    // ============================================

    function flyToGroup(groupType) {
        let points = [];

        if (groupType === 'province') {
            points = uniqueProvinces;
        } else if (groupType === 'commune') {
            points = uniqueCommunes;
        } else if (groupType === 'zone') {
            points = uniqueZones;
        } else if (groupType === 'colline') {
            points = uniqueCollines;
        }

        if (points.length > 0) {
            const bounds = L.latLngBounds(points.map(p => [p.lat, p.lng]));
            map.fitBounds(bounds, {
                padding: [50, 50]
            });
        }
    }

    // ============================================
    // SHOW DETAILS
    // ============================================

    window.showDetails = function(collineId) {
        const colline = collines.find(c => c.id == collineId);
        if (!colline) return;

        let totalCollines = 1;
        let totalMembres = colline.nb_membres || 0;
        let totalHommes = colline.nb_hommes || 0;
        let totalFemmes = colline.nb_femmes || 0;
        let totalStructures = colline.nb_structures || 0;

        let tableRows = `
            <tr>
                <td style="text-align: left; font-weight: 500;">${escapeHtml(colline.zone_nom || 'N/A')}</td>
                <td style="text-align: center;">1</td>
                <td style="text-align: center;">${formatNumber(totalMembres)}</td>
                <td style="text-align: center;">${formatNumber(totalHommes)}</td>
                <td style="text-align: center;">${formatNumber(totalFemmes)}</td>
                <td style="text-align: center;">${totalStructures}</td>
            </tr>
        `;

        tableRows += `
            <tr class="total-row">
                <td style="text-align: left; font-weight: 700;"><strong>TOTAL</strong></td>
                <td style="text-align: center;"><strong>${totalCollines}</strong></td>
                <td style="text-align: center;"><strong>${formatNumber(totalMembres)}</strong></td>
                <td style="text-align: center;"><strong>${formatNumber(totalHommes)}</strong></td>
                <td style="text-align: center;"><strong>${formatNumber(totalFemmes)}</strong></td>
                <td style="text-align: center;"><strong>${totalStructures}</strong></td>
            </tr>
        `;

        const typeBadgeClass = colline.type_structure_nom === 'SLC' ? 'badge-slc' : 'badge-fonctionnel';
        const typeBadgeText = colline.type_structure_nom || 'Non défini';

        let descriptionHtml = '';
        if (colline.description && colline.description.trim() !== '') {
            descriptionHtml = `
                <div class="description-box">
                    <p>${escapeHtml(colline.description)}</p>
                </div>
            `;
        }

        const modalContent = `
            <div class="colline-detail-header">
                <h4>${escapeHtml(colline.nom)}</h4>
                <div class="detail-info-grid">
                    <div class="detail-info-item">
                        <label>Zone</label>
                        <div class="value">${escapeHtml(colline.zone_nom || 'N/A')}</div>
                    </div>
                    <div class="detail-info-item">
                        <label>Commune</label>
                        <div class="value">${escapeHtml(colline.commune_nom || 'N/A')}</div>
                    </div>
                    <div class="detail-info-item">
                        <label>Province</label>
                        <div class="value">${escapeHtml(colline.province_nom || 'N/A')}</div>
                    </div>
                    <div class="detail-info-item">
                        <label>Type de structure</label>
                        <div class="value">
                            <span class="badge-type ${typeBadgeClass}">${escapeHtml(typeBadgeText)}</span>
                        </div>
                    </div>
                    <div class="detail-info-item">
                        <label>Membres</label>
                        <div class="value">${formatNumber(colline.nb_membres)}</div>
                    </div>
                    <div class="detail-info-item">
                        <label>Hommes / Femmes</label>
                        <div class="value">${formatNumber(colline.nb_hommes)} / ${formatNumber(colline.nb_femmes)}</div>
                    </div>
                    <div class="detail-info-item">
                        <label>Structures</label>
                        <div class="value">${colline.nb_structures}</div>
                    </div>
                </div>
            </div>
            ${descriptionHtml}
            <div class="stats-section">
                <h5>Statistiques de la colline: ${escapeHtml(colline.nom)}</h5>
                <div class="stats-table-wrapper">
                    <table class="stats-table" id="detailsTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Zone</th>
                                <th style="text-align: center;">Collines</th>
                                <th style="text-align: center;">Beneficiaires</th>
                                <th style="text-align: center;">Hommes</th>
                                <th style="text-align: center;">Femmes</th>
                                <th style="text-align: center;">Structures</th>
                            </tr>
                        </thead>
                        <tbody>${tableRows}</tbody>
                    </table>
                </div>
            </div>
        `;

        document.getElementById('modalCollineInfo').innerHTML = modalContent;

        setTimeout(() => {
            if ($.fn.DataTable.isDataTable('#detailsTable')) {
                $('#detailsTable').DataTable().destroy();
            }
            $('#detailsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json',
                    search: "Rechercher:",
                    lengthMenu: "Afficher _MENU_ entrées",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ zones"
                },
                pageLength: 10,
                scrollX: false,
                autoWidth: true,
                columnDefs: [{
                        targets: 0,
                        className: 'dt-left',
                        orderable: true
                    },
                    {
                        targets: [1, 2, 3, 4, 5],
                        className: 'dt-center',
                        orderable: true
                    }
                ]
            });
        }, 100);

        $('#detailModal').modal('show');
    };

    // ============================================
    // INITIALISATION
    // ============================================

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('preloader').style.display = 'none';
        initMarkers();
        initFilters();

        setTimeout(function() {
            const allCollines = collines.map(c => ({
                ...c,
                type: 'colline'
            }));
            updateStatsDashboard(allCollines);
        }, 300);
    });
    </script>
</body>

</html>
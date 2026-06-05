<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biraturaba - Cartographie</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        .map-layout { display: flex; gap: 20px; flex-wrap: wrap; }
        .map-col { flex: 2; min-width: 300px; }
        .sidebar-col { flex: 1; min-width: 280px; }
        
        #map { height: 70vh; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        
        .sidebar {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            height: 70vh;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            padding: 15px;
            text-align: center;
        }
        
        .sidebar-header h3 { margin: 0; font-size: 18px; }
        
        .sidebar-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 15px;
            color: white;
        }
        .stats-card .number { font-size: 28px; font-weight: bold; }
        
        .filter-box {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .filter-box select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .filter-box button {
            width: 100%;
            padding: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 5px;
        }
        
        .group-card {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            border-left: 4px solid;
            cursor: pointer;
        }
        .group-card.group1 { border-left-color: #FF0000; }
        .group-card.group2 { border-left-color: #00CC00; }
        .group-card.group3 { border-left-color: #0000FF; }
        .group-card.group4 { border-left-color: #800080; }
        .group-name { font-weight: bold; font-size: 14px; }
        .group-count { font-size: 20px; font-weight: bold; }
        
        .point-item {
            background: #f8f9fa;
            padding: 8px;
            margin-bottom: 6px;
            border-radius: 8px;
            border-left: 3px solid;
            cursor: pointer;
        }
        .point-name { font-weight: bold; font-size: 12px; }
        .point-info { font-size: 10px; color: #666; }
        
        .cluster-legend {
            background: #f0f2f5;
            padding: 12px;
            border-radius: 10px;
            margin-top: 15px;
        }
        .cluster-sizes { display: flex; gap: 10px; flex-wrap: wrap; margin: 10px 0; }
        .cluster-demo { text-align: center; }
        .cluster-circle {
            width: 35px; height: 35px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: bold; margin: 0 auto;
        }
        .cluster-circle.small { background: #FF6B6B; width: 30px; height: 30px; }
        .cluster-circle.medium { background: #FF8E53; width: 40px; height: 40px; }
        .cluster-circle.large { background: #F7971E; width: 50px; height: 50px; }
        .cluster-label { font-size: 10px; margin-top: 5px; }
        
        h4 { font-size: 13px; margin: 10px 0 5px 0; color: #333; }
        
        @media (max-width: 768px) {
            .map-col, .sidebar-col { flex: 100%; }
            .sidebar { height: auto; margin-top: 15px; }
            #map { height: 50vh; }
        }
    </style>
</head>
<body>

<div class="container">
    <h1 style="margin-bottom: 20px;">🗺️ Cartographie des zones d'intervention</h1>
    
    <div class="map-layout">
        <div class="map-col">
            <div id="map"></div>
        </div>
        
        <div class="sidebar-col">
            <div class="sidebar">
                <div class="sidebar-header">
                    <h3>📊 Tableau de bord</h3>
                </div>
                <div class="sidebar-body">
                    <!-- Stats totales -->
                    <div class="stats-card">
                        <div class="number" id="totalPoints">0</div>
                        <div>Points sur la carte</div>
                    </div>
                    
                    <!-- Filtres -->
                    <div class="filter-box">
                        <h4>🔍 Filtrer</h4>
                        <select id="filterProvince">
                            <option value="all">Toutes les provinces</option>
                        </select>
                        <select id="filterCommune" disabled>
                            <option value="all">Toutes les communes</option>
                        </select>
                        <select id="filterZone" disabled>
                            <option value="all">Toutes les zones</option>
                        </select>
                        <button id="resetFilters">🔄 Réinitialiser</button>
                    </div>
                    
                    <!-- Stats intervention -->
                    <div class="stats-card" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                        <div style="display: flex; justify-content: space-around;">
                            <div><span id="totalSites">0</span><br><small>Sites</small></div>
                            <div><span id="totalMembres">0</span><br><small>Membres</small></div>
                            <div><span id="totalHommes">0</span><br><small>Hommes</small></div>
                            <div><span id="totalFemmes">0</span><br><small>Femmes</small></div>
                        </div>
                    </div>
                    
                    <!-- Groupes -->
                    <div id="groupsList"></div>
                    
                    <!-- Points récents -->
                    <h4>📍 Points récents</h4>
                    <div id="pointsList"></div>
                    
                    <!-- Légende clusters -->
                    <div class="cluster-legend">
                        <h4>📊 Zones regroupées</h4>
                        <div class="cluster-sizes">
                            <div class="cluster-demo"><div class="cluster-circle small">3</div><div class="cluster-label">1-4 pts</div></div>
                            <div class="cluster-demo"><div class="cluster-circle medium">12</div><div class="cluster-label">5-14 pts</div></div>
                            <div class="cluster-demo"><div class="cluster-circle large">28</div><div class="cluster-label">15+ pts</div></div>
                        </div>
                        <small>💡 Survolez un cluster pour voir sa composition</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<script>
// Données PHP
const mesdonnees = <?= json_encode($mesdonnees ?? '') ?>;
const mesdonnees2 = <?= json_encode($mesdonnees2 ?? '') ?>;
const mesdonnees3 = <?= json_encode($mesdonnees3 ?? '') ?>;
const mesdonnees4 = <?= json_encode($mesdonnees4 ?? '') ?>;

const totalSites = <?= $total_sites ?? 0 ?>;
const totalMembres = <?= $total_membres ?? 0 ?>;
const totalHommes = <?= $total_hommes ?? 0 ?>;
const totalFemmes = <?= $total_femmes ?? 0 ?>;

// Afficher les stats
document.getElementById('totalSites').innerText = totalSites;
document.getElementById('totalMembres').innerText = totalMembres;
document.getElementById('totalHommes').innerText = totalHommes;
document.getElementById('totalFemmes').innerText = totalFemmes;

// Configuration des groupes
const groupConfig = {
    group1: { color: '#FF0000', icon: '🏢', name: 'Provinces' },
    group2: { color: '#00CC00', icon: '🏛️', name: 'Communes' },
    group3: { color: '#0000FF', icon: '📍', name: 'Zones' },
    group4: { color: '#800080', icon: '🏥', name: 'Sites intervention' }
};

// Initialisation de la carte
const map = L.map('map').setView([-3.38, 29.36], 10);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap',
    maxZoom: 19
}).addTo(map);

// Cluster group
const markers = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: true,
    zoomToBoundsOnClick: true,
    maxClusterRadius: 70,
    iconCreateFunction: function(cluster) {
        const count = cluster.getChildCount();
        let size = 35, bg = '#FF6B6B';
        if (count >= 5 && count < 15) { size = 45; bg = '#FF8E53'; }
        else if (count >= 15) { size = 55; bg = '#F7971E'; }
        
        return L.divIcon({
            html: `<div style="background:${bg}; width:${size}px; height:${size}px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:${size/3}px; border:2px solid white;">${count}</div>`,
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
function createMarker(lat, lng, config, id, title, info, groupId) {
    const iconHtml = `<div style="background: ${config.color}; width: 30px; height: 30px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 0 2px ${config.color}; display: flex; align-items: center; justify-content: center; font-size: 16px;">${config.icon}</div>`;
    const icon = L.divIcon({ html: iconHtml, className: 'custom-marker', iconSize: [30, 30], popupAnchor: [0, -15] });
    const marker = L.marker([lat, lng], { icon: icon });
    marker.options.groupId = groupId;
    
    const popupContent = `<b>${config.icon} ${title}</b><br>${info}`;
    marker.bindPopup(popupContent);
    return marker;
}

// Fonction pour parser les données
function parseData(rawData, group) {
    if (!rawData || rawData === '') return;
    const points = rawData.split('@');
    for (let i = 0; i < points.length; i++) {
        if (!points[i]) continue;
        const parts = points[i].split('<>');
        if (parts.length < 4) continue;
        
        const id = parts[0];
        const title = parts[1];
        const lat = parseFloat(parts[2]);
        const lng = parseFloat(parts[3]);
        const info = parts[4] || '';
        
        if (isNaN(lat) || isNaN(lng)) continue;
        
        const config = groupConfig[group];
        const marker = createMarker(lat, lng, config, id, title, info, group);
        markers.addLayer(marker);
        
        allPoints.push({ id, title, lat, lng, info, group, groupIcon: config.icon, groupName: config.name });
        groupCounts[group]++;
    }
}

// Charger les données
parseData(mesdonnees, 'group1');
parseData(mesdonnees2, 'group2');
parseData(mesdonnees3, 'group3');
parseData(mesdonnees4, 'group4');

// Mise à jour du total
document.getElementById('totalPoints').innerText = allPoints.length;

// Génération des groupes
const groupsList = document.getElementById('groupsList');
groupsList.innerHTML = '';
for (let i = 1; i <= 4; i++) {
    const group = 'group' + i;
    if (groupCounts[group] > 0) {
        groupsList.innerHTML += `
            <div class="group-card ${group}" data-group="${group}">
                <div class="group-name">${groupConfig[group].icon} ${groupConfig[group].name}</div>
                <div class="group-count" id="${group}Count">${groupCounts[group]}</div>
                <small>points</small>
            </div>
        `;
    }
}

// Points récents (les 10 derniers)
const pointsList = document.getElementById('pointsList');
if (allPoints.length > 0) {
    const recentPoints = allPoints.slice(-10).reverse();
    pointsList.innerHTML = recentPoints.map(p => `
        <div class="point-item ${p.group}" onclick="flyToPoint(${p.lat}, ${p.lng})">
            <div class="point-name">${p.groupIcon} ${p.title}</div>
            <div class="point-info">${p.info.substring(0, 50)}</div>
        </div>
    `).join('');
} else {
    pointsList.innerHTML = '<div style="text-align:center;color:#999;padding:20px;">Aucun point</div>';
}

// Ajout des marqueurs à la carte
map.addLayer(markers);

// Ajuster la vue
if (allPoints.length > 0) {
    const bounds = markers.getBounds();
    if (bounds.isValid()) map.fitBounds(bounds, { padding: [50, 50] });
}

// Fonction pour voler vers un point
window.flyToPoint = function(lat, lng) {
    map.flyTo([lat, lng], 14, { duration: 1 });
};

// Remplir les filtres
const provinces = [...new Map(allPoints.filter(p => p.group === 'group1').map(p => [p.id, p.title])).entries()];
const provinceSelect = document.getElementById('filterProvince');
provinces.forEach(([id, name]) => {
    provinceSelect.innerHTML += `<option value="${id}">${name}</option>`;
});

// Filtrer la carte
function filterMap() {
    const provinceId = document.getElementById('filterProvince').value;
    const communeId = document.getElementById('filterCommune').value;
    const zoneId = document.getElementById('filterZone').value;
    
    markers.clearLayers();
    
    let filtered = allPoints;
    if (provinceId !== 'all') {
        filtered = filtered.filter(p => p.id == provinceId && p.group === 'group1');
    }
    
    filtered.forEach(p => {
        const config = groupConfig[p.group];
        const marker = createMarker(p.lat, p.lng, config, p.id, p.title, p.info, p.group);
        markers.addLayer(marker);
    });
    
    map.addLayer(markers);
    document.getElementById('totalPoints').innerText = filtered.length;
}

// Réinitialiser les filtres
document.getElementById('resetFilters').addEventListener('click', () => {
    document.getElementById('filterProvince').value = 'all';
    markers.clearLayers();
    allPoints.forEach(p => {
        const config = groupConfig[p.group];
        const marker = createMarker(p.lat, p.lng, config, p.id, p.title, p.info, p.group);
        markers.addLayer(marker);
    });
    map.addLayer(markers);
    document.getElementById('totalPoints').innerText = allPoints.length;
    if (allPoints.length > 0) {
        const bounds = markers.getBounds();
        if (bounds.isValid()) map.fitBounds(bounds, { padding: [50, 50] });
    }
});

// Événements filtres
provinceSelect.addEventListener('change', filterMap);

// Click sur les groupes
document.querySelectorAll('.group-card').forEach(card => {
    card.addEventListener('click', function() {
        const group = this.dataset.group;
        const groupPoints = allPoints.filter(p => p.group === group);
        if (groupPoints.length > 0) {
            const bounds = L.latLngBounds(groupPoints.map(p => [p.lat, p.lng]));
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    });
});

console.log('✅ Carte chargée avec', allPoints.length, 'points');
</script>

<?php echo view('includes/frontend/footer'); ?>
</body>
</html>
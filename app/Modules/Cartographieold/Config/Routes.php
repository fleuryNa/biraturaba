<?php

namespace App\Modules\Cartographie\Config;

use CodeIgniter\Router\RouteCollection;

// Groupe principal pour le module cartographie
$routes->group('cartographie', static function (RouteCollection $routes) {
    // Pages principales
    $routes->get('/', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::index');
    $routes->get('index', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::index');
    
    // Zones d'intervention
    $routes->get('zones', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::zones');
    $routes->get('zone/(:num)', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::zoneDetail/$1');
    $routes->post('zone/save', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::saveZone');
    $routes->delete('zone/(:num)', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::deleteZone/$1');
    
    // API pour Mapbox (retourne des données JSON)
    $routes->get('api/zones', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::apiGetZones');
    $routes->get('api/zone/(:num)', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::apiGetZone/$1');
    $routes->post('api/zone/save', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::apiSaveZone');
    $routes->delete('api/zone/(:num)', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::apiDeleteZone/$1');
    
    // Points d'intérêt
    $routes->get('points', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::points');
    $routes->post('point/save', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::savePoint');
    $routes->delete('point/(:num)', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::deletePoint/$1');
    
    // Géolocalisation
    $routes->get('recherche', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::recherche');
    $routes->post('geocode', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::geocode');
    
    // Export
    $routes->get('export/zones', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::exportZones');
    $routes->get('export/geojson', '\\App\Modules\\Cartographie\\Controllers\\Cartographie::exportGeoJson');
});
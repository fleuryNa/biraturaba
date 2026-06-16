<?php

namespace App\Modules\Cartographie\Controllers;

use App\Controllers\BaseController;

class Carto extends BaseController
{
    protected $helpers = ['url'];
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // ==================== RÉCUPÉRATION DES TYPES DE STRUCTURES DEPUIS LA BASE ====================
        $sql_types = "SELECT ID_TYPE_GROUPE as id, DESC_GROUPE as nom FROM type_groupes ORDER BY DESC_GROUPE";
        $types_structure = $this->db->query($sql_types)->getResultArray();

        // ==================== STATISTIQUES PAR TYPE DE STRUCTURE (pour affichage initial) ====================
        $sql_stats_types = "
            SELECT 
                tg.DESC_GROUPE as type_structure,
                COUNT(DISTINCT mi.ID_MEMBRES) as nb_collines,
                SUM(mi.NB_MEMBRE_INSCRITS) as total_membres,
                SUM(mi.NOMBRE_HOMME) as total_hommes,
                SUM(mi.NOMBRE_FEMME) as total_femmes,
                SUM(mi.NB_GROUPE) as total_structures
            FROM membres_inscrits mi
            LEFT JOIN type_groupes tg ON mi.ID_TYPE_GROUPE = tg.ID_TYPE_GROUPE
            WHERE mi.NB_MEMBRE_INSCRITS > 0
            GROUP BY tg.DESC_GROUPE
            ORDER BY total_membres DESC
        ";
        $stats_par_type = $this->db->query($sql_stats_types)->getResultArray();

        // ==================== REQUÊTE UNIQUE POUR TOUT RÉCUPÉRER DEPUIS MEMBRES_INSCRITS ====================
        $sql = "
        SELECT 
            -- Infos membres_inscrits
            mi.ID_MEMBRES as membres_id,
            mi.DESCRIPTION as description,
            mi.NB_GROUPE as nb_structures,
            mi.NB_MEMBRE_INSCRITS as nb_membres,
            mi.NOMBRE_HOMME as nb_hommes,
            mi.NOMBRE_FEMME as nb_femmes,
            mi.ID_TYPE_GROUPE,
            tg.DESC_GROUPE as type_structure_nom,
            
            -- Infos collines
            c.COLLINE_ID,
            c.COLLINE_NAME as colline_nom,
            c.LATITUDE as colline_lat,
            c.LONGITUDE as colline_lng,
            
            -- Infos zones
            z.ZONE_ID,
            z.ZONE_NAME as zone_nom,
            z.LATITUDE as zone_lat,
            z.LONGITUDE as zone_lng,
            
            -- Infos communes
            cm.COMMUNE_ID,
            cm.COMMUNE_NAME as commune_nom,
            cm.COMMUNE_LATITUDE as commune_lat,
            cm.COMMUNE_LONGITUDE as commune_lng,
            
            -- Infos provinces
            p.PROVINCE_ID,
            p.PROVINCE_NAME as province_nom,
            p.PROVINCE_LATITUDE as province_lat,
            p.PROVINCE_LONGITUDE as province_lng

        FROM membres_inscrits mi
        JOIN collines c ON mi.COLLINE_ID = c.COLLINE_ID
        JOIN zones z ON c.ZONE_ID = z.ZONE_ID
        JOIN communes cm ON z.COMMUNE_ID = cm.COMMUNE_ID
        JOIN provinces p ON cm.PROVINCE_ID = p.PROVINCE_ID
        LEFT JOIN type_groupes tg ON mi.ID_TYPE_GROUPE = tg.ID_TYPE_GROUPE
        WHERE mi.NB_MEMBRE_INSCRITS > 0
        GROUP BY mi.ID_MEMBRES, mi.DESCRIPTION, mi.NB_GROUPE, mi.NB_MEMBRE_INSCRITS, 
                 mi.NOMBRE_HOMME, mi.NOMBRE_FEMME, mi.ID_TYPE_GROUPE, tg.DESC_GROUPE,
                 c.COLLINE_ID, c.COLLINE_NAME, c.LATITUDE, c.LONGITUDE,
                 z.ZONE_ID, z.ZONE_NAME, z.LATITUDE, z.LONGITUDE,
                 cm.COMMUNE_ID, cm.COMMUNE_NAME, cm.COMMUNE_LATITUDE, cm.COMMUNE_LONGITUDE,
                 p.PROVINCE_ID, p.PROVINCE_NAME, p.PROVINCE_LATITUDE, p.PROVINCE_LONGITUDE
        ORDER BY mi.NB_MEMBRE_INSCRITS DESC
    ";
    
    $membres_data = $this->db->query($sql)->getResultArray();
     

        // ==================== RÉCUPÉRATION DU NOMBRE DE COMMUNES PAR PROVINCE ====================
        $province_ids_with_data = array_unique(array_column($membres_data, 'PROVINCE_ID'));
        $nb_communes_par_province = [];
        
        if (!empty($province_ids_with_data)) {
            $province_ids_str = implode(',', $province_ids_with_data);
            $sql_communes_count = "
                SELECT 
                    p.PROVINCE_ID,
                    COUNT(DISTINCT c.COMMUNE_ID) as nb_communes
                FROM provinces p
                LEFT JOIN communes c ON p.PROVINCE_ID = c.PROVINCE_ID
                WHERE p.PROVINCE_ID IN ($province_ids_str)
                GROUP BY p.PROVINCE_ID
            ";
            $communes_counts = $this->db->query($sql_communes_count)->getResultArray();
            foreach ($communes_counts as $count) {
                $nb_communes_par_province[$count['PROVINCE_ID']] = $count['nb_communes'];
            }
        }

        // ==================== EXTRACTION ET DÉDUPLICATION DES DONNÉES ====================
        
        // 1. Extraction des provinces
        $provinces_temp = [];
        foreach ($membres_data as $row) {
            $province_id = $row['PROVINCE_ID'];
            if (!isset($provinces_temp[$province_id])) {
                $provinces_temp[$province_id] = [
                    'id' => $province_id,
                    'nom' => $row['province_nom'],
                    'lat' => $row['province_lat'],
                    'lng' => $row['province_lng'],
                    'nb_communes' => $nb_communes_par_province[$province_id] ?? 0
                ];
            }
        }
        $provinces = array_values($provinces_temp);
        
        // 2. Extraction des communes
        $communes_temp = [];
        foreach ($membres_data as $row) {
            $commune_id = $row['COMMUNE_ID'];
            if (!isset($communes_temp[$commune_id])) {
                $communes_temp[$commune_id] = [
                    'id' => $commune_id,
                    'nom' => $row['commune_nom'],
                    'lat' => $row['commune_lat'],
                    'lng' => $row['commune_lng'],
                    'province_nom' => $row['province_nom'],
                    'province_id' => $row['PROVINCE_ID']
                ];
            }
        }
        $communes = array_values($communes_temp);
        
        // 3. Extraction des zones
        $zones_temp = [];
        foreach ($membres_data as $row) {
            $zone_id = $row['ZONE_ID'];
            if (!isset($zones_temp[$zone_id])) {
                $zones_temp[$zone_id] = [
                    'id' => $zone_id,
                    'nom' => $row['zone_nom'],
                    'lat' => $row['zone_lat'],
                    'lng' => $row['zone_lng'],
                    'commune_nom' => $row['commune_nom'],
                    'commune_id' => $row['COMMUNE_ID']
                ];
            }
        }
        $zones = array_values($zones_temp);
        
        // 4. Données des collines avec membres - GESTION DES COORDONNÉES INVALIDES
        $collines = [];
        
        foreach ($membres_data as $row) {
            $lat = $row['colline_lat'];
            $lng = $row['colline_lng'];
            $coord_modifiee = false;
            
            // Vérifier si les coordonnées sont invalides (2, -1, ou vides)
            if ($lat == -1 || $lat == 2 || empty($lat) || $lng == -1 || $lng == 2 || empty($lng)) {
                $coord_modifiee = true;
                // Utiliser les coordonnées de la zone si disponibles
                if ($row['zone_lat'] != -1 && $row['zone_lat'] != 2 && !empty($row['zone_lat']) &&
                    $row['zone_lng'] != -1 && $row['zone_lng'] != 2 && !empty($row['zone_lng'])) {
                    $lat = $row['zone_lat'];
                    $lng = $row['zone_lng'];
                }
                // Sinon utiliser les coordonnées de la commune
                elseif ($row['commune_lat'] != -1 && $row['commune_lat'] != 2 && !empty($row['commune_lat']) &&
                        $row['commune_lng'] != -1 && $row['commune_lng'] != 2 && !empty($row['commune_lng'])) {
                    $lat = $row['commune_lat'];
                    $lng = $row['commune_lng'];
                }
                // Sinon utiliser les coordonnées de la province
                elseif ($row['province_lat'] != -1 && $row['province_lat'] != 2 && !empty($row['province_lat']) &&
                        $row['province_lng'] != -1 && $row['province_lng'] != 2 && !empty($row['province_lng'])) {
                    $lat = $row['province_lat'];
                    $lng = $row['province_lng'];
                }
                // Dernier recours : coordonnées par défaut du Burundi
                else {
                    $lat = -3.3804751;
                    $lng = 29.3604533;
                }
            }
            
           $collines[] = [
    'id' => $row['membres_id'],
    'COLLINE_ID' => $row['COLLINE_ID'],
    'nom' => $row['colline_nom'],
    'lat' => (float)$lat,
    'lng' => (float)$lng,
    'description' => $row['description'] ?? '',
    'coord_modifiee' => $coord_modifiee,
    'type_structure_nom' => $row['type_structure_nom'] ?? 'Non défini',
    'zone_nom' => $row['zone_nom'],
    'zone_id' => $row['ZONE_ID'],
    'commune_nom' => $row['commune_nom'],
    'commune_id' => $row['COMMUNE_ID'],
    'province_nom' => $row['province_nom'],
    'province_id' => $row['PROVINCE_ID'],
    'nb_membres' => (int)$row['nb_membres'],
    'nb_hommes' => (int)$row['nb_hommes'],
    'nb_femmes' => (int)$row['nb_femmes'],
    'nb_structures' => (int)$row['nb_structures']
];
        }

        // ==================== CONSTRUCTION DES DONNEES POUR LA VUE ====================
        $provinces_list = [];
        $communes_list = [];
        $zones_list = [];
        $collines_list = [];
        
        foreach ($provinces as $province) {
            $lat = ($province['lat'] != -1 && !empty($province['lat'])) ? (float)$province['lat'] : -3.38;
            $lng = ($province['lng'] != -1 && !empty($province['lng'])) ? (float)$province['lng'] : 29.36;
            
            $provinces_list[] = [
                'id' => $province['id'],
                'nom' => $province['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'info' => "🏢 " . $province['nb_communes'] . " communes",
                'detail' => "Siège provincial"
            ];
        }

        foreach ($communes as $commune) {
            $lat = ($commune['lat'] != -1 && !empty($commune['lat'])) ? (float)$commune['lat'] : -3.38;
            $lng = ($commune['lng'] != -1 && !empty($commune['lng'])) ? (float)$commune['lng'] : 29.36;
            
            $communes_list[] = [
                'id' => $commune['id'],
                'nom' => $commune['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'info' => "🏛️ " . $commune['province_nom'],
                'detail' => "Chef-lieu de commune",
                'province_id' => $commune['province_id']
            ];
        }

        foreach ($zones as $zone) {
            $lat = ($zone['lat'] != -1 && $zone['lat'] != 2 && !empty($zone['lat'])) ? (float)$zone['lat'] : -3.38;
            $lng = ($zone['lng'] != -1 && $zone['lng'] != 2 && !empty($zone['lng'])) ? (float)$zone['lng'] : 29.36;
            
            $zones_list[] = [
                'id' => $zone['id'],
                'nom' => $zone['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'info' => "📍 " . $zone['commune_nom'],
                'detail' => "Zone de regroupement",
                'commune_id' => $zone['commune_id']
            ];
        }

       foreach ($collines as $colline) {
    $collines_list[] = [
        'id' => $colline['id'],
        'COLLINE_ID' => $colline['COLLINE_ID'],
        'nom' => $colline['nom'],
        'lat' => $colline['lat'],
        'lng' => $colline['lng'],
        'description' => $colline['description'],
        'info' => "🏥 " . $colline['zone_nom'] . " | " . $colline['commune_nom'] . " | " . $colline['province_nom'] . " | 📌 Type: " . $colline['type_structure_nom'],
        'detail' => "👥 " . $colline['nb_membres'] . " membres | 👨 " . $colline['nb_hommes'] . " H | 👩 " . $colline['nb_femmes'] . " F | 📊 " . $colline['nb_structures'] . " structures",
        'type_structure_nom' => $colline['type_structure_nom'],
        'zone_nom' => $colline['zone_nom'],
        'zone_id' => $colline['zone_id'],
        'commune_nom' => $colline['commune_nom'],
        'commune_id' => $colline['commune_id'],
        'province_nom' => $colline['province_nom'],
        'province_id' => $colline['province_id'],
        'nb_membres' => $colline['nb_membres'],
        'nb_hommes' => $colline['nb_hommes'],
        'nb_femmes' => $colline['nb_femmes'],
        'nb_structures' => $colline['nb_structures']
    ];
}

        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'provinces' => json_encode($provinces_list),
            'communes' => json_encode($communes_list),
            'zones' => json_encode($zones_list),
            'collines' => json_encode($collines_list),
            'types_structure' => $types_structure,
            'stats_par_type' => $stats_par_type,
            'stats' => [
                'total_provinces' => count($provinces_list),
                'total_communes' => count($communes_list),
                'total_zones' => count($zones_list),
                'total_sites' => count($collines_list),
                'total_membres' => array_sum(array_column($collines_list, 'nb_membres')),
                'total_hommes' => array_sum(array_column($collines_list, 'nb_hommes')),
                'total_femmes' => array_sum(array_column($collines_list, 'nb_femmes')),
                'total_structures' => array_sum(array_column($collines_list, 'nb_structures'))
            ]
        ];

        $data['partenaires'] = $this->model->getRequete("SELECT p.* FROM partners p
        GROUP BY p.ID_PARTNERS ");

        return view('App\Modules\Cartographie\Views\CartoFront', $data);
    }
}
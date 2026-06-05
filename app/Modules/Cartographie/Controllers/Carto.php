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
        // ==================== REQUÊTE UNIQUE POUR TOUT RÉCUPÉRER DEPUIS MEMBRES_INSCRITS ====================
        $sql = "
            SELECT 
                -- Infos membres_inscrits
                mi.ID_MEMBRES as membres_id,
                mi.NB_GROUPE_FONCTIONNELS as nb_groupes_fonctionnels,
                mi.NB_MEMBRE_INSCRITS as nb_membres,
                mi.NOMBRE_HOMME as nb_hommes,
                mi.NOMBRE_FEMME as nb_femmes,
                
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
            WHERE mi.NB_MEMBRE_INSCRITS > 0
            GROUP BY mi.ID_MEMBRES
            ORDER BY mi.NB_MEMBRE_INSCRITS DESC
        ";
        
        $membres_data = $this->db->query($sql)->getResultArray();

        // ==================== RÉCUPÉRATION DU NOMBRE DE COMMUNES PAR PROVINCE ====================
        $nb_communes_par_province = [];
        $sql_communes_count = "
            SELECT 
                p.PROVINCE_ID,
                COUNT(DISTINCT c.COMMUNE_ID) as nb_communes
            FROM provinces p
            LEFT JOIN communes c ON p.PROVINCE_ID = c.PROVINCE_ID
            GROUP BY p.PROVINCE_ID
        ";
        $communes_counts = $this->db->query($sql_communes_count)->getResultArray();
        foreach ($communes_counts as $count) {
            $nb_communes_par_province[$count['PROVINCE_ID']] = $count['nb_communes'];
        }

        // ==================== EXTRACTION ET DÉDUPLICATION DES DONNÉES ====================
        
        // 1. Extraction des provinces (uniques)
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
        
        // 2. Extraction des communes (uniques)
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
        
        // 3. Extraction des zones (uniques)
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
        
        // 4. Données des collines avec membres (déjà dans $membres_data)
        $collines = [];
        foreach ($membres_data as $row) {
            $collines[] = [
                'id' => $row['membres_id'],
                'COLLINE_ID' => $row['COLLINE_ID'],
                'nom' => $row['colline_nom'],
                'lat' => $row['colline_lat'],
                'lng' => $row['colline_lng'],
                'zone_nom' => $row['zone_nom'],
                'zone_id' => $row['ZONE_ID'],
                'commune_nom' => $row['commune_nom'],
                'commune_id' => $row['COMMUNE_ID'],
                'province_nom' => $row['province_nom'],
                'province_id' => $row['PROVINCE_ID'],
                'nb_membres' => $row['nb_membres'],
                'nb_hommes' => $row['nb_hommes'],
                'nb_femmes' => $row['nb_femmes'],
                'nb_groupes_fonctionnels' => $row['nb_groupes_fonctionnels']
            ];
        }

        // ==================== CONSTRUCTION DES DONNEES POUR LA VUE ====================
        $mesdonnees = "";   // Groupe 1 - Provinces
        $mesdonnees2 = "";  // Groupe 2 - Communes
        $mesdonnees3 = "";  // Groupe 3 - Zones
        $mesdonnees4 = "";  // Groupe 4 - Collines
        $points = [];
        
        $total_membres = 0;
        $total_hommes = 0;
        $total_femmes = 0;
        $total_groupes = 0;
        $total_sites = count($collines);

        // Construction du message pour les provinces (groupe 1)
        foreach ($provinces as $province) {
            $lat = ($province['lat'] != -1 && !empty($province['lat'])) ? floatval($province['lat']) : -3.38;
            $lng = ($province['lng'] != -1 && !empty($province['lng'])) ? floatval($province['lng']) : 29.36;
            
            $info = "🏢 " . $province['nb_communes'] . " communes";
            $detail = "Siège provincial";
            
            $formatted = $province['id'] . "<>" . $province['nom'] . "<>" . $lat . "<>" . $lng . "<>" . $info . "<>" . $detail;
            $mesdonnees .= ($mesdonnees ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 1,
                'id' => $province['id'],
                'nom' => $province['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'icon' => '🏢',
                'info' => $info,
                'detail' => $detail
            ];
        }

        // Construction du message pour les communes (groupe 2)
        foreach ($communes as $commune) {
            $lat = ($commune['lat'] != -1 && !empty($commune['lat'])) ? floatval($commune['lat']) : -3.38;
            $lng = ($commune['lng'] != -1 && !empty($commune['lng'])) ? floatval($commune['lng']) : 29.36;
            
            $info = "🏛️ " . $commune['province_nom'];
            $detail = "Chef-lieu de commune";
            
            $formatted = $commune['id'] . "<>" . $commune['nom'] . "<>" . $lat . "<>" . $lng . "<>" . $info . "<>" . $detail;
            $mesdonnees2 .= ($mesdonnees2 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 2,
                'id' => $commune['id'],
                'nom' => $commune['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'icon' => '🏛️',
                'info' => $info,
                'detail' => $detail,
                'province_id' => $commune['province_id']
            ];
        }

        // Construction du message pour les zones (groupe 3)
        foreach ($zones as $zone) {
            $lat = ($zone['lat'] != -1 && $zone['lat'] != 2 && !empty($zone['lat'])) ? floatval($zone['lat']) : -3.38;
            $lng = ($zone['lng'] != -1 && $zone['lng'] != 2 && !empty($zone['lng'])) ? floatval($zone['lng']) : 29.36;
            
            $info = "📍 " . $zone['commune_nom'];
            $detail = "Zone de regroupement";
            
            $formatted = $zone['id'] . "<>" . $zone['nom'] . "<>" . $lat . "<>" . $lng . "<>" . $info . "<>" . $detail;
            $mesdonnees3 .= ($mesdonnees3 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 3,
                'id' => $zone['id'],
                'nom' => $zone['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'icon' => '📍',
                'info' => $info,
                'detail' => $detail,
                'commune_id' => $zone['commune_id']
            ];
        }

        // Construction du message pour les collines avec membres (groupe 4)
        foreach ($collines as $colline) {
            $lat = ($colline['lat'] != -1 && $colline['lat'] != 2 && !empty($colline['lat'])) ? floatval($colline['lat']) : -3.38;
            $lng = ($colline['lng'] != -1 && $colline['lng'] != 2 && !empty($colline['lng'])) ? floatval($colline['lng']) : 29.36;
            
            $info = "🏥 " . $colline['zone_nom'] . " | " . $colline['commune_nom'] . " | " . $colline['province_nom'];
            $detail = "👥 " . $colline['nb_membres'] . " membres | 👨 " . $colline['nb_hommes'] . " H | 👩 " . $colline['nb_femmes'] . " F | 📊 " . $colline['nb_groupes_fonctionnels'] . " groupes";
            
            $formatted = $colline['id'] . "<>" . $colline['nom'] . "<>" . $lat . "<>" . $lng . "<>" . $info . "<>" . $detail;
            $mesdonnees4 .= ($mesdonnees4 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 4,
                'id' => $colline['id'],
                'colline_id' => $colline['COLLINE_ID'],
                'nom' => $colline['nom'],
                'lat' => $lat,
                'lng' => $lng,
                'icon' => '🏥',
                'info' => $info,
                'detail' => $detail,
                'zone_id' => $colline['zone_id'],
                'commune_id' => $colline['commune_id'],
                'province_id' => $colline['province_id'],
                'nb_membres' => $colline['nb_membres'],
                'nb_hommes' => $colline['nb_hommes'],
                'nb_femmes' => $colline['nb_femmes'],
                'nb_groupes' => $colline['nb_groupes_fonctionnels']
            ];
            
            $total_membres += $colline['nb_membres'];
            $total_hommes += $colline['nb_hommes'];
            $total_femmes += $colline['nb_femmes'];
            $total_groupes += $colline['nb_groupes_fonctionnels'];
        }

        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'mesdonnees' => $mesdonnees,
            'mesdonnees2' => $mesdonnees2,
            'mesdonnees3' => $mesdonnees3,
            'mesdonnees4' => $mesdonnees4,
            'points' => $points,
            'stats' => [
                'total_sites' => $total_sites,
                'total_membres' => $total_membres,
                'total_hommes' => $total_hommes,
                'total_femmes' => $total_femmes,
                'total_groupes' => $total_groupes
            ]
        ];

        // Debug - Afficher le nombre de points chargés
        log_message('info', 'Cartographie - Provinces: ' . count($provinces));
        log_message('info', 'Cartographie - Communes: ' . count($communes));
        log_message('info', 'Cartographie - Zones: ' . count($zones));
        log_message('info', 'Cartographie - Collines avec membres: ' . $total_sites);
        log_message('info', 'Cartographie - Total points: ' . (count($provinces) + count($communes) + count($zones) + $total_sites));

        return view('App\Modules\Cartographie\Views\CartoFront', $data);
    }
}
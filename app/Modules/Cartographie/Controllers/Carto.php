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

        // ==================== 1. PROVINCES ====================
        $provinces = $this->db->query("
            SELECT 
                p.PROVINCE_ID as id,
                p.PROVINCE_NAME as nom,
                p.PROVINCE_LATITUDE as lat,
                p.PROVINCE_LONGITUDE as lng,
                COUNT(DISTINCT c.COMMUNE_ID) as nb_communes
            FROM provinces p
            LEFT JOIN communes c ON p.PROVINCE_ID = c.PROVINCE_ID
            GROUP BY p.PROVINCE_ID
        ")->getResultArray();

        // ==================== 2. COMMUNES ====================
        $communes = $this->db->query("
            SELECT DISTINCT 
                cm.COMMUNE_ID as id,
                cm.COMMUNE_NAME as nom,
                cm.COMMUNE_LATITUDE as lat,
                cm.COMMUNE_LONGITUDE as lng,
                p.PROVINCE_NAME as province_nom,
                p.PROVINCE_ID as province_id
            FROM communes cm
            JOIN provinces p ON cm.PROVINCE_ID = p.PROVINCE_ID
            WHERE cm.COMMUNE_LATITUDE != -1 AND cm.COMMUNE_LONGITUDE != -1
        ")->getResultArray();

        // ==================== 3. ZONES ====================
        $zones = $this->db->query("
            SELECT DISTINCT 
                z.ZONE_ID as id,
                z.ZONE_NAME as nom,
                z.LATITUDE as lat,
                z.LONGITUDE as lng,
                cm.COMMUNE_NAME as commune_nom,
                cm.COMMUNE_ID as commune_id
            FROM zones z
            JOIN communes cm ON z.COMMUNE_ID = cm.COMMUNE_ID
            WHERE z.LATITUDE != -1 AND z.LONGITUDE != -1 AND z.LATITUDE != 2
        ")->getResultArray();

        // ==================== 4. COLLINES avec données membres ====================
        $collines = $this->db->query("
            SELECT 
                mi.ID_MEMBRES as id,
                mi.COLLINE_ID,
                mi.NB_GROUPE_FONCTIONNELS,
                mi.NB_MEMBRE_INSCRITS,
                mi.NOMBRE_HOMME,
                mi.NOMBRE_FEMME,
                c.COLLINE_NAME as nom,
                c.LATITUDE as lat,
                c.LONGITUDE as lng,
                z.ZONE_NAME as zone_nom,
                z.ZONE_ID as zone_id,
                cm.COMMUNE_NAME as commune_nom,
                cm.COMMUNE_ID as commune_id,
                p.PROVINCE_NAME as province_nom,
                p.PROVINCE_ID as province_id
            FROM membres_inscrits mi
            JOIN collines c ON mi.COLLINE_ID = c.COLLINE_ID
            JOIN zones z ON c.ZONE_ID = z.ZONE_ID
            JOIN communes cm ON z.COMMUNE_ID = cm.COMMUNE_ID
            JOIN provinces p ON cm.PROVINCE_ID = p.PROVINCE_ID
            WHERE mi.NB_MEMBRE_INSCRITS > 0
            ORDER BY mi.NB_MEMBRE_INSCRITS DESC
        ")->getResultArray();

        // ==================== CONSTRUCTION DES DONNEES ====================
        $mesdonnees = "";   // Groupe 1 - Provinces
        $mesdonnees2 = "";  // Groupe 2 - Communes
        $mesdonnees3 = "";  // Groupe 3 - Zones
        $mesdonnees4 = "";  // Groupe 4 - Collines
        $points = [];
        
        $stats = [
            'total_membres' => 0,
            'total_hommes' => 0,
            'total_femmes' => 0,
            'total_groupes' => 0,
            'total_sites' => 0
        ];

        // Groupe 1: Provinces
        foreach ($provinces as $province) {
            $lat = ($province['lat'] != -1) ? $province['lat'] : -3.38;
            $lng = ($province['lng'] != -1) ? $province['lng'] : 29.36;
            
            $formatted = $province['id'] . "<>" . $province['nom'] . "<>" . $lat . "<>" . $lng . "<>" . "Nombre de communes: " . ($province['nb_communes'] ?? 0) . "<>" . "🏢 Siège provincial";
            $mesdonnees .= ($mesdonnees ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 1, 'id' => $province['id'], 'nom' => $province['nom'],
                'lat' => $lat, 'lng' => $lng, 'icon' => '🏢',
                'sous_titre' => $province['nb_communes'] . ' communes',
                'description' => "Nombre de communes: " . ($province['nb_communes'] ?? 0),
                'extra' => "🏢 Siège provincial"
            ];
        }

        // Groupe 2: Communes
        foreach ($communes as $commune) {
            $lat = ($commune['lat'] != -1) ? $commune['lat'] : -3.38;
            $lng = ($commune['lng'] != -1) ? $commune['lng'] : 29.36;
            
            $formatted = $commune['id'] . "<>" . $commune['nom'] . "<>" . $lat . "<>" . $lng . "<>" . "Province: " . $commune['province_nom'] . "<>" . "🏛️ Chef-lieu de commune";
            $mesdonnees2 .= ($mesdonnees2 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 2, 'id' => $commune['id'], 'nom' => $commune['nom'],
                'lat' => $lat, 'lng' => $lng, 'icon' => '🏛️',
                'sous_titre' => $commune['province_nom'],
                'description' => "Province: " . $commune['province_nom'],
                'extra' => "🏛️ Chef-lieu de commune",
                'province_id' => $commune['province_id']
            ];
        }

        // Groupe 3: Zones
        foreach ($zones as $zone) {
            $lat = ($zone['lat'] != -1 && $zone['lat'] != 2) ? $zone['lat'] : -3.38;
            $lng = ($zone['lng'] != -1 && $zone['lng'] != 2) ? $zone['lng'] : 29.36;
            
            $formatted = $zone['id'] . "<>" . $zone['nom'] . "<>" . $lat . "<>" . $lng . "<>" . "Commune: " . $zone['commune_nom'] . "<>" . "📍 Zone de regroupement";
            $mesdonnees3 .= ($mesdonnees3 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 3, 'id' => $zone['id'], 'nom' => $zone['nom'],
                'lat' => $lat, 'lng' => $lng, 'icon' => '📍',
                'sous_titre' => $zone['commune_nom'],
                'description' => "Commune: " . $zone['commune_nom'],
                'extra' => "📍 Zone de regroupement",
                'commune_id' => $zone['commune_id']
            ];
        }

        // Groupe 4: Collines (Zones d'intervention)
        foreach ($collines as $colline) {
            $lat = ($colline['lat'] != -1 && $colline['lat'] != 2) ? $colline['lat'] : -3.38;
            $lng = ($colline['lng'] != -1 && $colline['lng'] != 2) ? $colline['lng'] : 29.36;
            
            $description = "📍 Zone: " . $colline['zone_nom'] . " | Commune: " . $colline['commune_nom'] . " | Province: " . $colline['province_nom'];
            $extra = "👥 Membres: " . $colline['NB_MEMBRE_INSCRITS'] . " | 👨 Hommes: " . $colline['NOMBRE_HOMME'] . " | 👩 Femmes: " . $colline['NOMBRE_FEMME'] . " | 📊 Groupes: " . $colline['NB_GROUPE_FONCTIONNELS'];
            
            $formatted = $colline['id'] . "<>" . $colline['nom'] . "<>" . $lat . "<>" . $lng . "<>" . $description . "<>" . $extra;
            $mesdonnees4 .= ($mesdonnees4 ? "@" : "") . $formatted;
            
            $points[] = [
                'groupe' => 4, 'id' => $colline['id'], 'colline_id' => $colline['COLLINE_ID'],
                'nom' => $colline['nom'], 'lat' => $lat, 'lng' => $lng, 'icon' => '🏥',
                'sous_titre' => $colline['zone_nom'], 'description' => $description, 'extra' => $extra,
                'zone_id' => $colline['zone_id'], 'commune_id' => $colline['commune_id'],
                'province_id' => $colline['province_id'],
                'nb_membres' => $colline['NB_MEMBRE_INSCRITS'],
                'nb_hommes' => $colline['NOMBRE_HOMME'],
                'nb_femmes' => $colline['NOMBRE_FEMME'],
                'nb_groupes' => $colline['NB_GROUPE_FONCTIONNELS']
            ];
            
            $stats['total_membres'] += $colline['NB_MEMBRE_INSCRITS'];
            $stats['total_hommes'] += $colline['NOMBRE_HOMME'];
            $stats['total_femmes'] += $colline['NOMBRE_FEMME'];
            $stats['total_groupes'] += $colline['NB_GROUPE_FONCTIONNELS'];
            $stats['total_sites']++;
        }

        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'mesdonnees' => $mesdonnees,
            'mesdonnees2' => $mesdonnees2,
            'mesdonnees3' => $mesdonnees3,
            'mesdonnees4' => $mesdonnees4,
            'points' => $points,
            'stats' => $stats
        ];


         $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");

        return view('App\Modules\Cartographie\Views\CartoFront', $data);
    }
}
<?php

namespace App\Modules\Cartographie\Controllers;

use CodeIgniter\Controller;

class Carto extends Controller
{
    protected $helpers = ['url'];
    
    public function index()
    {
        // Exemple de données - À remplacer par vos vraies données venant de la base
        $mesdonnees = "1<>Point A<>-3.3804751<>29.3604533<>Description A<>Info A@2<>Point B<>-3.3904751<>29.3704533<>Description B<>Info B@3<>Point C<>-3.4004751<>29.3804533<>Description C<>Info C";
        
        $mesdonnees2 = "4<>Point D<>-3.4104751<>29.3904533<>Description D<>Info D@5<>Point E<>-3.4204751<>29.4004533<>Description E<>Info E";
        
        $mesdonnees3 = "6<>Point F<>-3.4304751<>29.4104533<>Description F<>Info F@7<>Point G<>-3.4404751<>29.4204533<>Description G<>Info G";
        
        $mesdonnees4 = "8<>Point H<>-3.4504751<>29.4304533<>Description H<>Info H@9<>Point I<>-3.4604751<>29.4404533<>Description I<>Info I";
        
        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'mesdonnees' => $mesdonnees,
            'mesdonnees2' => $mesdonnees2,
            'mesdonnees3' => $mesdonnees3,
            'mesdonnees4' => $mesdonnees4
        ];
        
        return view('App\Modules\Cartographie\Views\CartoFront', $data);
    }
    
    // Méthode alternative : Récupérer depuis la base de données
    public function mapWithDatabase()
    {
        // Exemple avec modèle (à adapter selon votre base)
        // $zoneModel = new \App\Modules\Cartographie\Models\ZoneModel();
        // $points = $zoneModel->getAllPoints();
        
        // Simulation de données venant de la base
        $points = [
            ['id' => 1, 'nom' => 'Point A', 'lat' => -3.3804751, 'lng' => 29.3604533, 'description' => 'Description A', 'groupe' => 1],
            ['id' => 2, 'nom' => 'Point B', 'lat' => -3.3904751, 'lng' => 29.3704533, 'description' => 'Description B', 'groupe' => 1],
            ['id' => 3, 'nom' => 'Point C', 'lat' => -3.4004751, 'lng' => 29.3804533, 'description' => 'Description C', 'groupe' => 1],
            ['id' => 4, 'nom' => 'Point D', 'lat' => -3.4104751, 'lng' => 29.3904533, 'description' => 'Description D', 'groupe' => 2],
            ['id' => 5, 'nom' => 'Point E', 'lat' => -3.4204751, 'lng' => 29.4004533, 'description' => 'Description E', 'groupe' => 2],
            ['id' => 6, 'nom' => 'Point F', 'lat' => -3.4304751, 'lng' => 29.4104533, 'description' => 'Description F', 'groupe' => 3],
            ['id' => 7, 'nom' => 'Point G', 'lat' => -3.4404751, 'lng' => 29.4204533, 'description' => 'Description G', 'groupe' => 3],
            ['id' => 8, 'nom' => 'Point H', 'lat' => -3.4504751, 'lng' => 29.4304533, 'description' => 'Description H', 'groupe' => 4],
        ];
        
        // Convertir les données au format attendu par la vue
        $mesdonnees = "";
        $mesdonnees2 = "";
        $mesdonnees3 = "";
        $mesdonnees4 = "";
        
        foreach ($points as $point) {
            $formatted = $point['id'] . "<>" . 
                         $point['nom'] . "<>" . 
                         $point['lat'] . "<>" . 
                         $point['lng'] . "<>" . 
                         $point['description'] . "<>" . 
                         "Info " . $point['id'];
            
            switch ($point['groupe']) {
                case 1:
                    $mesdonnees .= ($mesdonnees ? "@" : "") . $formatted;
                    break;
                case 2:
                    $mesdonnees2 .= ($mesdonnees2 ? "@" : "") . $formatted;
                    break;
                case 3:
                    $mesdonnees3 .= ($mesdonnees3 ? "@" : "") . $formatted;
                    break;
                case 4:
                    $mesdonnees4 .= ($mesdonnees4 ? "@" : "") . $formatted;
                    break;
            }
        }
        
        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'mesdonnees' => $mesdonnees,
            'mesdonnees2' => $mesdonnees2,
            'mesdonnees3' => $mesdonnees3,
            'mesdonnees4' => $mesdonnees4
        ];
        
        return view('App\Modules\Cartographie\Views\index', $data);
    }
}
<?php

namespace App\Modules\Cartographie\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

class Carto extends BaseController
{
    protected $helpers = ['url'];
    
    public function mapWithDatabase()
    {
        // Exemple de données - À remplacer par vos vraies données venant de la base

        $connexion = $this->model->getRequete('SELECT * FROM `provinces` JOIN communes ON provinces.PROVINCE_ID=communes.COMMUNE_ID WHERE 1');
        print_r($connexion);die();

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
    public function index()
    {
        // Exemple avec modèle (à adapter selon votre base)
        // $zoneModel = new \App\Modules\Cartographie\Models\ZoneModel();
        $donnees1 = $this->model->getRequete('SELECT p.*, 
       COUNT(DISTINCT c.COMMUNE_ID) AS commune_count, 
       COUNT(DISTINCT z.ZONE_ID) AS zone_count, 
       COUNT(DISTINCT co.COLLINE_ID) AS colline_count
FROM `provinces` AS p
RIGHT JOIN communes AS c ON p.PROVINCE_ID = c.PROVINCE_ID
RIGHT JOIN zones AS z ON c.COMMUNE_ID = z.COMMUNE_ID
RIGHT JOIN collines AS co ON z.ZONE_ID = co.ZONE_ID
WHERE 1
GROUP BY p.PROVINCE_ID;');
        // print_r($points);die();
        
        // Simulation de données venant de la base

        $points="[";

        foreach ($donnees1 as $key => $value) {
            # code...
        $points.='['.'"PROVINCE_ID"=>'.$value['PROVINCE_ID'].',' .'"groupe"=>"1",'.'"nom"=>"'.$value['PROVINCE_NAME'].'",'.'"lat"=>'.$value['LATITUDE'].','.'"lng"=>'.$value['LONGITUDE'].','.'"icon"=>"<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏥
                            </div>",'.'"NB_COMM"=>'.$value['commune_count'].'],';

        }
        print_r($points);die();

 // $points =[["PROVINCE_ID"=>1,"NOM"=>"Pro","nOM"=>"BUHUMUZA"],["PROVINCE_ID"=>2,"NOM"=>"Pro","nOM"=>"BUJUMBURA"],["PROVINCE_ID"=>3,"NOM"=>"Pro","nOM"=>"BURUNGA"],["PROVINCE_ID"=>4,"NOM"=>"Pro","nOM"=>"BUTANYERERA"],["PROVINCE_ID"=>5,"NOM"=>"Pro","nOM"=>"GITEGA"],
        $points = [
            ['id' => 1, 'nom' => 'BURUNGA', 'lat' => -3.3804751, 'lng' => 29.3604533, 'description' => 'TEST1', 'groupe' => 1,'icon' => '<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏥
                            </div>'],
            ['id' => 2, 'nom' => 'BUHUMUZA', 'lat' => -3.3904751, 'lng' => 29.3704533, 'description' => 'TEST 2', 'groupe' => 1,'icon' => '<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏥
                            </div>'],
            ['id' => 3, 'nom' => 'BUTANYERERA', 'lat' => -3.4004751, 'lng' => 29.3804533, 'description' => 'TEST 3', 'groupe' => 1,'icon' => '<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏥 
                            </div>'],
            ['id' => 4, 'nom' => 'TOILLETE1', 'lat' => -3.4104751, 'lng' => 29.3904533, 'description' => 'TEST', 'groupe' => 2,'icon' => '<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                🏫 
                            </div>'],
            ['id' => 5, 'nom' => 'Point E', 'lat' => -3.4204751, 'lng' => 29.4004533, 'description' => 'Description E', 'groupe' => 2,'icon' => '<div style="font-size: 12px; opacity: 0.8; margin-top: 5px;">
                                 🏫
                            </div>'],
           
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
                // case 3:
                //     $mesdonnees3 .= ($mesdonnees3 ? "@" : "") . $formatted;
                //     break;
                // case 4:
                //     $mesdonnees4 .= ($mesdonnees4 ? "@" : "") . $formatted;
                //     break;
            }
        }
        
        $data = [
            'title' => 'Cartographie',
            'pageTitle' => 'Carte des zones d intervention',
            'mesdonnees' => $mesdonnees,
            'mesdonnees2' => $mesdonnees2,
            // 'mesdonnees3' => $mesdonnees3,
            // 'mesdonnees4' => $mesdonnees4,
            'points' => $points,

        ];
        // print_r($data);die();
        return view('App\Modules\Cartographie\Views\CartoFront', $data);
    }
}
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        
        $data['projets'] =$this->model->getRequete("SELECT p.*FROM projet p
        GROUP BY p.ID_PROJET");


       $data['services'] =$this->model->getRequete("SELECT p.*FROM service p
        GROUP BY p.ID_SERVICE ");

        return view('welcome_message',$data);
    }

    function getCoordinates($colline)
    {
        $url = "https://nominatim.openstreetmap.org/search?q="
        . urlencode($colline . ", Burundi")
        . "&format=json&limit=1";

        $opts = [
            "http" => [
                "header" => "User-Agent: MonApplication/1.0\r\n"
            ]
        ];

        $context = stream_context_create($opts);

        $json = file_get_contents($url, false, $context);

        if ($json === false) {
            return false;
        }

        $data = json_decode($json, true);

        if (!empty($data)) {
            return [
                'latitude'  => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ];
        }

        return false;
    }


    function gererCord(){

        $collines=$this->model->getRequete('SELECT * FROM `collines` WHERE LATITUDE=1 AND LONGITUDE=1');
        $i = 0;

        foreach ($collines as $key ) {
           if ($i >= 50) {
            break;
        }
        $coord = $this->getCoordinates($key['COLLINE_NAME']);
        if($coord){
         $this->model->updateData('collines',['COLLINE_ID'=>$key['COLLINE_ID']],['LATITUDE'=>$coord['latitude'],'LONGITUDE'=>$coord['longitude']]);
     }else{
       $this->model->updateData('collines',['COLLINE_ID'=>$key['COLLINE_ID']],['LATITUDE'=>2,'LONGITUDE'=>2]);  
   }



   echo "<pre>";
   if ($coord) {

    echo "ID : ".$key['COLLINE_ID'];
    echo " | Colline : ".$key['COLLINE_NAME'];
    echo " | Latitude : ".$coord['latitude'];
    echo " | Longitude : ".$coord['longitude'];
    echo "<br>";

}
$i++;
}
}


function gererCordzone(){

    $zones=$this->model->getRequete('SELECT * FROM `zones` WHERE LATITUDE=1 AND LONGITUDE=1');
    $i = 0;

    foreach ($zones as $key ) {
       if ($i >= 50) {
        break;
    }
    $coord = $this->getCoordinates($key['ZONE_NAME']);
    if($coord){
     $this->model->updateData('zones',['ZONE_ID'=>$key['ZONE_ID']],['LATITUDE'=>$coord['latitude'],'LONGITUDE'=>$coord['longitude']]);
 }else{
   $this->model->updateData('zones',['ZONE_ID'=>$key['ZONE_ID']],['LATITUDE'=>2,'LONGITUDE'=>2]);  
}



echo "<pre>";

if ($coord) {

    echo "ID : ".$key['ZONE_ID'];
    echo " | zone : ".$key['ZONE_NAME'];
    echo " | Latitude : ".$coord['latitude'];
    echo " | Longitude : ".$coord['longitude'];
    echo "<br>";

}
$i++;
}

}

function gererCordcommune(){

    $communes=$this->model->getRequete('SELECT * FROM `communes` WHERE COMMUNE_LATITUDE=1 AND COMMUNE_LONGITUDE=1');
    $i = 0;

    foreach ($communes as $key ) {
       if ($i >= 50) {
        break;
    }
    $coord = $this->getCoordinates($key['COMMUNE_NAME']);
    if($coord){
     $this->model->updateData('communes',['COMMUNE_ID'=>$key['COMMUNE_ID']],['COMMUNE_LATITUDE'=>$coord['latitude'],'COMMUNE_LONGITUDE'=>$coord['longitude']]);
 }else{
   $this->model->updateData('communes',['COMMUNE_ID'=>$key['COMMUNE_ID']],['COMMUNE_LATITUDE'=>2,'COMMUNE_LONGITUDE'=>2]);  
}



echo "<pre>";

if ($coord) {

    echo "ID : ".$key['COMMUNE_ID'];
    echo " | commune : ".$key['COMMUNE_NAME'];
    echo " | Latitude : ".$coord['latitude'];
    echo " | Longitude : ".$coord['longitude'];
    echo "<br>";

}
$i++;
}

}


}
<?php

namespace App\Controllers;

class NosStrategie extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos Strategie';
        $data['objectifs'] =$this->model->getRequete("SELECT p.*FROM objectifs p
        ORDER BY p.ORDRE_AFFICHAGE ASC");
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/NosStrategieView',$data);
    }


}
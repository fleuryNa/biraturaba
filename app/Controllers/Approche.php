<?php

namespace App\Controllers;

class Approche extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Approche';
        $data['activites'] =$this->model->getRequete("SELECT p.*FROM activites p WHERE p.STATUT =1 ORDER BY p.ORDRE_AFFICHAGE ASC "); 
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ApprocheView',$data);
    }


}
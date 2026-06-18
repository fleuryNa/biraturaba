<?php

namespace App\Controllers;

class Particularite extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos Particularités';

        $data['particularites'] =$this->model->getRequete("SELECT p.*FROM particularite p
        ORDER BY p.ORDRE_AFFICHAGE ASC");

        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ParticulariteView',$data);
    }


}
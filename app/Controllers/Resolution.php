<?php

namespace App\Controllers;

class Resolution extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos projets';
         $data['projets'] =$this->model->getRequete("SELECT p.*FROM projet p
        GROUP BY p.ID_PROJET LIMIT 6");
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS LIMIT 6");
        return view('site/ResolutionView',$data);
    }


}
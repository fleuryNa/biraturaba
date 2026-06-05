<?php

namespace App\Controllers;

class Particularite extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos Strategie';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ParticulariteView',$data);
    }


}
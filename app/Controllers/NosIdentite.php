<?php

namespace App\Controllers;

class NosIdentite extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Identite';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/NosIdentiteView',$data);
    }


}
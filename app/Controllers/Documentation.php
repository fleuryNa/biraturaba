<?php

namespace App\Controllers;

class Documentation extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Equipe';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/DocumentationView',$data);
    }


}
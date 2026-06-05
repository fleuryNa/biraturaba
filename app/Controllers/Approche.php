<?php

namespace App\Controllers;

class Approche extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Approche';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ApprocheView',$data);
    }


}
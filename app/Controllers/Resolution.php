<?php

namespace App\Controllers;

class Resolution extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos projets';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ResolutionView',$data);
    }


}
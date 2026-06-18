<?php

namespace App\Controllers;

class Impact extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Impact';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");

        $data['impacts'] =$this->model->getRequeteOne("SELECT p.*FROM impact p
        GROUP BY p.ID_IMPACT ");
        return view('site/ImpactView',$data);
    }


}
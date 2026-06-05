<?php

namespace App\Controllers;

class Histoire extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Histoire';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/HistoireView',$data);
    }


}
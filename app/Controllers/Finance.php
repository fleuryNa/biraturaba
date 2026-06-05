<?php

namespace App\Controllers;

class Finance extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Les Finances';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/FinanceView',$data);
    }


}
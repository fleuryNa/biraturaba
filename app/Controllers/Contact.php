<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Contact';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ContactView',$data);
    }


}
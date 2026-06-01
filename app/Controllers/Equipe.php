<?php

namespace App\Controllers;

class Equipe extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Equipe';
        return view('site/EquipeView',$data);
    }


}

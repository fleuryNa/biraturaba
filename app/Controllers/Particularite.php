<?php

namespace App\Controllers;

class Particularite extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos Strategie';
        return view('site/ParticulariteView',$data);
    }


}

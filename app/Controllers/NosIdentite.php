<?php

namespace App\Controllers;

class NosIdentite extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Identite';
        return view('site/NosIdentiteView',$data);
    }


}

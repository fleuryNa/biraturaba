<?php

namespace App\Controllers;

class Documentation extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Equipe';
        return view('site/DocumentationView',$data);
    }


}

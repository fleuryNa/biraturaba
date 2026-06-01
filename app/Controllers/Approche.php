<?php

namespace App\Controllers;

class Approche extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Approche';
        return view('site/ApprocheView',$data);
    }


}

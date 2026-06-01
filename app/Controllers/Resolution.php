<?php

namespace App\Controllers;

class Resolution extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos projets';
        return view('site/ResolutionView',$data);
    }


}

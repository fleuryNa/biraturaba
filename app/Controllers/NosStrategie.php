<?php

namespace App\Controllers;

class NosStrategie extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Nos Strategie';
        return view('site/NosStrategieView',$data);
    }


}

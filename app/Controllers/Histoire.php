<?php

namespace App\Controllers;

class Histoire extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Histoire';
        return view('site/HistoireView',$data);
    }


}

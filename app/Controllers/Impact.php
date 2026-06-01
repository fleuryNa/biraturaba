<?php

namespace App\Controllers;

class Impact extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Impact';
        return view('site/SuiviEvaluationView',$data);
    }


}

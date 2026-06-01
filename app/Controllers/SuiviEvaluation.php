<?php

namespace App\Controllers;

class SuiviEvaluation extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre système de suivi-évaluation';
        return view('site/SuiviEvaluationView',$data);
    }


}

<?php

namespace App\Controllers;

class SuiviEvaluation extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre système de suivi-évaluation';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/SuiviEvaluationView',$data);
    }


}
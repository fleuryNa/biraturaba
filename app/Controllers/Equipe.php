<?php

namespace App\Controllers;

class Equipe extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Equipe';

        $equipe = $this->model->getRequete(
    "SELECT * 
     FROM team
     WHERE IS_ACTIF = 1
     ORDER BY ORDRE ASC"
);
        $data['team'] = $equipe;
       
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/EquipeView',$data);
    }


}
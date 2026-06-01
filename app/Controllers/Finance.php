<?php

namespace App\Controllers;

class Finance extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Les Finances';
        return view('site/FinanceView',$data);
    }


}

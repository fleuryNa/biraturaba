<?php

namespace App\Controllers;

class AccueilBackend extends BaseController
{
    public function index()
    {
        return view('Accueil_Backend_View');
    }
}

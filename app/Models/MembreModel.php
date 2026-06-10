<?php

namespace App\Models;

use CodeIgniter\Model;

class MembreModel extends Model
{
    protected $table = 'membres_inscrits';
    protected $primaryKey = 'ID_MEMBRES';
    protected $allowedFields = [
        'COLLINE_ID',
        'DESCRIPTION', 
        'NB_MEMBRE_INSCRITS', 
        'NOMBRE_HOMME', 
        'NOMBRE_FEMME', 
        'NB_GROUPE',
        'ID_TYPE_GROUPE'
    ];
    protected $useTimestamps = false;
}
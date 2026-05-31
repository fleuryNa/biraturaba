<?php

namespace App\Models;

use CodeIgniter\Model;

class CommuneModel extends Model
{
    protected $table = 'communes';
    protected $primaryKey = 'COMMUNE_ID';
    protected $allowedFields = ['COMMUNE_NAME', 'PROVINCE_ID', 'COMMUNE_LATITUDE', 'COMMUNE_LONGITUDE', 'COMMUNE_POLYGONE'];
    protected $useTimestamps = false;
}

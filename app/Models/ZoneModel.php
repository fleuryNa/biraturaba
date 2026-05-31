<?php

namespace App\Models;

use CodeIgniter\Model;

class ZoneModel extends Model
{
    protected $table = 'zones';
    protected $primaryKey = 'ZONE_ID';
    protected $allowedFields = ['ZONE_NAME', 'COMMUNE_ID', 'LATITUDE', 'LONGITUDE'];
    protected $useTimestamps = false;
}

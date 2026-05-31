<?php

namespace App\Models;

use CodeIgniter\Model;

class CollineModel extends Model
{
    protected $table = 'collines';
    protected $primaryKey = 'COLLINE_ID';
    protected $allowedFields = ['COLLINE_NAME', 'ZONE_ID', 'LATITUDE', 'LONGITUDE'];
    protected $useTimestamps = false;
}

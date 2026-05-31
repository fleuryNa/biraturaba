<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinceModel extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'PROVINCE_ID';
    protected $allowedFields = ['PROVINCE_NAME', 'PROVINCE_LATITUDE', 'PROVINCE_LONGITUDE', 'POLY', 'COLOR'];
    protected $useTimestamps = false;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeGroupeModel extends Model
{
    protected $table = 'type_groupes';
    protected $primaryKey = 'ID_TYPE_GROUPE';
    protected $allowedFields = ['DESC_GROUPE'];
    protected $useTimestamps = false;
}
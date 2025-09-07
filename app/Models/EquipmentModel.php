<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'capability', 'domain', 'facility_id'];
    protected $useTimestamps = true;
}
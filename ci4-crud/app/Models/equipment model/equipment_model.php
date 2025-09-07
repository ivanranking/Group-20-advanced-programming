<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table            = 'equipment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'serial_number', 'purchase_date', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    // Validation
    protected $validationRules      = [
        'name' => 'required|max_length[255]',
        'serial_number' => 'permit_empty|is_unique[equipment.serial_number,id,{id}]',
        'status' => 'required|in_list[Available,In Use,Maintenance]',
    ];
}

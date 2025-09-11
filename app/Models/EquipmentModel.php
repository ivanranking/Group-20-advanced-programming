<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'capability', 'domain', 'facility_id'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'capability' => 'permit_empty|max_length[255]',
        'domain' => 'permit_empty|max_length[255]',
        'facility_id' => 'permit_empty|numeric',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'The equipment name is required.',
            'max_length' => 'The equipment name cannot exceed 255 characters.',
        ],
        'description' => [
            'max_length' => 'The description cannot exceed 1000 characters.',
        ],
        'capability' => [
            'max_length' => 'The capability cannot exceed 255 characters.',
        ],
        'domain' => [
            'max_length' => 'The domain cannot exceed 255 characters.',
        ],
        'facility_id' => [
            'numeric' => 'The facility ID must be a number.',
        ],
    ];
}
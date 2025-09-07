<?php

namespace App\Models;

use CodeIgniter\Model;

class OutcomeModel extends Model
{
    protected $table = 'outcomes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['project_id', 'title', 'description', 'file_path', 'link'];
    protected $useTimestamps = true;
}
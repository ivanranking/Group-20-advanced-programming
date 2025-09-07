<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'programs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'start_date', 'end_date'];
    protected $useTimestamps = true;

    public function findProjects($programId)
    {
        return $this->db->table('projects')
            ->where('program_id', $programId)
            ->get()
            ->getResult();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'location'];
    protected $useTimestamps = true;

    public function getProjects($facilityId)
    {
        return $this->db->table('projects')
            ->where('facility_id', $facilityId)
            ->get()
            ->getResult();
    }

    public function getServices($facilityId)
    {
        return $this->db->table('services')
            ->where('facility_id', $facilityId)
            ->get()
            ->getResult();
    }

    public function getEquipment($facilityId)
    {
        return $this->db->table('equipment')
            ->where('facility_id', $facilityId)
            ->get()
            ->getResult();
    }
}
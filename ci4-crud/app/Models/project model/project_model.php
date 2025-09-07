<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['program_id', 'name', 'description', 'start_date', 'end_date', 'budget', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No updated_at field

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[3]|max_length[255]',
        'program_id' => 'permit_empty|integer|is_not_unique[programs.id]',
        'status' => 'required|in_list[Planning,In Progress,Completed,On Hold]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Helper function to get related data from join tables
    private function getRelated(string $tableName, int $projectId, string $relatedKey)
    {
        return $this->db->table($tableName)
            ->where($relatedKey, $projectId)
            ->get()->getResultArray();
    }
    
    // --- Relationship Methods ---

    public function findParticipants(int $projectId): array
    {
        return $this->db->table('participants p')
            ->join('project_participants pp', 'pp.participant_id = p.id')
            ->where('pp.project_id', $projectId)
            ->get()->getResultArray();
    }
    
    public function findEquipment(int $projectId): array
    {
        return $this->db->table('equipment e')
            ->join('project_equipment pe', 'pe.equipment_id = e.id')
            ->where('pe.project_id', $projectId)
            ->get()->getResultArray();
    }
    
    public function findServices(int $projectId): array
    {
        return $this->db->table('services s')
            ->join('project_services ps', 'ps.service_id = s.id')
            ->where('ps.project_id', $projectId)
            ->get()->getResultArray();
    }

    public function findOutcomes(int $projectId): array
    {
        $outcomeModel = new OutcomeModel();
        return $outcomeModel->where('project_id', $projectId)->findAll();
    }

    public function linkParticipant(int $projectId, int $participantId): bool
    {
        if ($this->isParticipantLinked($projectId, $participantId)) {
            return true; // Already linked
        }
        return $this->db->table('project_participants')->insert([
            'project_id' => $projectId,
            'participant_id' => $participantId
        ]);
    }

    public function unlinkParticipant(int $projectId, int $participantId): bool
    {
        return $this->db->table('project_participants')->delete([
            'project_id' => $projectId,
            'participant_id' => $participantId
        ]);
    }

    public function isParticipantLinked(int $projectId, int $participantId): bool
    {
        return $this->db->table('project_participants')
            ->where('project_id', $projectId)
            ->where('participant_id', $participantId)
            ->countAllResults() > 0;
    }
    
    // You can create similar link/unlink methods for Equipment and Services
    public function linkEquipment(int $projectId, int $equipmentId): bool
    {
        return $this->db->table('project_equipment')->insert([
            'project_id' => $projectId,
            'equipment_id' => $equipmentId
        ]);
    }

    public function unlinkEquipment(int $projectId, int $equipmentId): bool
    {
        return $this->db->table('project_equipment')->delete([
            'project_id' => $projectId,
            'equipment_id' => $equipmentId
        ]);
    }
    
    public function linkService(int $projectId, int $serviceId): bool
    {
        return $this->db->table('project_services')->insert([
            'project_id' => $projectId,
            'service_id' => $serviceId
        ]);
    }

    public function unlinkService(int $projectId, int $serviceId): bool
    {
        return $this->db->table('project_services')->delete([
            'project_id' => $projectId,
            'service_id' => $serviceId
        ]);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'program_id', 'facility_id', 'status', 'start_date', 'end_date'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'program_id' => 'permit_empty|integer',
        'facility_id' => 'permit_empty|integer',
        'status' => 'required|in_list[active,inactive,completed]',
        'start_date' => 'permit_empty|valid_date',
        'end_date' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Project name is required.',
            'min_length' => 'Project name must be at least 3 characters long.',
            'max_length' => 'Project name cannot exceed 255 characters.'
        ],
        'status' => [
            'required' => 'Project status is required.',
            'in_list' => 'Project status must be active, inactive, or completed.'
        ]
    ];

    public function getParticipants($projectId)
    {
        return $this->db->table('project_participants')
            ->join('participants', 'project_participants.participant_id = participants.id')
            ->where('project_participants.project_id', $projectId)
            ->get()
            ->getResult();
    }

    public function addParticipant($projectId, $participantId)
    {
        return $this->db->table('project_participants')->insert([
            'project_id' => $projectId,
            'participant_id' => $participantId
        ]);
    }

    public function removeParticipant($projectId, $participantId)
    {
        return $this->db->table('project_participants')
            ->where('project_id', $projectId)
            ->where('participant_id', $participantId)
            ->delete();
    }

    public function getOutcomes($projectId)
    {
        return $this->db->table('outcomes')
            ->where('project_id', $projectId)
            ->get()
            ->getResult();
    }
}
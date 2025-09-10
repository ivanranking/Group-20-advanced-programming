<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipantModel extends Model
{
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'role', 'phone', 'profile_picture'];
    protected $useTimestamps = true;

    public function getProjects($participantId)
    {
        return $this->db->table('project_participants')
            ->join('projects', 'project_participants.project_id = projects.id')
            ->where('project_participants.participant_id', $participantId)
            ->get()
            ->getResult();
    }
}
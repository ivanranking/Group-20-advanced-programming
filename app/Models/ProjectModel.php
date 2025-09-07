<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'program_id', 'facility_id', 'status', 'start_date', 'end_date'];
    protected $useTimestamps = true;

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
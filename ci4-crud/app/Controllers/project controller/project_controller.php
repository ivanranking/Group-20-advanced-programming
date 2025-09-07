<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProgramModel;
use App\Models\ParticipantModel;
use App\Models\EquipmentModel;
use App\Models\ServiceModel;
use App\Controllers\BaseController;

class Projects extends BaseController
{
    public function index()
    {
        $projectModel = new ProjectModel();
        $db = \Config\Database::connect();
        $builder = $db->table('projects');
        $builder->select('projects.*, programs.name as program_name');
        $builder->join('programs', 'programs.id = projects.program_id', 'left');
        $query = $builder->get();

        $data = [
            'projects' => $query->getResultArray(),
            'title' => 'All Projects'
        ];

        return view('projects/index', $data);
    }

    public function show($id = null)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $participantModel = new ParticipantModel();
        $equipmentModel = new EquipmentModel();
        $serviceModel = new ServiceModel();

        $data = [
            'project' => $project,
            'participants' => $projectModel->findParticipants($id),
            'equipment' => $projectModel->findEquipment($id),
            'services' => $projectModel->findServices($id),
            'outcomes' => $projectModel->findOutcomes($id),
            'all_participants' => $participantModel->findAll(),
            'all_equipment' => $equipmentModel->findAll(),
            'all_services' => $serviceModel->findAll(),
            'title' => esc($project['name'])
        ];

        return view('projects/show', $data);
    }

    public function new()
    {
        $programModel = new ProgramModel();
        $data = [
            'title' => 'Create New Project',
            'programs' => $programModel->findAll()
        ];
        return view('projects/new', $data);
    }

    public function create()
    {
        $projectModel = new ProjectModel();
        $data = $this->request->getPost(['program_id', 'name', 'description', 'start_date', 'end_date', 'budget', 'status']);
        
        if ($data['program_id'] === '') {
            $data['program_id'] = null;
        }

        if ($projectModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $projectModel->errors());
        }

        return redirect()->to('/projects')->with('success', 'Project created successfully.');
    }

    public function edit($id = null)
    {
        $projectModel = new ProjectModel();
        $programModel = new ProgramModel();
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
            'project' => $project,
            'programs' => $programModel->findAll(),
            'title' => 'Edit Project: ' . esc($project['name'])
        ];

        return view('projects/edit', $data);
    }

    public function update($id = null)
    {
        $projectModel = new ProjectModel();
        if (!$projectModel->find($id)) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = $this->request->getPost(['program_id', 'name', 'description', 'start_date', 'end_date', 'budget', 'status']);
        
        if ($data['program_id'] === '') {
            $data['program_id'] = null;
        }

        if ($projectModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $projectModel->errors());
        }

        return redirect()->to('/projects/' . $id)->with('success', 'Project updated successfully.');
    }

    public function delete($id = null)
    {
        $projectModel = new ProjectModel();
        if (!$projectModel->find($id)) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        // ON DELETE CASCADE will handle child records in the database
        if ($projectModel->delete($id)) {
            return redirect()->to('/projects')->with('success', 'Project deleted successfully.');
        } else {
            return redirect()->to('/projects')->with('error', 'Failed to delete project.');
        }
    }

    // --- Relationship Management Methods ---

    public function link_participant($projectId)
    {
        $projectModel = new ProjectModel();
        $participantId = $this->request->getPost('participant_id');

        if ($projectModel->linkParticipant($projectId, $participantId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Participant linked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to link participant.');
    }
    
    public function unlink_participant($projectId, $participantId)
    {
        $projectModel = new ProjectModel();
        if ($projectModel->unlinkParticipant($projectId, $participantId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Participant unlinked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to unlink participant.');
    }
    
    public function link_equipment($projectId)
    {
        $projectModel = new ProjectModel();
        $equipmentId = $this->request->getPost('equipment_id');

        if ($projectModel->linkEquipment($projectId, $equipmentId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Equipment linked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to link equipment.');
    }
    
    public function unlink_equipment($projectId, $equipmentId)
    {
        $projectModel = new ProjectModel();
        if ($projectModel->unlinkEquipment($projectId, $equipmentId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Equipment unlinked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to unlink equipment.');
    }
    
    public function link_service($projectId)
    {
        $projectModel = new ProjectModel();
        $serviceId = $this->request->getPost('service_id');

        if ($projectModel->linkService($projectId, $serviceId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Service linked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to link service.');
    }
    
    public function unlink_service($projectId, $serviceId)
    {
        $projectModel = new ProjectModel();
        if ($projectModel->unlinkService($projectId, $serviceId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Service unlinked successfully.');
        }
        return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to unlink service.');
    }
}

<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProgramModel;
use App\Models\FacilityModel;
use App\Models\ParticipantModel;
use App\Controllers\BaseController;

class ProjectController extends BaseController
{
    /**
     * Display a list of all projects with filtering by facility/program.
     */
    public function index()
    {
        $projectModel = new ProjectModel();
        $programModel = new ProgramModel();
        $facilityModel = new FacilityModel();
        $facilityId = $this->request->getGet('facility');
        $programId = $this->request->getGet('program');

        $query = $projectModel;

        if ($facilityId) {
            $query = $query->where('facility_id', $facilityId);
        }

        if ($programId) {
            $query = $query->where('program_id', $programId);
        }

        $data = [
            'projects' => $query->findAll(),
            'title' => 'All Projects',
            'facility_id' => $facilityId,
            'program_id' => $programId,
            'facilities' => $facilityModel->findAll(),
            'programs' => $programModel->findAll()
        ];

        return view('projects/index', $data);
    }

    /**
     * Display a single project with its participants and outcomes.
     * @param int $id
     */
    public function show($id = null)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
            'project' => $project,
            'participants' => $projectModel->getParticipants($id),
            'outcomes' => $projectModel->getOutcomes($id),
            'title' => esc($project['name'])
        ];

        return view('projects/show', $data);
    }

    /**
     * Show a form to create a new project.
     */
    public function new()
    {
        $programModel = new ProgramModel();
        $facilityModel = new FacilityModel();

        $data = [
            'title' => 'Create New Project',
            'programs' => $programModel->findAll(),
            'facilities' => $facilityModel->findAll()
        ];
        return view('projects/new', $data);
    }

    /**
     * Create a new project from the submitted form data.
     */
    public function create()
    {
        $projectModel = new ProjectModel();
        $data = $this->request->getPost(['name', 'description', 'program_id', 'facility_id', 'status', 'start_date', 'end_date']);

        // Debug: Log the data being saved
        log_message('debug', 'Project create data: ' . json_encode($data));
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        // Validate the data
        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
            'program_id' => 'permit_empty|integer',
            'facility_id' => 'permit_empty|integer',
            'status' => 'required|in_list[active,inactive,completed]',
            'start_date' => 'permit_empty|valid_date',
            'end_date' => 'permit_empty|valid_date'
        ])) {
            log_message('error', 'Project validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($projectModel->save($data) === false) {
            $errors = $projectModel->errors();
            log_message('error', 'Project save failed: ' . json_encode($errors));
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        return redirect()->to('/projects')->with('success', 'Project created successfully.');
    }

    /**
     * Show a form to edit an existing project.
     * @param int $id
     */
    public function edit($id = null)
    {
        $projectModel = new ProjectModel();
        $programModel = new ProgramModel();
        $facilityModel = new FacilityModel();

        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = [
            'project' => $project,
            'programs' => $programModel->findAll(),
            'facilities' => $facilityModel->findAll(),
            'title' => 'Edit Project: ' . esc($project['name'])
        ];

        return view('projects/edit', $data);
    }

    /**
     * Update an existing project from the submitted form data.
     * @param int $id
     */
    public function update($id = null)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        $data = $this->request->getPost(['name', 'description', 'program_id', 'facility_id', 'status', 'start_date', 'end_date']);

        if ($projectModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $projectModel->errors());
        }

        return redirect()->to('/projects/' . $id)->with('success', 'Project updated successfully.');
    }

    /**
     * Delete a project.
     * @param int $id
     */
    public function delete($id = null)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found.');
        }

        if ($projectModel->delete($id)) {
            return redirect()->to('/projects')->with('success', 'Project deleted successfully.');
        } else {
            return redirect()->to('/projects')->with('error', 'Failed to delete project.');
        }
    }

    /**
     * Add a participant to a project.
     * @param int $projectId
     * @param int $participantId
     */
    public function addParticipant($projectId = null, $participantId = null)
    {
        $projectModel = new ProjectModel();
        $participantModel = new ParticipantModel();

        if (!$projectModel->find($projectId) || !$participantModel->find($participantId)) {
            return redirect()->to('/projects/' . $projectId)->with('error', 'Invalid project or participant.');
        }

        if ($projectModel->addParticipant($projectId, $participantId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Participant added to project.');
        } else {
            return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to add participant.');
        }
    }

    /**
     * Remove a participant from a project.
     * @param int $projectId
     * @param int $participantId
     */
    public function removeParticipant($projectId = null, $participantId = null)
    {
        $projectModel = new ProjectModel();

        if ($projectModel->removeParticipant($projectId, $participantId)) {
            return redirect()->to('/projects/' . $projectId)->with('success', 'Participant removed from project.');
        } else {
            return redirect()->to('/projects/' . $projectId)->with('error', 'Failed to remove participant.');
        }
    }
}
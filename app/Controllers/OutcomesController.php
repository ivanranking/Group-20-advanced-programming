<?php

namespace App\Controllers;

use App\Models\OutcomeModel;
use App\Models\ProjectModel;
use App\Controllers\BaseController;

class OutcomesController extends BaseController
{
    /**
     * Display a list of outcomes, optionally filtered by project.
     */
    public function index()
    {
        $outcomeModel = new OutcomeModel();
        $projectId = $this->request->getGet('project');
        $projectModel = new ProjectModel();
 
         $query = $outcomeModel;
 
         if ($projectId) {
             $query = $query->where('project_id', $projectId);
         }
 
         $data = [
             'outcomes' => $query->findAll(),
             'title' => 'Outcomes',
             'projects' => $projectModel->findAll(),
             'project_id' => $projectId
         ];

        return view('outcomes/index', $data);
    }

    /**
     * Display a single outcome.
     * @param int $id
     */
    public function show($id = null)
    {
        $outcomeModel = new OutcomeModel();
        $outcome = $outcomeModel->find($id);

        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found.');
        }

        $data = [
            'outcome' => $outcome,
            'title' => esc($outcome['title'])
        ];

        return view('outcomes/show', $data);
    }

    /**
     * Show a form to create a new outcome.
     */
    public function new()
    {
        $projectModel = new ProjectModel();

        $data = [
            'title' => 'Create New Outcome',
            'projects' => $projectModel->findAll()
        ];
        return view('outcomes/new', $data);
    }

    /**
     * Create a new outcome from the submitted form data.
     */
    public function create()
    {
        $outcomeModel = new OutcomeModel();
        $data = $this->request->getPost(['project_id', 'title', 'description', 'link']);

        // Handle file upload
        $file = $this->request->getFile('file_path');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['file_path'] = $newName;
        }

        if ($outcomeModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $outcomeModel->errors());
        }

        return redirect()->to('/outcomes')->with('success', 'Outcome created successfully.');
    }

    /**
     * Show a form to edit an existing outcome.
     * @param int $id
     */
    public function edit($id = null)
    {
        $outcomeModel = new OutcomeModel();
        $projectModel = new ProjectModel();

        $outcome = $outcomeModel->find($id);

        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found.');
        }

        $data = [
            'outcome' => $outcome,
            'projects' => $projectModel->findAll(),
            'title' => 'Edit Outcome: ' . esc($outcome['title'])
        ];

        return view('outcomes/edit', $data);
    }

    /**
     * Update an existing outcome from the submitted form data.
     * @param int $id
     */
    public function update($id = null)
    {
        $outcomeModel = new OutcomeModel();
        $outcome = $outcomeModel->find($id);

        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found.');
        }

        $data = $this->request->getPost(['project_id', 'title', 'description', 'link']);

        // Handle file upload
        $file = $this->request->getFile('file_path');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['file_path'] = $newName;
        }

        if ($outcomeModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $outcomeModel->errors());
        }

        return redirect()->to('/outcomes/' . $id)->with('success', 'Outcome updated successfully.');
    }

    /**
     * Delete an outcome.
     * @param int $id
     */
    public function delete($id = null)
    {
        $outcomeModel = new OutcomeModel();
        $outcome = $outcomeModel->find($id);

        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found.');
        }

        if ($outcomeModel->delete($id)) {
            return redirect()->to('/outcomes')->with('success', 'Outcome deleted successfully.');
        } else {
            return redirect()->to('/outcomes')->with('error', 'Failed to delete outcome.');
        }
    }

    /**
     * Download the file associated with an outcome.
     * @param int $id
     */
    public function download($id = null)
    {
        $outcomeModel = new OutcomeModel();
        $outcome = $outcomeModel->find($id);

        if (!$outcome || !$outcome['file_path']) {
            return redirect()->to('/outcomes')->with('error', 'File not found.');
        }

        $filePath = WRITEPATH . 'uploads/' . $outcome['file_path'];

        if (!file_exists($filePath)) {
            return redirect()->to('/outcomes')->with('error', 'File not found on server.');
        }

        return $this->response->download($filePath, null)->setFileName($outcome['title'] . '.' . pathinfo($outcome['file_path'], PATHINFO_EXTENSION));
    }
}
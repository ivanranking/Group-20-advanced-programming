<?php

namespace App\Controllers;

use App\Models\ProgramModel;
use App\Models\ProjectModel;
use App\Controllers\BaseController;

class ProgramController extends BaseController
{
    /**
     * Display a list of all programs.
     */
    public function index()
    {
        $programModel = new ProgramModel();
        $data = [
            'programs' => $programModel->orderBy('start_date', 'DESC')->findAll(),
            'title' => 'All Programs'
        ];

        return view('programs/index', $data);
    }

    /**
     * Display a single program with its associated projects.
     * @param int $id
     */
    public function show($id = null)
    {
        $programModel = new ProgramModel();
        $program = $programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found.');
        }

        $data = [
            'program' => $program,
            'projects' => $programModel->findProjects($id),
            'title' => esc($program['name'])
        ];

        return view('programs/show', $data);
    }

    /**
     * Show a form to create a new program.
     */
    public function new()
    {
        $data = [
            'title' => 'Create New Program'
        ];
        return view('programs/new', $data);
    }

    /**
     * Create a new program from the submitted form data.
     */
    public function create()
    {
        $programModel = new ProgramModel();
        $data = $this->request->getPost(['name', 'description', 'start_date', 'end_date']);

        if ($programModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $programModel->errors());
        }

        return redirect()->to('/programs')->with('success', 'Program created successfully.');
    }

    /**
     * Show a form to edit an existing program.
     * @param int $id
     */
    public function edit($id = null)
    {
        $programModel = new ProgramModel();
        $program = $programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found.');
        }

        $data = [
            'program' => $program,
            'title' => 'Edit Program: ' . esc($program['name'])
        ];

        return view('programs/edit', $data);
    }

    /**
     * Update an existing program from the submitted form data.
     * @param int $id
     */
    public function update($id = null)
    {
        $programModel = new ProgramModel();
        $program = $programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found.');
        }

        $data = $this->request->getPost(['name', 'description', 'start_date', 'end_date']);

        if ($programModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $programModel->errors());
        }

        return redirect()->to('/programs/' . $id)->with('success', 'Program updated successfully.');
    }

    /**
     * Delete a program.
     * @param int $id
     */
    public function delete($id = null)
    {
        $programModel = new ProgramModel();
        $program = $programModel->find($id);

        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found.');
        }

        // The database schema uses ON DELETE SET NULL for the foreign key,
        // so projects will be disassociated but not deleted.
        if ($programModel->delete($id)) {
            return redirect()->to('/programs')->with('success', 'Program deleted successfully.');
        } else {
            return redirect()->to('/programs')->with('error', 'Failed to delete program.');
        }
    }
}
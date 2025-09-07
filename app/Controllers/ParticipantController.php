<?php

namespace App\Controllers;

use App\Models\ParticipantModel;
use App\Controllers\BaseController;

class ParticipantController extends BaseController
{
    /**
     * Display a list of all participants.
     */
    public function index()
    {
        $participantModel = new ParticipantModel();
        $data = [
            'participants' => $participantModel->findAll(),
            'title' => 'All Participants'
        ];

        return view('participants/index', $data);
    }

    /**
     * Display a single participant with their projects.
     * @param int $id
     */
    public function show($id = null)
    {
        $participantModel = new ParticipantModel();
        $participant = $participantModel->find($id);

        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found.');
        }

        $data = [
            'participant' => $participant,
            'projects' => $participantModel->getProjects($id),
            'title' => esc($participant['name'])
        ];

        return view('participants/show', $data);
    }

    /**
     * Show a form to create a new participant.
     */
    public function new()
    {
        $data = [
            'title' => 'Create New Participant'
        ];
        return view('participants/new', $data);
    }

    /**
     * Create a new participant from the submitted form data.
     */
    public function create()
    {
        $participantModel = new ParticipantModel();
        $data = $this->request->getPost(['name', 'email', 'role']);

        if ($participantModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $participantModel->errors());
        }

        return redirect()->to('/participants')->with('success', 'Participant created successfully.');
    }

    /**
     * Show a form to edit an existing participant.
     * @param int $id
     */
    public function edit($id = null)
    {
        $participantModel = new ParticipantModel();
        $participant = $participantModel->find($id);

        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found.');
        }

        $data = [
            'participant' => $participant,
            'title' => 'Edit Participant: ' . esc($participant['name'])
        ];

        return view('participants/edit', $data);
    }

    /**
     * Update an existing participant from the submitted form data.
     * @param int $id
     */
    public function update($id = null)
    {
        $participantModel = new ParticipantModel();
        $participant = $participantModel->find($id);

        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found.');
        }

        $data = $this->request->getPost(['name', 'email', 'role']);

        if ($participantModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $participantModel->errors());
        }

        return redirect()->to('/participants/' . $id)->with('success', 'Participant updated successfully.');
    }

    /**
     * Delete a participant.
     * @param int $id
     */
    public function delete($id = null)
    {
        $participantModel = new ParticipantModel();
        $participant = $participantModel->find($id);

        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found.');
        }

        if ($participantModel->delete($id)) {
            return redirect()->to('/participants')->with('success', 'Participant deleted successfully.');
        } else {
            return redirect()->to('/participants')->with('error', 'Failed to delete participant.');
        }
    }
}
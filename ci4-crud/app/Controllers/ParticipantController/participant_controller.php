<?php

namespace App\Controllers;

use App\Models\ParticipantModel;
use App\Controllers\BaseController;

class Participants extends BaseController
{
    // Standard CRUD methods: index, new, create, edit, update, delete
    public function index()
    {
        $model = new ParticipantModel();
        $data = [
            'participants' => $model->findAll(),
            'title' => 'All Participants'
        ];
        return view('participants/index', $data);
    }

    public function new()
    {
        return view('participants/new', ['title' => 'Add New Participant']);
    }

    public function create()
    {
        $model = new ParticipantModel();
        if ($this->request->getMethod() === 'post' && $model->save($this->request->getPost())) {
            return redirect()->to('/participants')->with('success', 'Participant added.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        $model = new ParticipantModel();
        $data = [
            'participant' => $model->find($id),
            'title' => 'Edit Participant'
        ];
        if (empty($data['participant'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the participant item: ' . $id);
        }
        return view('participants/edit', $data);
    }
    
    public function update($id = null)
    {
        $model = new ParticipantModel();
        if ($this->request->getMethod() === 'post' && $model->update($id, $this->request->getPost())) {
            return redirect()->to('/participants')->with('success', 'Participant updated.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function delete($id = null)
    {
        $model = new ParticipantModel();
        $model->delete($id);
        return redirect()->to('/participants')->with('success', 'Participant deleted.');
    }
}

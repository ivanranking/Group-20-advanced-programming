<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParticipantModel;

class Participant extends BaseController
{
    public function index()
    {
        $model = new ParticipantModel();
        $data['participants'] = $model->findAll();
        return view('participants/index', $data);
    }

    public function show($id = null)
    {
        $model = new ParticipantModel();
        $data['participant'] = $model->find($id);
        return view('participants/show', $data);
    }

    public function new()
    {
        return view('participants/new');
    }

    public function create()
    {
        $model = new ParticipantModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];
        $model->insert($data);
        return redirect()->to('/participants');
    }

    public function edit($id = null)
    {
        $model = new ParticipantModel();
        $data['participant'] = $model->find($id);
        return view('participants/edit', $data);
    }

    public function update($id = null)
    {
        $model = new ParticipantModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];
        $model->update($id, $data);
        return redirect()->to('/participants');
    }

    public function delete($id = null)
    {
        $model = new ParticipantModel();
        $model->delete($id);
        return redirect()->to('/participants');
    }
}
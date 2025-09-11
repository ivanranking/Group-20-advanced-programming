<?php

namespace App\Controllers;

use App\Models\FacilityModel;
use App\Controllers\BaseController;

class Facilities extends BaseController
{
    public function index()
    {
        $facilityModel = new FacilityModel();
        $data = [
            'facilities' => $facilityModel->findAll(),
            'title' => 'All Facilities'
        ];

        return view('facilities/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Create New Facility'
        ];
        return view('facilities/create', $data);
    }

    public function create()
    {
        $facilityModel = new FacilityModel();
        $data = $this->request->getPost(['name', 'description']);
        
        if ($facilityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $facilityModel->errors());
        }

        return redirect()->to('/facilities')->with('success', 'Facility created successfully.');
    }

    public function store()
    {
        $facilityModel = new FacilityModel();
        $data = $this->request->getPost(['name', 'description']);
        
        if ($facilityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $facilityModel->errors());
        }

        return redirect()->to('/facilities')->with('success', 'Facility created successfully.');
    }
    public function show($id = null)
    {
        $facilityModel = new FacilityModel();
        $data = [
            'facility' => $facilityModel->find($id),
            'title' => 'Facility Details'
        ];

        return view('facilities/show', $data);
    }

    public function edit($id = null)
    {
        $facilityModel = new FacilityModel();
        $data = [
            'facility' => $facilityModel->find($id),
            'title' => 'Edit Facility'
        ];

        return view('facilities/edit', $data);
    }

    public function update($id = null)
    {
        $facilityModel = new FacilityModel();
        $data = $this->request->getPost(['name', 'location', 'type', 'status']);

        if ($facilityModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $facilityModel->errors());
        }

        return redirect()->to('/facilities')->with('success', 'Facility updated successfully.');
    }

    public function delete($id = null)
    {
        $facilityModel = new FacilityModel();
        $facilityModel->delete($id);

        return redirect()->to('/facilities')->with('success', 'Facility deleted successfully.');
    }
}
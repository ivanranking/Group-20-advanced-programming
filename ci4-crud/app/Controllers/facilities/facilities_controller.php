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
}
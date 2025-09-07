<?php

namespace App\Controllers;

use App\Models\FacilityModel;
use App\Controllers\BaseController;

class FacilityController extends BaseController
{
    /**
     * Display a list of all facilities with search/filter.
     */
    public function index()
    {
        $facilityModel = new FacilityModel();
        $search = $this->request->getGet('search');
        $query = $facilityModel;

        if ($search) {
            $query = $query->like('name', $search)
                          ->orLike('description', $search)
                          ->orLike('location', $search);
        }

        $data = [
            'facilities' => $query->findAll(),
            'title' => 'All Facilities',
            'search' => $search
        ];

        return view('facilities/index', $data);
    }

    /**
     * Display a single facility with its projects, services, equipment.
     * @param int $id
     */
    public function show($id = null)
    {
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->find($id);

        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found.');
        }

        $data = [
            'facility' => $facility,
            'projects' => $facilityModel->getProjects($id),
            'services' => $facilityModel->getServices($id),
            'equipment' => $facilityModel->getEquipment($id),
            'title' => esc($facility['name'])
        ];

        return view('facilities/show', $data);
    }

    /**
     * Show a form to create a new facility.
     */
    public function new()
    {
        $data = [
            'title' => 'Create New Facility'
        ];
        return view('facilities/new', $data);
    }

    /**
     * Create a new facility from the submitted form data.
     */
    public function create()
    {
        $facilityModel = new FacilityModel();
        $data = $this->request->getPost(['name', 'description', 'location']);

        if ($facilityModel->save($data) === false) {
            return redirect()->back()->withInput()->with('errors', $facilityModel->errors());
        }

        return redirect()->to('/facilities')->with('success', 'Facility created successfully.');
    }

    /**
     * Show a form to edit an existing facility.
     * @param int $id
     */
    public function edit($id = null)
    {
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->find($id);

        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found.');
        }

        $data = [
            'facility' => $facility,
            'title' => 'Edit Facility: ' . esc($facility['name'])
        ];

        return view('facilities/edit', $data);
    }

    /**
     * Update an existing facility from the submitted form data.
     * @param int $id
     */
    public function update($id = null)
    {
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->find($id);

        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found.');
        }

        $data = $this->request->getPost(['name', 'description', 'location']);

        if ($facilityModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $facilityModel->errors());
        }

        return redirect()->to('/facilities/' . $id)->with('success', 'Facility updated successfully.');
    }

    /**
     * Delete a facility.
     * @param int $id
     */
    public function delete($id = null)
    {
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->find($id);

        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found.');
        }

        if ($facilityModel->delete($id)) {
            return redirect()->to('/facilities')->with('success', 'Facility deleted successfully.');
        } else {
            return redirect()->to('/facilities')->with('error', 'Failed to delete facility.');
        }
    }
}
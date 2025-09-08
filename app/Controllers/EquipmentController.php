<?php

namespace App\Controllers;

use App\Models\EquipmentModel;
use App\Controllers\BaseController;

class EquipmentController extends BaseController
{
    public function index()
    {
        $model = new EquipmentModel();
        $facilityModel = new \App\Models\FacilityModel();
        $facilityId = $this->request->getGet('facility');
        $search = $this->request->getGet('search');

        $query = $model;

        if ($facilityId) {
            $query = $query->where('facility_id', $facilityId);
        }

        if ($search) {
            $query = $query->like('capability', $search)
                          ->orLike('domain', $search)
                          ->orLike('name', $search);
        }

        $data = [
            'equipment_list' => $query->findAll(),
            'title' => 'All Equipment',
            'facility_id' => $facilityId,
            'search' => $search,
            'facilities' => $facilityModel->findAll()
        ];
        return view('equipment/index', $data);
    }

    public function new()
    {
        $facilityModel = new \App\Models\FacilityModel();
        $data = [
            'title' => 'Add New Equipment',
            'facilities' => $facilityModel->findAll()
        ];
        return view('equipment/new', $data);
    }

    public function create()
    {
        $model = new EquipmentModel();
        if ($this->request->getMethod() === 'post' && $model->save($this->request->getPost())) {
            return redirect()->to('/equipment')->with('success', 'Equipment added.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        $model = new EquipmentModel();
        $facilityModel = new \App\Models\FacilityModel();
        $data = [
            'equipment' => $model->find($id),
            'facilities' => $facilityModel->findAll(),
            'title' => 'Edit Equipment'
        ];
        if (empty($data['equipment'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the equipment item: ' . $id);
        }
        return view('equipment/edit', $data);
    }
    
    public function update($id = null)
    {
        $model = new EquipmentModel();
        if ($this->request->getMethod() === 'post' && $model->update($id, $this->request->getPost())) {
            return redirect()->to('/equipment')->with('success', 'Equipment updated.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function delete($id = null)
    {
        $model = new EquipmentModel();
        $model->delete($id);
        return redirect()->to('/equipment')->with('success', 'Equipment deleted.');
    }
}
<?php

namespace App\Controllers;

use App\Models\EquipmentModel;
use CodeIgniter\Controller;

class Equipment extends Controller
{
    public function create()
    {
        return view('equipment/index');
    }

    public function store()
    {
        $equipmentModel = new EquipmentModel();

        $data = [
            'facility'       => $this->request->getPost('facility'),
            'name'           => $this->request->getPost('name'),
            'capabilities'   => $this->request->getPost('capabilities'),
            'usage_domain'   => $this->request->getPost('usage_domain'),
            'description'    => $this->request->getPost('description'),
            'inventory_code' => $this->request->getPost('inventory_code'),
            'support_phase'  => $this->request->getPost('support_phase'),
        ];

        $equipmentModel->save($data);

        return redirect()->to('equipment')->with('success', 'Equipment saved successfully!');
    }

    public function index()
{
    $model = new EquipmentModel();

    $q = $this->request->getGet('q');
    if($q){
        $equipment = $model->like('name', $q)->orLike('facility', $q)->findAll();
    } else {
        $equipment = $model->findAll();
    }

    return view('equipment/index', ['equipment' => $equipment, 'q' => $q]);
}

    public function edit($id)
    {
        $model = new EquipmentModel();
        $equipment = $model->find($id);

        return view('equipment/edit', ['equipment' => $equipment]);
    }

    public function update($id)
    {
        $model = new EquipmentModel();

        $data = [
            'facility' => $this->request->getPost('facility'),
            'name' => $this->request->getPost('name'),
            'capabilities' => $this->request->getPost('capabilities'),
            'usage_domain' => $this->request->getPost('usage_domain'),
            'description' => $this->request->getPost('description'),
            'inventory_code' => $this->request->getPost('inventory_code'),
            'support_phase' => $this->request->getPost('support_phase'),
        ];

        $model->update($id, $data);
        return redirect()->to(site_url('equipment'));
    }

    public function delete($id)
    {
        $model = new EquipmentModel();
        $model->delete($id);
        return redirect()->to(site_url('equipment'));
    }
}

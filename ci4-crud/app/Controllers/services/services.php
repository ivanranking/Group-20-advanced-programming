<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Controllers\BaseController;

class Services extends BaseController
{
    public function index()
    {
        $model = new ServiceModel();
        $data = [
            'services' => $model->findAll(),
            'title' => 'All Services'
        ];
        return view('services/index', $data);
    }

    public function new()
    {
        return view('services/new', ['title' => 'Add New Service']);
    }

    public function create()
    {
        $model = new ServiceModel();
        if ($this->request->getMethod() === 'post' && $model->save($this->request->getPost())) {
            return redirect()->to('/services')->with('success', 'Service added.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        $model = new ServiceModel();
        $data = [
            'service' => $model->find($id),
            'title' => 'Edit Service'
        ];
        if (empty($data['service'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the service item: ' . $id);
        }
        return view('services/edit', $data);
    }
    
    public function update($id = null)
    {
        $model = new ServiceModel();
        if ($this->request->getMethod() === 'post' && $model->update($id, $this->request->getPost())) {
            return redirect()->to('/services')->with('success', 'Service updated.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function delete($id = null)
    {
        $model = new ServiceModel();
        $model->delete($id);
        return redirect()->to('/services')->with('success', 'Service deleted.');
    }
}

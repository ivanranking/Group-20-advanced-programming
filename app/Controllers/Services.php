<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Controllers\BaseController;

class Services extends BaseController
{
    public function index()
    {
        $model = new ServiceModel();
        $facilityModel = new \App\Models\FacilityModel();
        $facilityId = $this->request->getGet('facility');

        $query = $model;

        if ($facilityId) {
            $query = $query->where('facility_id', $facilityId);
        }

        $data = [
            'services' => $query->findAll(),
            'title' => 'All Services',
            'facility_id' => $facilityId,
            'facilities' => $facilityModel->findAll()
        ];
        return view('services/index', $data);
    }

    public function new()
    {
        $facilityModel = new \App\Models\FacilityModel();
        $data = [
            'title' => 'Add New Service',
            'facilities' => $facilityModel->findAll()
        ];
        return view('services/new', $data);
    }

    public function create()
    {
        $model = new ServiceModel();
        if ($this->request->getMethod() === 'post' && $model->save($this->request->getPost())) {
            // Add notification for new service creation
            $serviceData = $this->request->getPost();
            $this->addServiceNotification($serviceData);
            return redirect()->to('/services')->with('success', 'Service added successfully!');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    private function addServiceNotification($serviceData)
    {
        // Create a simple notification system
        $notification = [
            'type' => 'service_created',
            'title' => 'New Service Created',
            'message' => 'A new service "' . ($serviceData['name'] ?? 'Unnamed Service') . '" has been added to the system.',
            'timestamp' => date('Y-m-d H:i:s'),
            'icon' => 'fas fa-cogs',
            'color' => 'success'
        ];

        // Store notification in session for dashboard display
        $existingNotifications = session()->get('dashboard_notifications') ?? [];
        array_unshift($existingNotifications, $notification);

        // Keep only last 10 notifications
        $existingNotifications = array_slice($existingNotifications, 0, 10);

        session()->set('dashboard_notifications', $existingNotifications);
    }

    public function show($id = null)
    {
        $model = new ServiceModel();
        $facilityModel = new \App\Models\FacilityModel();

        $service = $model->find($id);
        if (empty($service)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the service item: ' . $id);
        }

        // Get facility information if service has facility_id
        $facility = null;
        if ($service['facility_id']) {
            $facility = $facilityModel->find($service['facility_id']);
        }

        $data = [
            'service' => $service,
            'facility' => $facility,
            'title' => 'Service Details'
        ];

        return view('services/show', $data);
    }

    public function edit($id = null)
    {
        $model = new ServiceModel();
        $facilityModel = new \App\Models\FacilityModel();
        $data = [
            'service' => $model->find($id),
            'facilities' => $facilityModel->findAll(),
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
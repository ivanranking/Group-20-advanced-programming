<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();

            $data = [
                'title' => 'Dashboard',
                'program_count' => $db->table('programs')->countAll(),
                'project_count' => $db->table('projects')->countAll(),
                'participant_count' => $db->table('participants')->countAll(),
                'equipment_count' => $db->table('equipment')->countAll(),
                'service_count' => $db->table('services')->countAll(),
                'recent_projects' => $db->table('projects')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray()
            ];
        } catch (\Exception $e) {
            $data = [
                'title' => 'Dashboard',
                'program_count' => 0,
                'project_count' => 0,
                'participant_count' => 0,
                'equipment_count' => 0,
                'service_count' => 0,
                'recent_projects' => []
            ];
        }
        
        return view('dashboard/index', $data);
    }
}

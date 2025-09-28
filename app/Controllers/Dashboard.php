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
                'facility_count' => $db->table('facilities')->countAll(),
                'outcome_count' => $db->table('outcomes')->countAll(),
                'recent_projects' => $db->table('projects')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_programs' => $db->table('programs')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_participants' => $db->table('participants')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_equipment' => $db->table('equipment')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_services' => $db->table('services')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_facilities' => $db->table('facilities')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'recent_outcomes' => $db->table('outcomes')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
                'notifications' => session()->get('dashboard_notifications') ?? []
            ];
        } catch (\Throwable $e) {
            $data = [
                'title' => 'Dashboard',
                'program_count' => 0,
                'project_count' => 0,
                'participant_count' => 0,
                'equipment_count' => 0,
                'service_count' => 0,
                'facility_count' => 0,
                'outcome_count' => 0,
                'recent_projects' => [],
                'recent_programs' => [],
                'recent_participants' => [],
                'recent_equipment' => [],
                'recent_services' => [],
                'recent_facilities' => [],
                'recent_outcomes' => []
            ];
        }

        return view('dashboard/index', $data);
    }
}
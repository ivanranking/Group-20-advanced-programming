<?php


namespace App\Controllers;
use App\Models\ProgramModel;
use App\Models\ProjectModel;
use App\Models\ServiceModel;
use App\Models\EquipmentModel;
use App\Models\FacilityModel;
use App\Models\ParticipantModel;
use App\Models\OutcomeModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard', [
            'programsCount'     => (new ProgramModel())->countAll(),
            'projectsCount'     => (new ProjectModel())->countAll(),
            'servicesCount'     => (new ServiceModel())->countAll(),
            'equipmentCount'    => (new EquipmentModel())->countAll(),
            'facilitiesCount'   => (new FacilityModel())->countAll(),
            'participantsCount' => (new ParticipantModel())->countAll(),
            'outcomesCount'     => (new OutcomeModel())->countAll(),
        ]);

        
    }
}

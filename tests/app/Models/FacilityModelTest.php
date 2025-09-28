<?php

namespace Tests\App\Models;

use App\Models\FacilityModel;
use App\Models\ProjectModel;
use App\Models\ServiceModel;
use App\Models\EquipmentModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class FacilityModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;
    protected $projectModel;
    protected $serviceModel;
    protected $equipmentModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new FacilityModel();
        $this->projectModel = new ProjectModel();
        $this->serviceModel = new ServiceModel();
        $this->equipmentModel = new EquipmentModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('facilities')->truncate();
        $this->model->db->table('projects')->truncate();
        $this->model->db->table('services')->truncate();
        $this->model->db->table('equipment')->truncate();
        parent::tearDown();
    }

    public function testInsertValidFacility()
    {
        $data = [
            'name' => 'Test Facility',
            'description' => 'A test facility description',
            'location' => 'City Center'
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('facilities')->countAllResults());

        $facility = $this->model->find($id);
        $this->assertEquals('Test Facility', $facility['name']);
        $this->assertEquals('City Center', $facility['location']);
    }

    public function testUpdateFacility()
    {
        $data = [
            'name' => 'Original Facility',
            'description' => 'Original desc'
        ];
        $id = $this->model->insert($data);

        $updateData = [
            'name' => 'Updated Facility',
            'description' => 'Updated desc',
            'location' => 'New Location',
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $facility = $this->model->find($id);
        $this->assertEquals('Updated Facility', $facility['name']);
        $this->assertEquals('New Location', $facility['location']);
    }

    public function testDeleteFacility()
    {
        $data = [
            'name' => 'To Delete',
            'description' => 'Desc to delete'
        ];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('facilities')->countAllResults());
    }

    public function testFindAllFacilities()
    {
        $this->model->insert(['name' => 'Fac1', 'description' => 'D1']);
        $this->model->insert(['name' => 'Fac2', 'description' => 'D2']);

        $facilities = $this->model->findAll();
        $this->assertCount(2, $facilities);
        $this->assertEquals('Fac1', $facilities[0]['name']);
    }

    public function testGetProjectsForFacility()
    {
        // Insert facility
        $facilityId = $this->model->insert([
            'name' => 'Test Facility with Projects',
            'description' => 'Desc'
        ]);

        // Insert projects for this facility
        $this->projectModel->insert([
            'name' => 'Project 1',
            'description' => 'P1 desc',
            'facility_id' => $facilityId,
            'status' => 'active'
        ]);
        $this->projectModel->insert([
            'name' => 'Project 2',
            'description' => 'P2 desc',
            'facility_id' => $facilityId,
            'status' => 'active'
        ]);

        // Test method
        $projects = $this->model->getProjects($facilityId);
        $this->assertCount(2, $projects);
        $this->assertEquals('Project 1', $projects[0]->name);
    }

    public function testGetServicesForFacility()
    {
        $facilityId = $this->model->insert([
            'name' => 'Test Facility with Services',
            'description' => 'Desc'
        ]);

        $this->serviceModel->insert([
            'name' => 'Service 1',
            'description' => 'S1 desc',
            'facility_id' => $facilityId
        ]);
        $this->serviceModel->insert([
            'name' => 'Service 2',
            'description' => 'S2 desc',
            'facility_id' => $facilityId
        ]);

        $services = $this->model->getServices($facilityId);
        $this->assertCount(2, $services);
        $this->assertEquals('Service 1', $services[0]->name);
    }

    public function testGetEquipmentForFacility()
    {
        $facilityId = $this->model->insert([
            'name' => 'Test Facility with Equipment',
            'description' => 'Desc'
        ]);

        $this->equipmentModel->insert([
            'name' => 'Equipment 1',
            'description' => 'E1 desc',
            'facility_id' => $facilityId
        ]);
        $this->equipmentModel->insert([
            'name' => 'Equipment 2',
            'description' => 'E2 desc',
            'facility_id' => $facilityId
        ]);

        $equipment = $this->model->getEquipment($facilityId);
        $this->assertCount(2, $equipment);
        $this->assertEquals('Equipment 1', $equipment[0]->name);
    }

    public function testGetProjectsForNonExistentFacility()
    {
        $projects = $this->model->getProjects(999);
        $this->assertEmpty($projects);
    }

    public function testGetServicesForNonExistentFacility()
    {
        $services = $this->model->getServices(999);
        $this->assertEmpty($services);
    }

    public function testGetEquipmentForNonExistentFacility()
    {
        $equipment = $this->model->getEquipment(999);
        $this->assertEmpty($equipment);
    }
}
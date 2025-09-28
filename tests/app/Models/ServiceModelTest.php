<?php

namespace Tests\App\Models;

use App\Models\ServiceModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ServiceModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ServiceModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('services')->truncate();
        parent::tearDown();
    }

    public function testInsertValidService()
    {
        $data = [
            'name' => 'Test Service',
            'description' => 'A test service description',
            'facility_id' => 1
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('services')->countAllResults());

        $service = $this->model->find($id);
        $this->assertEquals('Test Service', $service['name']);
        $this->assertEquals(1, $service['facility_id']);
    }

    public function testInsertServiceWithoutFacility()
    {
        $data = [
            'name' => 'Standalone Service',
            'description' => 'No facility'
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);

        $service = $this->model->find($id);
        $this->assertEquals('Standalone Service', $service['name']);
        $this->assertNull($service['facility_id']);
    }

    public function testUpdateService()
    {
        $data = [
            'name' => 'Original Service',
            'description' => 'Original desc'
        ];
        $id = $this->model->insert($data);

        $updateData = [
            'name' => 'Updated Service',
            'description' => 'Updated desc',
            'facility_id' => 2,
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $service = $this->model->find($id);
        $this->assertEquals('Updated Service', $service['name']);
        $this->assertEquals(2, $service['facility_id']);
    }

    public function testDeleteService()
    {
        $data = [
            'name' => 'To Delete',
            'description' => 'Desc to delete'
        ];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('services')->countAllResults());
    }

    public function testFindAllServices()
    {
        $this->model->insert(['name' => 'Serv1', 'description' => 'D1']);
        $this->model->insert(['name' => 'Serv2', 'description' => 'D2']);

        $services = $this->model->findAll();
        $this->assertCount(2, $services);
        $this->assertEquals('Serv1', $services[0]['name']);
    }
}
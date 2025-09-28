<?php

namespace Tests\App\Models;

use App\Models\EquipmentModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class EquipmentModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new EquipmentModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('equipment')->truncate();
        parent::tearDown();
    }

    public function testInsertValidEquipment()
    {
        $data = [
            'name' => 'Test Equipment',
            'description' => 'A test equipment description',
            'capability' => 'High performance',
            'domain' => 'Medical',
            'facility_id' => 1
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('equipment')->countAllResults());

        $equipment = $this->model->find($id);
        $this->assertEquals('Test Equipment', $equipment['name']);
        $this->assertEquals('Medical', $equipment['domain']);
    }

    public function testInsertInvalidEquipmentNoName()
    {
        $data = [
            'description' => 'Description without name',
            'capability' => 'Low'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('name', $validation);
        $this->assertEquals('The equipment name is required.', $validation['name']);
    }

    public function testInsertInvalidEquipmentLongName()
    {
        $data = [
            'name' => str_repeat('A', 256),
            'description' => 'Long name test'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('name', $validation);
        $this->assertEquals('The equipment name cannot exceed 255 characters.', $validation['name']);
    }

    public function testInsertInvalidFacilityIdNonNumeric()
    {
        $data = [
            'name' => 'Invalid Facility',
            'facility_id' => 'abc'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('facility_id', $validation);
        $this->assertEquals('The facility ID must be a number.', $validation['facility_id']);
    }

    public function testUpdateEquipment()
    {
        $data = [
            'name' => 'Original Equipment',
            'description' => 'Original desc',
            'capability' => 'Basic'
        ];
        $id = $this->model->insert($data);

        $updateData = [
            'name' => 'Updated Equipment',
            'description' => 'Updated desc',
            'capability' => 'Advanced',
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $equipment = $this->model->find($id);
        $this->assertEquals('Updated Equipment', $equipment['name']);
        $this->assertEquals('Advanced', $equipment['capability']);
    }

    public function testDeleteEquipment()
    {
        $data = [
            'name' => 'To Delete',
            'description' => 'Desc to delete'
        ];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('equipment')->countAllResults());
    }

    public function testFindAllEquipment()
    {
        $this->model->insert(['name' => 'Equip1', 'description' => 'D1']);
        $this->model->insert(['name' => 'Equip2', 'description' => 'D2']);

        $equipment = $this->model->findAll();
        $this->assertCount(2, $equipment);
        $this->assertEquals('Equip1', $equipment[0]['name']);
    }

    public function testInsertWithEmptyFields()
    {
        $data = [
            'name' => 'Minimal Equipment',
            'description' => '',
            'capability' => '',
            'domain' => '',
            'facility_id' => null
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);

        $equipment = $this->model->find($id);
        $this->assertEquals('', $equipment['description']);
        $this->assertNull($equipment['facility_id']);
    }
}
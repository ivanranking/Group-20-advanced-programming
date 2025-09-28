<?php

namespace Tests\App\Controllers;

use App\Controllers\EquipmentController;
use App\Models\EquipmentModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class EquipmentControllerTest extends FeatureTestCase
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

    public function testIndexReturnsViewWithEquipmentList()
    {
        $this->model->insert([
            'name' => 'Test Equipment 1',
            'description' => 'Description 1'
        ]);
        $this->model->insert([
            'name' => 'Test Equipment 2',
            'description' => 'Description 2'
        ]);

        $result = $this->get('/equipment');

        $result->assertStatus(200);
        $result->assertSee('All Equipment');
        $result->assertSee('Test Equipment 1');
        $result->assertSee('Test Equipment 2');
    }

    public function testNewReturnsView()
    {
        $result = $this->get('/equipment/new');

        $result->assertStatus(200);
        $result->assertSee('Add New Equipment');
        $result->assertSee('Equipment Name');
        $result->assertSee('Description');
        $result->assertSee('Serial Number');
        $result->assertSee('Purchase Date');
        $result->assertSee('Status');
        $result->assertSee('Available');
        $result->assertSee('In Use');
        $result->assertSee('Maintenance');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
        $result->assertSee('csrf_field()');
    }

    public function testCreateValidEquipment()
    {
        $data = [
            'name' => 'New Equipment',
            'description' => 'New description',
            'capability' => 'High',
            'domain' => 'Medical',
            'facility_id' => 1
        ];

        $result = $this->post('/equipment', $data);

        $result->assertStatus(302); // Redirect
        $result->assertRedirect('/equipment');
        $equipment = $this->model->where('name', 'New Equipment')->first();
        $this->assertNotNull($equipment);
    }

    public function testCreateInvalidEquipment()
    {
        $data = [
            'description' => 'No name'
        ];

        $result = $this->post('/equipment', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors'); // Assuming session flash messages
        $this->assertEquals(0, $this->model->countAllResults());
    }

    public function testEditExistingEquipment()
    {
        $id = $this->model->insert([
            'name' => 'Editable Equipment',
            'description' => 'Editable desc',
            'serial_number' => '12345',
            'purchase_date' => '2023-01-01',
            'status' => 'In Use'
        ]);

        $result = $this->get("/equipment/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Equipment');
        $result->assertSee('Editable Equipment');
        $result->assertSee('12345'); // serial_number
        $result->assertSee('2023-01-01'); // purchase_date
        $result->assertSee('selected', '', false, true); // For status select
        $result->assertSee('Equipment Name');
        $result->assertSee('Description');
        $result->assertSee('Serial Number');
        $result->assertSee('Purchase Date');
        $result->assertSee('Status');
        $result->assertSee('Available');
        $result->assertSee('In Use');
        $result->assertSee('Maintenance');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
    }

    public function testEditNonExistingEquipment()
    {
        $result = $this->get('/equipment/edit/999');

        $result->assertStatus(404);
    }

    public function testUpdateValidEquipment()
    {
        $id = $this->model->insert([
            'name' => 'Original Equipment',
            'description' => 'Original'
        ]);

        $updateData = [
            'name' => 'Updated Equipment',
            'description' => 'Updated',
            'capability' => 'Advanced',
            'domain' => 'Tech',
            'facility_id' => 1
        ];

        $result = $this->post("/equipment/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect('/equipment');
        $updated = $this->model->find($id);
        $this->assertEquals('Updated Equipment', $updated['name']);
    }

    public function testUpdateInvalidEquipment()
    {
        $id = $this->model->insert([
            'name' => 'To Update',
            'description' => 'Desc'
        ]);

        $invalidData = [
            'description' => 'No name'
        ];

        $result = $this->post("/equipment/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->model->find($id);
        $this->assertEquals('To Update', $updated['name']); // No change due to validation
    }

    public function testDeleteEquipment()
    {
        $id = $this->model->insert([
            'name' => 'To Delete',
            'description' => 'Delete desc'
        ]);

        $result = $this->post("/equipment/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/equipment');
        $this->assertNull($this->model->find($id));
    }

    public function testDeleteNonExistingEquipment()
    {
        $result = $this->post('/equipment/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/equipment');
        // No error thrown, just redirects
    }
}
<?php

namespace Tests\App\Controllers;

use App\Controllers\Services;
use App\Models\ServiceModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ServicesControllerTest extends FeatureTestCase
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

    public function testIndexReturnsViewWithServicesList()
    {
        $this->model->insert([
            'name' => 'Test Service 1',
            'description' => 'Description 1'
        ]);
        $this->model->insert([
            'name' => 'Test Service 2',
            'description' => 'Description 2'
        ]);

        $result = $this->get('/services');

        $result->assertStatus(200);
        $result->assertSee('All Services');
        $result->assertSee('Test Service 1');
        $result->assertSee('Test Service 2');
    }

    public function testNewReturnsView()
    {
        $result = $this->get('/services/new');

        $result->assertStatus(200);
        $result->assertSee('Add New Service');
    }

    public function testCreateValidService()
    {
        $data = [
            'name' => 'New Service',
            'description' => 'New description'
        ];

        $result = $this->post('/services', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/services');
        $service = $this->model->where('name', 'New Service')->first();
        $this->assertNotNull($service);
    }

    public function testCreateInvalidServiceNoName()
    {
        $data = [
            'description' => 'No name'
        ];

        $result = $this->post('/services', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors');
        $this->assertEquals(0, $this->model->countAllResults());
    }

    public function testEditExistingService()
    {
        $id = $this->model->insert([
            'name' => 'Editable Service',
            'description' => 'Editable desc'
        ]);

        $result = $this->get("/services/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Service');
        $result->assertSee('Editable Service');
    }

    public function testEditNonExistingService()
    {
        $result = $this->get('/services/edit/999');

        $result->assertStatus(404);
    }

    public function testUpdateValidService()
    {
        $id = $this->model->insert([
            'name' => 'Original Service',
            'description' => 'Original'
        ]);

        $updateData = [
            'name' => 'Updated Service',
            'description' => 'Updated'
        ];

        $result = $this->post("/services/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect('/services');
        $updated = $this->model->find($id);
        $this->assertEquals('Updated Service', $updated['name']);
    }

    public function testUpdateInvalidService()
    {
        $id = $this->model->insert([
            'name' => 'To Update',
            'description' => 'Desc'
        ]);

        $invalidData = [
            'description' => 'No name'
        ];

        $result = $this->post("/services/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->model->find($id);
        $this->assertEquals('To Update', $updated['name']); // No change
    }

    public function testDeleteService()
    {
        $id = $this->model->insert([
            'name' => 'To Delete',
            'description' => 'Delete desc'
        ]);

        $result = $this->post("/services/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/services');
        $this->assertNull($this->model->find($id));
    }

    public function testDeleteNonExistingService()
    {
        $result = $this->post('/services/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/services');
        // No error thrown, just redirects
    }
}
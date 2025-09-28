<?php

namespace Tests\App\Controllers;

use App\Controllers\Facilities;
use App\Models\FacilityModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class FacilitiesControllerTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new FacilityModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('facilities')->truncate();
        parent::tearDown();
    }

    public function testIndexReturnsViewWithFacilitiesList()
    {
        $this->model->insert([
            'name' => 'Test Facility 1',
            'description' => 'Description 1'
        ]);
        $this->model->insert([
            'name' => 'Test Facility 2',
            'description' => 'Description 2'
        ]);

        $result = $this->get('/facilities');

        $result->assertStatus(200);
        $result->assertSee('All Facilities');
        $result->assertSee('Test Facility 1');
        $result->assertSee('Test Facility 2');
    }

    public function testNewReturnsView()
    {
        $result = $this->get('/facilities/new');

        $result->assertStatus(200);
        $result->assertSee('Create New Facility');
        $result->assertSee('Name');
        $result->assertSee('Description');
        $result->assertSee('Create Facility');
        $result->assertSee('Cancel');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
        $result->assertSee('csrf_field()');
        $result->assertLinkPresent('/facilities'); // Cancel link
    }

    public function testCreateValidFacility()
    {
        $data = [
            'name' => 'New Facility',
            'description' => 'New description'
        ];

        $result = $this->post('/facilities', $data);

        $result->assertStatus(302); // Redirect
        $result->assertRedirect('/facilities');
        $facility = $this->model->where('name', 'New Facility')->first();
        $this->assertNotNull($facility);
    }

    public function testCreateInvalidFacilityNoName()
    {
        $data = [
            'description' => 'No name'
        ];

        $result = $this->post('/facilities', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors');
        $this->assertEquals(0, $this->model->countAllResults());
    }

    public function testStoreValidFacility()
    {
        $data = [
            'name' => 'Stored Facility',
            'description' => 'Stored description'
        ];

        $result = $this->post('/facilities/store', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/facilities');
        $facility = $this->model->where('name', 'Stored Facility')->first();
        $this->assertNotNull($facility);
    }

    public function testShowExistingFacility()
    {
        $id = $this->model->insert([
            'name' => 'Showable Facility',
            'description' => 'Show desc'
        ]);

        $result = $this->get("/facilities/show/$id");

        $result->assertStatus(200);
        $result->assertSee('Facility Details');
        $result->assertSee('Showable Facility');
    }

    public function testShowNonExistingFacility()
    {
        $result = $this->get('/facilities/show/999');

        $result->assertStatus(404); // Assuming PageNotFoundException, but controller doesn't throw; adjust if needed
    }

    public function testEditExistingFacility()
    {
        $id = $this->model->insert([
            'name' => 'Editable Facility',
            'description' => 'Editable desc'
        ]);

        $result = $this->get("/facilities/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Facility');
        $result->assertSee('Editable Facility');
        $result->assertSee('Name');
        $result->assertSee('Description');
        $result->assertSee('Update Facility'); // Assuming update button
        $result->assertSee('Cancel');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
        $result->assertSee('csrf_field()');
        $result->assertLinkPresent('/facilities'); // Cancel link
    }

    public function testEditNonExistingFacility()
    {
        $result = $this->get('/facilities/edit/999');

        $result->assertStatus(404);
    }

    public function testUpdateValidFacility()
    {
        $id = $this->model->insert([
            'name' => 'Original Facility',
            'description' => 'Original'
        ]);

        $updateData = [
            'name' => 'Updated Facility',
            'location' => 'New Location',
            'type' => 'Hospital',
            'status' => 'Active'
        ];

        $result = $this->post("/facilities/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect('/facilities');
        $updated = $this->model->find($id);
        $this->assertEquals('Updated Facility', $updated['name']);
        $this->assertEquals('Hospital', $updated['type']);
    }

    public function testUpdateInvalidFacility()
    {
        $id = $this->model->insert([
            'name' => 'To Update',
            'description' => 'Desc'
        ]);

        $invalidData = [
            'description' => 'No name'
        ];

        $result = $this->post("/facilities/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->model->find($id);
        $this->assertEquals('To Update', $updated['name']); // No change if validation fails
    }

    public function testDeleteFacility()
    {
        $id = $this->model->insert([
            'name' => 'To Delete',
            'description' => 'Delete desc'
        ]);

        $result = $this->post("/facilities/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/facilities');
        $this->assertNull($this->model->find($id));
    }

    public function testDeleteNonExistingFacility()
    {
        $result = $this->post('/facilities/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/facilities');
        // No error, just redirects
    }
}
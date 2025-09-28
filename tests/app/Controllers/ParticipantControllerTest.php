<?php

namespace Tests\App\Controllers;

use App\Controllers\Participants;
use App\Models\ParticipantModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ParticipantControllerTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ParticipantModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('participants')->truncate();
        parent::tearDown();
    }

    public function testIndexReturnsViewWithParticipantsList()
    {
        $this->model->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com'
        ]);
        $this->model->insert([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com'
        ]);

        $result = $this->get('/participants');

        $result->assertStatus(200);
        $result->assertSee('All Participants');
        $result->assertSee('John Doe');
        $result->assertSee('Jane Smith');
    }

    public function testNewReturnsView()
    {
        $result = $this->get('/participants/new');

        $result->assertStatus(200);
        $result->assertSee('Add New Participant');
        $result->assertSee('First Name');
        $result->assertSee('Last Name');
        $result->assertSee('Email');
        $result->assertSee('Phone');
        $result->assertSee('Role');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
        $result->assertSee('csrf_field()');
        $result->assertSee('type="text"');
        $result->assertSee('type="email"');
        $result->assertSee('type="tel"');
    }

    public function testCreateValidParticipant()
    {
        $data = [
            'first_name' => 'New',
            'last_name' => 'User',
            'email' => 'new@example.com',
            'phone' => '1234567890',
            'role' => 'Tester'
        ];

        $result = $this->post('/participants', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/participants');
        $participant = $this->model->where('email', 'new@example.com')->first();
        $this->assertNotNull($participant);
    }

    public function testCreateInvalidParticipantNoFirstName()
    {
        $data = [
            'last_name' => 'User',
            'email' => 'invalid@example.com'
        ];

        $result = $this->post('/participants', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors');
        $this->assertEquals(0, $this->model->countAllResults());
    }

    public function testEditExistingParticipant()
    {
        $id = $this->model->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'role' => 'Developer'
        ]);

        $result = $this->get("/participants/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Participant');
        $result->assertSee('John');
        $result->assertSee('Doe');
        $result->assertSee('john@example.com');
        $result->assertSee('1234567890');
        $result->assertSee('Developer');
        $result->assertSee('First Name');
        $result->assertSee('Last Name');
        $result->assertSee('Email');
        $result->assertSee('Phone');
        $result->assertSee('Role');
        $result->assertSee('form-control');
        $result->assertSee('form-label');
        $result->assertSee('csrf_field()');
        $result->assertSee('type="text"');
        $result->assertSee('type="email"');
        $result->assertSee('type="tel"');
    }

    public function testEditNonExistingParticipant()
    {
        $result = $this->get('/participants/edit/999');

        $result->assertStatus(404);
    }

    public function testUpdateValidParticipant()
    {
        $id = $this->model->insert([
            'first_name' => 'Original',
            'last_name' => 'Participant',
            'email' => 'original@example.com'
        ]);

        $updateData = [
            'first_name' => 'Updated',
            'last_name' => 'Participant',
            'email' => 'updated@example.com',
            'phone' => '0987654321',
            'role' => 'Manager'
        ];

        $result = $this->post("/participants/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect('/participants');
        $updated = $this->model->find($id);
        $this->assertEquals('Updated', $updated['first_name']);
        $this->assertEquals('updated@example.com', $updated['email']);
    }

    public function testUpdateInvalidParticipant()
    {
        $id = $this->model->insert([
            'first_name' => 'To Update',
            'last_name' => 'Participant',
            'email' => 'to@example.com'
        ]);

        $invalidData = [
            'last_name' => 'Participant',
            'email' => 'invalid@example.com'
        ];

        $result = $this->post("/participants/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->model->find($id);
        $this->assertEquals('To Update', $updated['first_name']); // No change
    }

    public function testDeleteParticipant()
    {
        $id = $this->model->insert([
            'first_name' => 'To Delete',
            'last_name' => 'Participant',
            'email' => 'delete@example.com'
        ]);

        $result = $this->post("/participants/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/participants');
        $this->assertNull($this->model->find($id));
    }

    public function testDeleteNonExistingParticipant()
    {
        $result = $this->post('/participants/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/participants');
        // No error, just redirects
    }
}
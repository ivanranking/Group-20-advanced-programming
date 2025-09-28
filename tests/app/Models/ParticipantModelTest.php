<?php

namespace Tests\App\Models;

use App\Models\ParticipantModel;
use App\Models\ProjectModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ParticipantModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;
    protected $projectModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ParticipantModel();
        $this->projectModel = new ProjectModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('participants')->truncate();
        $this->model->db->table('projects')->truncate();
        $this->model->db->table('project_participants')->truncate();
        parent::tearDown();
    }

    public function testInsertValidParticipant()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'developer',
            'phone' => '+1234567890',
            'profile_picture' => 'john.jpg'
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('participants')->countAllResults());

        $participant = $this->model->find($id);
        $this->assertEquals('John Doe', $participant['name']);
        $this->assertEquals('developer', $participant['role']);
    }

    public function testInsertInvalidParticipantNoName()
    {
        $data = [
            'email' => 'test@example.com',
            'role' => 'manager'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('name', $validation);
        // Assuming default validation; adjust if custom rules exist
        $this->assertNotEmpty($validation['name']);
    }

    public function testInsertInvalidParticipantNoEmail()
    {
        $data = [
            'name' => 'Jane Doe',
            'role' => 'tester'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('email', $validation);
        $this->assertNotEmpty($validation['email']);
    }

    public function testUpdateParticipant()
    {
        $data = [
            'name' => 'Original Name',
            'email' => 'original@example.com',
            'role' => 'admin'
        ];
        $id = $this->model->insert($data);

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'role' => 'lead',
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $participant = $this->model->find($id);
        $this->assertEquals('Updated Name', $participant['name']);
        $this->assertEquals('lead', $participant['role']);
    }

    public function testDeleteParticipant()
    {
        $data = [
            'name' => 'To Delete',
            'email' => 'delete@example.com',
            'role' => 'user'
        ];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('participants')->countAllResults());
    }

    public function testFindAllParticipants()
    {
        $this->model->insert(['name' => 'Part1', 'email' => 'p1@example.com', 'role' => 'dev']);
        $this->model->insert(['name' => 'Part2', 'email' => 'p2@example.com', 'role' => 'mgr']);

        $participants = $this->model->findAll();
        $this->assertCount(2, $participants);
        $this->assertEquals('Part1', $participants[0]['name']);
    }

    public function testGetProjectsForParticipant()
    {
        // Insert participant
        $participantId = $this->model->insert([
            'name' => 'Test Participant with Projects',
            'email' => 'test@example.com',
            'role' => 'developer'
        ]);

        // Insert projects
        $project1Id = $this->projectModel->insert([
            'name' => 'Project 1',
            'description' => 'P1 desc',
            'status' => 'active'
        ]);
        $project2Id = $this->projectModel->insert([
            'name' => 'Project 2',
            'description' => 'P2 desc',
            'status' => 'active'
        ]);

        // Link them
        $db = \Config\Database::connect();
        $db->table('project_participants')->insert([
            'project_id' => $project1Id,
            'participant_id' => $participantId
        ]);
        $db->table('project_participants')->insert([
            'project_id' => $project2Id,
            'participant_id' => $participantId
        ]);

        // Test method
        $projects = $this->model->getProjects($participantId);
        $this->assertCount(2, $projects);
        $this->assertEquals('Project 1', $projects[0]->name);
    }

    public function testGetProjectsForNonExistentParticipant()
    {
        $projects = $this->model->getProjects(999);
        $this->assertEmpty($projects);
    }
}
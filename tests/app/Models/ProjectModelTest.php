<?php

namespace Tests\App\Models;

use App\Models\ProjectModel;
use App\Models\ParticipantModel;
use App\Models\OutcomeModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ProjectModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $model;
    protected $participantModel;
    protected $outcomeModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ProjectModel();
        $this->participantModel = new ParticipantModel();
        $this->outcomeModel = new OutcomeModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->model->db->table('projects')->truncate();
        $this->model->db->table('project_participants')->truncate();
        $this->model->db->table('participants')->truncate();
        $this->model->db->table('outcomes')->truncate();
        parent::tearDown();
    }

    public function testInsertValidProject()
    {
        $data = [
            'name' => 'Test Project',
            'description' => 'A test project description',
            'program_id' => 1,
            'facility_id' => 1,
            'status' => 'active',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('projects')->countAllResults());

        $project = $this->model->find($id);
        $this->assertEquals('Test Project', $project['name']);
        $this->assertEquals('active', $project['status']);
    }

    public function testInsertInvalidProjectNoName()
    {
        $data = [
            'description' => 'Description without name',
            'status' => 'active'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('name', $validation);
        $this->assertEquals('Project name is required.', $validation['name']);
    }

    public function testInsertInvalidProjectInvalidStatus()
    {
        $data = [
            'name' => 'Invalid Status Project',
            'status' => 'invalid'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('status', $validation);
        $this->assertEquals('Project status must be active, inactive, or completed.', $validation['status']);
    }

    public function testUpdateProject()
    {
        $data = [
            'name' => 'Original Project',
            'description' => 'Original desc',
            'status' => 'active'
        ];
        $id = $this->model->insert($data);

        $updateData = [
            'name' => 'Updated Project',
            'status' => 'completed',
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $project = $this->model->find($id);
        $this->assertEquals('Updated Project', $project['name']);
        $this->assertEquals('completed', $project['status']);
    }

    public function testDeleteProject()
    {
        $data = [
            'name' => 'To Delete',
            'description' => 'Desc',
            'status' => 'active'
        ];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('projects')->countAllResults());
    }

    public function testFindAllProjects()
    {
        $this->model->insert(['name' => 'Proj1', 'status' => 'active']);
        $this->model->insert(['name' => 'Proj2', 'status' => 'inactive']);

        $projects = $this->model->findAll();
        $this->assertCount(2, $projects);
        $this->assertEquals('Proj1', $projects[0]['name']);
    }

    public function testGetParticipantsForProject()
    {
        // Insert project
        $projectId = $this->model->insert([
            'name' => 'Test Project with Participants',
            'status' => 'active'
        ]);

        // Insert participants
        $participant1Id = $this->participantModel->insert([
            'name' => 'Participant 1',
            'email' => 'p1@example.com',
            'role' => 'developer'
        ]);
        $participant2Id = $this->participantModel->insert([
            'name' => 'Participant 2',
            'email' => 'p2@example.com',
            'role' => 'manager'
        ]);

        // Link them
        $db = \Config\Database::connect();
        $db->table('project_participants')->insert([
            'project_id' => $projectId,
            'participant_id' => $participant1Id
        ]);
        $db->table('project_participants')->insert([
            'project_id' => $projectId,
            'participant_id' => $participant2Id
        ]);

        // Test method
        $participants = $this->model->getParticipants($projectId);
        $this->assertCount(2, $participants);
        $this->assertEquals('Participant 1', $participants[0]->name);
    }

    public function testAddParticipantToProject()
    {
        $projectId = $this->model->insert(['name' => 'Project', 'status' => 'active']);
        $participantId = $this->participantModel->insert([
            'name' => 'New Participant',
            'email' => 'new@example.com',
            'role' => 'tester'
        ]);

        $result = $this->model->addParticipant($projectId, $participantId);
        $this->assertTrue($result);

        $count = $this->model->db->table('project_participants')
            ->where('project_id', $projectId)
            ->where('participant_id', $participantId)
            ->countAllResults();
        $this->assertEquals(1, $count);
    }

    public function testRemoveParticipantFromProject()
    {
        $projectId = $this->model->insert(['name' => 'Project', 'status' => 'active']);
        $participantId = $this->participantModel->insert([
            'name' => 'To Remove',
            'email' => 'remove@example.com',
            'role' => 'admin'
        ]);

        // Add first
        $this->model->addParticipant($projectId, $participantId);

        // Remove
        $result = $this->model->removeParticipant($projectId, $participantId);
        $this->assertTrue($result);

        $count = $this->model->db->table('project_participants')
            ->where('project_id', $projectId)
            ->where('participant_id', $participantId)
            ->countAllResults();
        $this->assertEquals(0, $count);
    }

    public function testGetOutcomesForProject()
    {
        $projectId = $this->model->insert([
            'name' => 'Project with Outcomes',
            'status' => 'active'
        ]);

        $outcome1Id = $this->outcomeModel->insert([
            'project_id' => $projectId,
            'title' => 'Outcome 1',
            'description' => 'Desc 1'
        ]);
        $outcome2Id = $this->outcomeModel->insert([
            'project_id' => $projectId,
            'title' => 'Outcome 2',
            'description' => 'Desc 2'
        ]);

        $outcomes = $this->model->getOutcomes($projectId);
        $this->assertCount(2, $outcomes);
        $this->assertEquals('Outcome 1', $outcomes[0]->title);
    }

    public function testGetParticipantsForNonExistentProject()
    {
        $participants = $this->model->getParticipants(999);
        $this->assertEmpty($participants);
    }

    public function testGetOutcomesForNonExistentProject()
    {
        $outcomes = $this->model->getOutcomes(999);
        $this->assertEmpty($outcomes);
    }
}
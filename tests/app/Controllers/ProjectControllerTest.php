<?php

namespace Tests\App\Controllers;

use App\Controllers\Projects;
use App\Models\ProjectModel;
use App\Models\ProgramModel;
use App\Models\ParticipantModel;
use App\Models\EquipmentModel;
use App\Models\ServiceModel;
use App\Models\OutcomeModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ProjectControllerTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $projectModel;
    protected $programModel;
    protected $participantModel;
    protected $equipmentModel;
    protected $serviceModel;
    protected $outcomeModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->projectModel = new ProjectModel();
        $this->programModel = new ProgramModel();
        $this->participantModel = new ParticipantModel();
        $this->equipmentModel = new EquipmentModel();
        $this->serviceModel = new ServiceModel();
        $this->outcomeModel = new OutcomeModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->projectModel->db->table('projects')->truncate();
        $this->projectModel->db->table('project_participants')->truncate();
        $this->projectModel->db->table('project_equipment')->truncate();
        $this->projectModel->db->table('project_services')->truncate();
        $this->outcomeModel->db->table('outcomes')->truncate(); // Assuming outcomes table
        parent::tearDown();
    }

    public function testIndexReturnsViewWithProjectsAndProgramNames()
    {
        $programId = $this->programModel->insert([
            'name' => 'Test Program',
            'description' => 'Test desc'
        ]);

        $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Test Project 1',
            'description' => 'Description 1',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ]);
        $this->projectModel->insert([
            'program_id' => null,
            'name' => 'Test Project 2',
            'description' => 'Description 2',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'budget' => 20000,
            'status' => 'In Progress'
        ]);

        $result = $this->get('/projects');

        $result->assertStatus(200);
        $result->assertSee('All Projects');
        $result->assertSee('Test Project 1');
        $result->assertSee('Test Program'); // From join
        $result->assertSee('Test Project 2');
    }

    public function testShowExistingProjectWithAssociations()
    {
        $programId = $this->programModel->insert(['name' => 'Show Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Show Project',
            'description' => 'Show desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 15000,
            'status' => 'Completed'
        ]);

        $participantId = $this->participantModel->insert(['name' => 'Test Participant']);
        $this->projectModel->linkParticipant($projectId, $participantId);

        $equipmentId = $this->equipmentModel->insert(['name' => 'Test Equipment']);
        $this->projectModel->linkEquipment($projectId, $equipmentId);

        $serviceId = $this->serviceModel->insert(['name' => 'Test Service']);
        $this->projectModel->linkService($projectId, $serviceId);

        $this->outcomeModel->insert([
            'project_id' => $projectId,
            'description' => 'Test Outcome'
        ]);

        $result = $this->get("/projects/show/$projectId");

        $result->assertStatus(200);
        $result->assertSee('Show Project');
        $result->assertSee('Test Participant');
        $result->assertSee('Test Equipment');
        $result->assertSee('Test Service');
        $result->assertSee('Test Outcome'); // Assuming view shows these
    }

    public function testShowNonExistingProject()
    {
        $result = $this->get('/projects/show/999');

        $result->assertStatus(302);
        $result->assertRedirect('/projects');
        $this->seeFlash('error');
    }

    public function testNewReturnsViewWithPrograms()
    {
        $this->programModel->insert(['name' => 'Available Program']);

        $result = $this->get('/projects/new');

        $result->assertStatus(200);
        $result->assertSee('Create New Project');
        $result->assertSee('Available Program'); // Assuming select shows programs
    }

    public function testCreateValidProject()
    {
        $programId = $this->programModel->insert(['name' => 'New Program']);

        $data = [
            'program_id' => $programId,
            'name' => 'New Project',
            'description' => 'New desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ];

        $result = $this->post('/projects', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/projects');
        $project = $this->projectModel->where('name', 'New Project')->first();
        $this->assertNotNull($project);
        $this->assertEquals($programId, $project['program_id']);
    }

    public function testCreateInvalidProjectNoName()
    {
        $data = [
            'program_id' => null,
            'description' => 'No name',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'In Progress'
        ];

        $result = $this->post('/projects', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors');
        $this->assertEquals(0, $this->projectModel->countAllResults());
    }

    public function testEditExistingProject()
    {
        $programId = $this->programModel->insert(['name' => 'Edit Program']);
        $id = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Editable Project',
            'description' => 'Editable desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 15000,
            'status' => 'On Hold'
        ]);

        $result = $this->get("/projects/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Project: Editable Project');
        $result->assertSee('Editable Project');
        $result->assertSee('Edit Program'); // From programs list
    }

    public function testEditNonExistingProject()
    {
        $result = $this->get('/projects/edit/999');

        $result->assertStatus(302);
        $result->assertRedirect('/projects');
        $this->seeFlash('error');
    }

    public function testUpdateValidProject()
    {
        $programId = $this->programModel->insert(['name' => 'Update Program']);
        $id = $this->projectModel->insert([
            'program_id' => null,
            'name' => 'Original Project',
            'description' => 'Original',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ]);

        $updateData = [
            'program_id' => $programId,
            'name' => 'Updated Project',
            'description' => 'Updated',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'budget' => 20000,
            'status' => 'Completed'
        ];

        $result = $this->post("/projects/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$id");
        $updated = $this->projectModel->find($id);
        $this->assertEquals('Updated Project', $updated['name']);
        $this->assertEquals('Completed', $updated['status']);
        $this->assertEquals($programId, $updated['program_id']);
    }

    public function testUpdateInvalidProject()
    {
        $id = $this->projectModel->insert([
            'name' => 'To Update',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'In Progress'
        ]);

        $invalidData = [
            'description' => 'No name',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ];

        $result = $this->post("/projects/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->projectModel->find($id);
        $this->assertEquals('To Update', $updated['name']); // No change
    }

    public function testDeleteExistingProject()
    {
        $id = $this->projectModel->insert([
            'name' => 'To Delete',
            'description' => 'Delete desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'On Hold'
        ]);

        // Add associations to test cascade
        $participantId = $this->participantModel->insert(['name' => 'Linked Participant']);
        $this->projectModel->linkParticipant($id, $participantId);

        $result = $this->post("/projects/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/projects');
        $this->assertNull($this->projectModel->find($id));
        // Assuming cascade deletes from pivot, check no record left
        $linkCount = $this->projectModel->db->table('project_participants')->countAllResults();
        $this->assertEquals(0, $linkCount);
    }

    public function testDeleteNonExistingProject()
    {
        $result = $this->post('/projects/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/projects');
        $this->seeFlash('error');
    }

    public function testLinkParticipantToProject()
    {
        $programId = $this->programModel->insert(['name' => 'Link Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Link Project',
            'description' => 'Link desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ]);

        $participantId = $this->participantModel->insert(['name' => 'Link Participant']);

        $data = ['participant_id' => $participantId];
        $result = $this->post("/projects/link_participant/$projectId", $data);

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        $isLinked = $this->projectModel->isParticipantLinked($projectId, $participantId);
        $this->assertTrue($isLinked);
    }

    public function testUnlinkParticipantFromProject()
    {
        $programId = $this->programModel->insert(['name' => 'Unlink Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Unlink Project',
            'description' => 'Unlink desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'In Progress'
        ]);

        $participantId = $this->participantModel->insert(['name' => 'Unlink Participant']);
        $this->projectModel->linkParticipant($projectId, $participantId); // Link first

        $result = $this->post("/projects/unlink_participant/$projectId/$participantId");

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        $isLinked = $this->projectModel->isParticipantLinked($projectId, $participantId);
        $this->assertFalse($isLinked);
    }

    public function testLinkEquipmentToProject()
    {
        $programId = $this->programModel->insert(['name' => 'Equipment Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Equipment Project',
            'description' => 'Equipment desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Completed'
        ]);

        $equipmentId = $this->equipmentModel->insert(['name' => 'Link Equipment']);

        $data = ['equipment_id' => $equipmentId];
        $result = $this->post("/projects/link_equipment/$projectId", $data);

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        // Check pivot
        $linkCount = $this->projectModel->db->table('project_equipment')
            ->where('project_id', $projectId)
            ->where('equipment_id', $equipmentId)
            ->countAllResults();
        $this->assertEquals(1, $linkCount);
    }

    public function testUnlinkEquipmentFromProject()
    {
        $programId = $this->programModel->insert(['name' => 'Unlink Equipment Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Unlink Equipment Project',
            'description' => 'Unlink equipment desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'On Hold'
        ]);

        $equipmentId = $this->equipmentModel->insert(['name' => 'Unlink Equipment']);
        $this->projectModel->linkEquipment($projectId, $equipmentId);

        $result = $this->post("/projects/unlink_equipment/$projectId/$equipmentId");

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        $linkCount = $this->projectModel->db->table('project_equipment')
            ->where('project_id', $projectId)
            ->where('equipment_id', $equipmentId)
            ->countAllResults();
        $this->assertEquals(0, $linkCount);
    }

    public function testLinkServiceToProject()
    {
        $programId = $this->programModel->insert(['name' => 'Service Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Service Project',
            'description' => 'Service desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'Planning'
        ]);

        $serviceId = $this->serviceModel->insert(['name' => 'Link Service']);

        $data = ['service_id' => $serviceId];
        $result = $this->post("/projects/link_service/$projectId", $data);

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        $linkCount = $this->projectModel->db->table('project_services')
            ->where('project_id', $projectId)
            ->where('service_id', $serviceId)
            ->countAllResults();
        $this->assertEquals(1, $linkCount);
    }

    public function testUnlinkServiceFromProject()
    {
        $programId = $this->programModel->insert(['name' => 'Unlink Service Program']);
        $projectId = $this->projectModel->insert([
            'program_id' => $programId,
            'name' => 'Unlink Service Project',
            'description' => 'Unlink service desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31',
            'budget' => 10000,
            'status' => 'In Progress'
        ]);

        $serviceId = $this->serviceModel->insert(['name' => 'Unlink Service']);
        $this->projectModel->linkService($projectId, $serviceId);

        $result = $this->post("/projects/unlink_service/$projectId/$serviceId");

        $result->assertStatus(302);
        $result->assertRedirect("/projects/$projectId");
        $this->seeFlash('success');
        $linkCount = $this->projectModel->db->table('project_services')
            ->where('project_id', $projectId)
            ->where('service_id', $serviceId)
            ->countAllResults();
        $this->assertEquals(0, $linkCount);
    }
}
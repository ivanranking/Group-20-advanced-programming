<?php

namespace Tests\App\Controllers;

use App\Controllers\ProgramController;
use App\Models\ProgramModel;
use App\Models\ProjectModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ProgramControllerTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $programModel;
    protected $projectModel;

    public function setUp(): void
    {
        parent::setUp();
        $this->programModel = new ProgramModel();
        $this->projectModel = new ProjectModel();
        helper('database');
    }

    public function tearDown(): void
    {
        $this->programModel->db->table('programs')->truncate();
        $this->projectModel->db->table('projects')->truncate();
        parent::tearDown();
    }

    public function testIndexReturnsViewWithProgramsList()
    {
        $this->programModel->insert([
            'name' => 'Test Program 1',
            'description' => 'Description 1',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);
        $this->programModel->insert([
            'name' => 'Test Program 2',
            'description' => 'Description 2',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31'
        ]);

        $result = $this->get('/programs');

        $result->assertStatus(200);
        $result->assertSee('All Programs');
        $result->assertSee('Test Program 2'); // Should be first due to DESC order
        $result->assertSee('Test Program 1');
        $result->assertSee('Add New Program');
        $result->assertSee('Name');
        $result->assertSee('Description');
        $result->assertSee('Start Date');
        $result->assertSee('End Date');
        $result->assertSee('Actions');
        $result->assertSee('View');
        $result->assertSee('Edit');
        $result->assertSee('Delete');
        $result->assertSee('table');
        $result->assertSee('btn');
        $result->assertLinkPresent('/programs/new');
        $result->assertLinkPresent('/programs/1');
        $result->assertLinkPresent('/programs/edit/1');
    }

    public function testIndexWithNoProgramsShowsEmptyTable()
    {
        $result = $this->get('/programs');

        $result->assertStatus(200);
        $result->assertSee('All Programs');
        $result->assertSee('No programs found.');
    }

    public function testNewReturnsView()
    {
        $result = $this->get('/programs/new');

        $result->assertStatus(200);
        $result->assertSee('Create New Program');
    }

    public function testCreateValidProgram()
    {
        $data = [
            'name' => 'New Program',
            'description' => 'New description',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ];

        $result = $this->post('/programs', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $program = $this->programModel->where('name', 'New Program')->first();
        $this->assertNotNull($program);
    }

    public function testCreateInvalidProgramNoName()
    {
        $data = [
            'description' => 'No name'
        ];

        $result = $this->post('/programs', $data);

        $result->assertStatus(302);
        $result->assertRedirect();
        $this->seeFlash('errors');
        $this->assertEquals(0, $this->programModel->countAllResults());
    }

    public function testShowExistingProgramWithProjects()
    {
        $programId = $this->programModel->insert([
            'name' => 'Showable Program',
            'description' => 'Show desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);

        $this->projectModel->insert([
            'name' => 'Related Project',
            'program_id' => $programId,
            'start_date' => '2023-06-01',
            'end_date' => '2023-09-30'
        ]);

        $result = $this->get("/programs/show/$programId");

        $result->assertStatus(200);
        $result->assertSee('Showable Program');
        $result->assertSee('Related Project'); // Assuming view shows project names
    }

    public function testShowNonExistingProgram()
    {
        $result = $this->get('/programs/show/999');

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $this->seeFlash('error');
    }

    public function testEditExistingProgram()
    {
        $id = $this->programModel->insert([
            'name' => 'Editable Program',
            'description' => 'Editable desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);

        $result = $this->get("/programs/edit/$id");

        $result->assertStatus(200);
        $result->assertSee('Edit Program: Editable Program');
        $result->assertSee('Editable Program');
    }

    public function testEditNonExistingProgram()
    {
        $result = $this->get('/programs/edit/999');

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $this->seeFlash('error');
    }

    public function testUpdateValidProgram()
    {
        $id = $this->programModel->insert([
            'name' => 'Original Program',
            'description' => 'Original',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);

        $updateData = [
            'name' => 'Updated Program',
            'description' => 'Updated',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31'
        ];

        $result = $this->post("/programs/update/$id", $updateData);

        $result->assertStatus(302);
        $result->assertRedirect("/programs/$id");
        $updated = $this->programModel->find($id);
        $this->assertEquals('Updated Program', $updated['name']);
    }

    public function testUpdateInvalidProgram()
    {
        $id = $this->programModel->insert([
            'name' => 'To Update',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);

        $invalidData = [
            'description' => 'No name'
        ];

        $result = $this->post("/programs/update/$id", $invalidData);

        $result->assertStatus(302);
        $result->assertRedirect();
        $updated = $this->programModel->find($id);
        $this->assertEquals('To Update', $updated['name']); // No change
    }

    public function testUpdateNonExistingProgram()
    {
        $data = [
            'name' => 'Invalid Update',
            'description' => 'Desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ];

        $result = $this->post('/programs/update/999', $data);

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $this->seeFlash('error');
    }

    public function testDeleteExistingProgram()
    {
        $id = $this->programModel->insert([
            'name' => 'To Delete',
            'description' => 'Delete desc',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ]);

        // Insert a project to test association
        $this->projectModel->insert([
            'name' => 'Orphaned Project',
            'program_id' => $id,
            'start_date' => '2023-06-01',
            'end_date' => '2023-09-30'
        ]);

        $result = $this->post("/programs/delete/$id");

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $this->assertNull($this->programModel->find($id));
        // Project should still exist but program_id set to NULL
        $project = $this->projectModel->where('name', 'Orphaned Project')->first();
        $this->assertNull($project['program_id']);
    }

    public function testDeleteNonExistingProgram()
    {
        $result = $this->post('/programs/delete/999');

        $result->assertStatus(302);
        $result->assertRedirect('/programs');
        $this->seeFlash('error');
    }
}
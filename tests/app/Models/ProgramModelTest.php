<?php

namespace Tests\App\Models;

use App\Models\ProgramModel;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class ProgramModelTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $seed = 'Tests\Support\Seeds\TestSeeder'; // Assume a seeder if needed, or handle in tests
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new ProgramModel();
        helper('database');
    }

    public function tearDown(): void
    {
        // Clean up if needed
        $this->model->db->table('programs')->truncate();
        $this->model->db->table('projects')->truncate();
        parent::tearDown();
    }

    public function testInsertValidProgram()
    {
        $data = [
            'name' => 'Test Program',
            'description' => 'A test program description',
            'start_date' => '2023-01-01',
            'end_date' => '2023-12-31'
        ];

        $id = $this->model->insert($data);
        $this->assertNotNull($id);
        $this->assertEquals(1, $this->model->db->table('programs')->countAllResults());

        $program = $this->model->find($id);
        $this->assertEquals('Test Program', $program['name']);
    }

    public function testInsertInvalidProgramNoName()
    {
        $data = [
            'description' => 'Description without name'
        ];

        $result = $this->model->save($data);
        $this->assertFalse($result);
        $validation = $this->model->validation->getErrors();
        $this->assertArrayHasKey('name', $validation);
        $this->assertEquals('Name is required.', $validation['name']);
    }

    public function testUpdateProgram()
    {
        // Insert first
        $data = [
            'name' => 'Original Program',
            'description' => 'Original desc'
        ];
        $id = $this->model->insert($data);

        // Update
        $updateData = [
            'name' => 'Updated Program',
            'id' => $id
        ];
        $result = $this->model->save($updateData);
        $this->assertTrue($result);

        $program = $this->model->find($id);
        $this->assertEquals('Updated Program', $program['name']);
    }

    public function testDeleteProgram()
    {
        $data = ['name' => 'To Delete', 'description' => 'Desc'];
        $id = $this->model->insert($data);

        $result = $this->model->delete($id);
        $this->assertTrue($result);
        $this->assertNull($this->model->find($id));
        $this->assertEquals(0, $this->model->db->table('programs')->countAllResults());
    }

    public function testFindAllPrograms()
    {
        $this->model->insert(['name' => 'Prog1', 'description' => 'D1']);
        $this->model->insert(['name' => 'Prog2', 'description' => 'D2']);

        $programs = $this->model->findAll();
        $this->assertCount(2, $programs);
        $this->assertEquals('Prog1', $programs[0]['name']);
    }

    public function testFindProjectsForProgram()
    {
        // Insert a program
        $programId = $this->model->insert([
            'name' => 'Test Program with Projects',
            'description' => 'Desc'
        ]);

        // Insert projects for this program
        $db = \Config\Database::connect();
        $db->table('projects')->insert([
            'name' => 'Project 1',
            'description' => 'P1 desc',
            'program_id' => $programId,
            'status' => 'active'
        ]);
        $projectId1 = $db->insertID();

        $db->table('projects')->insert([
            'name' => 'Project 2',
            'description' => 'P2 desc',
            'program_id' => $programId,
            'status' => 'active'
        ]);

        // Test the method
        $projects = $this->model->findProjects($programId);
        $this->assertCount(2, $projects);
        $this->assertEquals('Project 1', $projects[0]->name);
    }

    public function testFindProjectsForNonExistentProgram()
    {
        $projects = $this->model->findProjects(999);
        $this->assertEmpty($projects);
    }
}
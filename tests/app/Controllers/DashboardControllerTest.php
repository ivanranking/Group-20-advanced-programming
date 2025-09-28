<?php

namespace Tests\App\Controllers;

use App\Controllers\Dashboard;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\DatabaseTestHelper;

class DashboardControllerTest extends FeatureTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;

    public function setUp(): void
    {
        parent::setUp();
        helper('database');
    }

    public function tearDown(): void
    {
        $db = \Config\Database::connect();
        $db->table('programs')->truncate();
        $db->table('projects')->truncate();
        $db->table('participants')->truncate();
        $db->table('equipment')->truncate();
        $db->table('services')->truncate();
        parent::tearDown();
    }

    public function testIndexWithDataReturnsCorrectCountsAndRecentProjects()
    {
        $db = \Config\Database::connect();
        $db->table('programs')->insert(['name' => 'Program 1']);
        $db->table('projects')->insert([
            'name' => 'Recent Project 1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
        ]);
        $db->table('projects')->insert([
            'name' => 'Recent Project 2',
            'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
        ]);
        $db->table('participants')->insert(['name' => 'Participant 1']);
        $db->table('equipment')->insert(['name' => 'Equipment 1']);
        $db->table('services')->insert(['name' => 'Service 1']);

        $result = $this->get('/dashboard');

        $result->assertStatus(200);
        $result->assertSee('Dashboard');
        $result->assertSee('1'); // program_count
        $result->assertSee('2'); // project_count
        $result->assertSee('1'); // participant_count
        $result->assertSee('1'); // equipment_count
        $result->assertSee('1'); // service_count
        $result->assertSee('Recent Project 1');
        $result->assertSee('Recent Project 2');
    }

    public function testIndexWithNoDataReturnsZeroCountsAndEmptyRecent()
    {
        $result = $this->get('/dashboard');

        $result->assertStatus(200);
        $result->assertSee('Dashboard');
        $result->assertSee('0'); // All counts should be 0
        $result->assertSee('No projects yet.');
        $result->assertSee('Get started by creating your first project.');
        $result->assertSee('Add New Project'); // Button text
        $result->assertLinkPresent(site_url('projects/new')); // Link to new project
        // Quick actions present
        $result->assertSee('Program');
        $result->assertSee('Project');
        $result->assertSee('Participant');
        $result->assertSee('Service');
        $result->assertSee('Equipment');
        $result->assertSee('New');
        $result->assertSee('Manage');
        $result->assertLinkPresent(site_url('programs/new'));
        $result->assertLinkPresent(site_url('programs'));
        // No recent projects
        $result->assertDontSee('Recent Project');
    }

    public function testIndexWithDataIncludesQuickActions()
    {
        $db = \Config\Database::connect();
        $db->table('programs')->insert(['name' => 'Program 1']);
        $db->table('projects')->insert([
            'name' => 'Recent Project 1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
        ]);
        $db->table('participants')->insert(['name' => 'Participant 1']);
        $db->table('equipment')->insert(['name' => 'Equipment 1']);
        $db->table('services')->insert(['name' => 'Service 1']);

        $result = $this->get('/dashboard');

        $result->assertStatus(200);
        $result->assertSee('Dashboard');
        $result->assertSee('1'); // program_count
        $result->assertSee('1'); // project_count
        $result->assertSee('1'); // participant_count
        $result->assertSee('1'); // equipment_count
        $result->assertSee('1'); // service_count
        $result->assertSee('Recent Project 1');
        // Quick actions
        $result->assertSee('Program');
        $result->assertSee('New');
        $result->assertSee('Manage');
        $result->assertLinkPresent(site_url('programs/new'));
        $result->assertLinkPresent(site_url('programs'));
    }
}
<?php

namespace Tests\Feature\Student;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Project;

class StudentProjectsDetailControllerTest extends TestCase
{
    protected $student;
    protected $projects;

    public function setUp(): void
    {
        parent::setUp();

        $this->student = Student::factory()->create();

        $this->projects = Project::factory()->count(3)->create();
        $this->student->resume()->create([
            'project_ids' => json_encode($this->projects->pluck('id')->toArray())
        ]);
    }

    public function test_controller_returns_correct_response_with_valid_uuid()
    {
        $response = $this->get(route('projects.list', ['student' => $this->student->id]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'projects' => [
                    '*' => [
                        'uuid',
                        'project_name',
                        'company_name',
                        'project_url',
                        'tags',
                        'github_url'
                    ]
                ]
            ]);
    }

    public function test_controller_returns_empty_array_with_no_projects_listed()
    {
        $response = $this->get(route('projects.list', ['student' => $this->student->id]));

        $response->assertStatus(200)
        ->assertExactJson(['projects' => []]);
    }

    public function test_controller_returns_404_with_invalid_uuid()
    {
        $invalidUuid = 'invalid_uuid';

        $response = $this->get(route('projects.list', ['student' => $invalidUuid]));

        $response->assertStatus(404);
    }

}

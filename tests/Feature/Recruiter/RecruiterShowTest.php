<?php

namespace Tests\Feature\Recruiter;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RecruiterShowTest extends TestCase
{
    public function verifyOrCreate()
    {
        if (!Role::where('name', 'recruiter')) {
            Role::create(['name' => 'recruiter']);
        }
    }

    public function test_show_specific_recruiter()
    {
        $this->verifyOrCreate();

        $user = User::factory()->create();
        $recruiter = $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',
        ]);
        $this->actingAs($user, 'api');
        $response = $this->get("api/v1/recruiters/{$recruiter->id}");
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonStructure([
            'data' => [
                'name', 'surname', 'company', 'sector',
            ],
        ]);

    }

    public function test_show_another_recruiter()
    {
        $this->verifyOrCreate();

        $user = User::factory()->create();
        $recruiter = $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',
        ]);
        $this->actingAs($user, 'api');
        $response = $this->get('api/v1/recruiters/{8}');
        $response->assertStatus(404);
        $response->assertHeader('Content-Type', 'application/json')->assertJson([
            'message' => 'Usuari no trobat.',

        ]);

    }
}

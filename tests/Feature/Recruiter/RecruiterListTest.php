<?php

namespace Tests\Feature\Recruiter;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RecruiterListTest extends TestCase
{
    public function verifyOrCreateRole()
    {
        if (!Role::where('name', 'recruiter')->exists()) {
            Role::create(['name' => 'recruiter']);

        }
    }

    public function test_it_returns_a_list_of_admins()
    {
        $this->verifyOrCreateRole();

        $user = User::factory()->create();
        $user->recruiter()->create([
            'company' => fake()->name(),
            'sector' => 'TIC',
        ]);
        $user->assignRole('recruiter');

        $this->actingAs($user, 'api');

        $response = $this->get('/api/v1/recruiters');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'surname',
                    'company',
                    'sector',
                ],
            ],
        ]);
    }
}

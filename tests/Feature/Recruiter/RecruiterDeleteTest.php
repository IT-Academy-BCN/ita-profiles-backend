<?php

namespace Tests\Feature\Recruiter;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RecruiterDeleteTest extends TestCase
{
    private function verifyOrCreateRole()
    {
        if (!Role::where('name', 'recruiter')->exists()) {
            Role::create(['name' => 'recruiter']);
        }
    }

    public function test_delete_specifc_recruiter()
    {

        $this->verifyOrCreateRole();

        $user = User::factory()->create([

        ]);
        $user->assignRole('recruiter');
        $recruiter = $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',

        ]);

        $this->actingAs($user, 'api');

        $response = $this->deleteJson("/api/v1/recruiters/{$recruiter->id}");
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(200);

    }

    public function test_cannot_delete_specifc_recruiter()
    {

        $this->verifyOrCreateRole();

        $user = User::factory()->create([

        ]);
        $user->assignRole('recruiter');
        $recruiter = $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',

        ]);

        $fakeId = 9;

        $this->actingAs($user, 'api');

        $response = $this->deleteJson("/api/v1/recruiters/{$fakeId}");
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(401);

    }
}

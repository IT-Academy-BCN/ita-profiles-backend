<?php

namespace Tests\Feature\Recruiter;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RecruiterUpdateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function verifyOrCreateRole()
    {
        if (!Role::where('name', 'recruiter')->exists()) {
            Role::create(['name' => 'recruiter']);

        }
    }

    public function test_update_specific_recruiter()
    {
        $this->verifyOrCreateRole();
        $user = User::factory()->create([

        ]);
        $user->assignRole('recruiter');
        $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',

        ]);
        $data = ['name' => 'Nuevo nombre',
            'surname' => 'Nuevo apellido',
            'email' => 'nuevo@example.com',
            'company' => 'prueba update',
            'sector' => 'TOC', ];
        $this->actingAs($user, 'api');
        $idRecruiter = $user->recruiter->id;
        $response = $this->put("/api/v1/recruiters/{$idRecruiter}", $data);
        $user = $user->fresh();
        $recruiter = $user->recruiter->fresh();
        $this->assertEquals(ucfirst($user->name), $data['name']);
        $this->assertEquals(ucfirst($user->surname), $data['surname']);
        $this->assertEquals(ucfirst($user->recruiter->company), ucfirst($data['company']));
        $this->assertEquals(ucfirst($user->recruiter->sector), $data['sector']);

        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(200);

    }

    public function test_attempting_to_update_another_recruiter()
    {
        $this->verifyOrCreateRole();
        $user = User::factory()->create([
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '87797617Q',
            'email' => fake()->email(),
            'password' => 'passwor',
        ]);
        $user->assignRole('recruiter');
        $user->recruiter()->create([
            'company' => 'Apple',
            'sector' => 'TIC',

        ]);
        $fakeID = fake()->numberBetween();

        $data = ['name' => 'Nuevo nombre',
            'surname' => 'Nuevo Apellido',
            'email' => fake()->email(),
            'company' => 'prueba update',
            'sector' => 'TOC', ];
        $this->actingAs($user, 'api');
        $idRecruiter = $user->recruiter->id;
        $response = $this->put("/api/v1/recruiters/{$fakeID}", $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
            'message' => 'No autoritzat',
        ]);

        $response->assertStatus(401);
    }
}

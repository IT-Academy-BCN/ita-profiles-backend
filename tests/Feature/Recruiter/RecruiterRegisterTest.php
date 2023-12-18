<?php

namespace Tests\Feature\Recruiter;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RecruiterRegisterTest extends TestCase
{
    public function fakeEmail()
    {
        return fake()->email();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function verifyOrCreateRole()
    {

        if (!Role::where('name', 'recruiter')->exists()) {
            Role::create(['name' => 'recruier']);

        }

    }

    public function test_create_recruiter_with_valid_data()
    {
        $this->verifyOrCreateRole();

        $userData = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '33461332N',
            'email' => $this->fakeEmail(),
            'password' => 'password123',
            'company' => 'Apple',
            'sector' => 'Telefonia',
        ];

        $response = $this->post('/api/v1/recruiters', $userData);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'surname' => $userData['surname'],
            'dni' => $userData['dni'],
            'email' => $userData['email'],
        ]);

        $this->assertDatabaseHas('recruiters', [
            'user_id' => User::where('email', $userData['email'])->first()->id,
            'company' => $userData['company'],
            'sector' => $userData['sector'],
        ]);

        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue($user->hasRole('recruiter'));

        $response->assertJson([
            'message' => __('Registre realitzat amb èxit.'),
        ]);

    }

    public function test_cant_create_recruiter_with_bad_email()
    {

        $userData = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '28829324C',
            'email' => 'prueba123',
            'password' => 'password123',
            'company' => 'Apple',
            'sector' => 'Telefonia',
        ];
        $response = $this->post('/api/v1/recruiters', $userData);
        $response->assertHeader('Content-Type', 'application/json')->assertStatus(422)->assertJson([
            'errors' => [
                'email' => [
                    'Adreça electrònica no és un e-mail vàlid',
                ],
            ],
        ]);

    }
}

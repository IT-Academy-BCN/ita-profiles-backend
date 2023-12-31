<?php

namespace Tests\Feature\Student;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentRegisterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function verifyOrCreateRole()
    {
        if (!Role::where('name', 'student')->exists()) {
            Role::create(['name' => 'student']);
        }
    }

    /** @test */
    public function a_student_can_register_with_valid_data(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '79569967H',
            'email' => fake()->email(),
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'surname' => $data['surname'],
            'dni' => $data['dni'],
            'email' => $data['email'],
        ]);

        $this->assertDatabaseHas('students', [
            'subtitle' => $data['subtitle'],
            'bootcamp' => $data['bootcamp'],
            'user_id' => User::where('email', $data['email'])->first()->id,
        ]);

        $user = User::where('email', $data['email'])->first();

        $this->assertTrue($user->hasRole('student'));

        $response->assertStatus(201);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson(['message' => __('Registre realitzat amb èxit.')], 201);
    }

    /** @test */
    public function a_student_can_not_register_with_null_fields(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => null,
            'surname' => null,
            'dni' => null,
            'email' => null,
            'password' => null,
            'subtitle' => null,
            'bootcamp' => null,
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'name', 'surname', 'dni', 'email', 'password', 'subtitle', 'bootcamp',
        ]);
    }

    /** @test */
    public function a_student_can_not_register_if_name_or_surname_contains_numbers(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'John23',
            'surname' => 'Doe23',
            'dni' => '48022981Q',
            'email' => fake()->email(),
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'name', 'surname',
        ]);
    }

    /** @test */
    public function a_student_can_not_register_if_name_or_surname_is_email(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'john@example.com',
            'surname' => 'john@example.com',
            'dni' => '00768001P',
            'email' => fake()->email(),
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'name', 'surname',
        ]);
    }

    /** @test */
    public function a_student_can_not_register_with_invalid_mail(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '18469917C',
            'email' => 'fvdfvfd',
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'email',
        ]);
    }

    /** @test */
    public function a_student_can_not_register_with_invalid_bootcamp(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '79331328G',
            'email' => fake()->email(),
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'bootcamp',
        ]);
    }

    /** @test */
    public function a_student_can_not_register_if_dni_is_invalid(): void
    {
        $this->verifyOrCreateRole();

        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '53671299Z',
            'email' => fake()->email(),
            'password' => 'password123',
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
            //enddate
        ];

        $response = $this->post('/api/v1/students', $data);

        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonValidationErrors([
            'dni',
        ]);
    }
}

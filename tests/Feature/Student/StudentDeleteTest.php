<?php

namespace Tests\Feature\Student;

use App\Models\Student;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentDeleteTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function verifyOrCreateRolesAndPermissions()
    {
        if (!Role::where('name', 'student')->exists()) {
            $student = Role::create(['name' => 'student']);
        }

        if (!Permission::where('name', 'delete.student')->exists()) {
            $deleteStudent = Permission::create(['name' => 'delete.student']);
        }

    }

    /** @test */
    public function a_student_can_get_unregistered(): void
    {
        $this->verifyOrCreateRolesAndPermissions();

        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '64955736X',
            'email' => $email = fake()->email(),
            'password' => bcrypt($password = 'password'),
        ]);

        $user->student()->create([
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
        ]);

        $user->assignRole('student');

        $response = $this->post('api/v1/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $this->actingAs($user, 'api');

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('api/v1/students/' . $user->student->id);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        /*
                $this->assertCount(0, User::all()); */
        $this->assertCount(0, Student::all());

    }

    /** @test */
    public function a_student_cannot_get_unregistered_by_another_student(): void
    {
        $this->verifyOrCreateRolesAndPermissions();

        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '43312254B',
            'email' => $email = fake()->email(),
            'password' => bcrypt($password = 'password'),
        ]);

        $user->student()->create([
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
        ]);

        $user->assignRole('student');

        $response = $this->post('api/v1/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $this->actingAs($user, 'api');

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('api/v1/students/25');

        $response->status(401);

    }
}

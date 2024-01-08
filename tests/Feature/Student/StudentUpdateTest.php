<?php

namespace Tests\Feature\Student;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentUpdateTest extends TestCase
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

        if (!Permission::where('name', 'update.student')->exists()) {
            $updateStudent = Permission::create(['name' => 'update.student']);
        }

    }

    /** @test */
    public function student_data_can_be_updated_by_himself(): void
    {
        $this->verifyOrCreateRolesAndPermissions();

        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '52089182R',
            'email' => fake()->email(),
            'password' => bcrypt($password = 'password'),
        ]);

        $user->student()->create([
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
        ]);

        $user->assignRole('student');
        $this->actingAs($user, 'api');
        $response = $this->post('api/v1/login', [
            'email' => fake()->email(),
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $data = [
            'name' => 'Johnny',
            'surname' => 'Doe',
            'email' => 'johnny@example.com',
            'subtitle' => 'Enginyer Informàtic i Programador',
            'bootcamp' => 'PHP Developer',
            'about' => 'Lorem ipsum dolor sit amet.',
            'cv' => 'New Curriculum',
            'linkedin' => 'http://www.linkedin.com/johnnydoe',
            'github' => 'http://www.github.com/johnnydoe',
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->put('api/v1/students/' . $user->student->id, $data);

        $user = $user->fresh();
        $student = $user->student->fresh();

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $this->assertEquals($user->name, Str::lower($data['name']));
        $this->assertEquals($user->email, Str::lower($data['email']));
        $this->assertEquals($student->cv, $data['cv']);
    }

    /** @test */
    public function student_data_cannot_be_updated_by_another_student(): void
    {
        $this->verifyOrCreateRolesAndPermissions();

        $user = User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'dni' => '74542265R',
            'email' => fake()->email(),
            'password' => bcrypt($password = 'password'),
        ]);

        $user->student()->create([
            'subtitle' => 'Enginyer Informàtic i Programador.',
            'bootcamp' => 'PHP Developer',
        ]);

        $user->assignRole('student');

        $response = $this->post('api/v1/login', [
            'email' => fake()->email(),
            'password' => $password,
        ]);

        $this->actingAs($user, 'api');

        $data = [
            'name' => 'Johnny',
            'surname' => 'Doe',
            'email' => fake()->email(),
            'subtitle' => 'Enginyer Informàtic i Programador',
            'bootcamp' => 'PHP Developer',
            'about' => 'Lorem ipsum dolor sit amet.',
            'cv' => 'New Curriculum',
            'linkedin' => 'http://www.linkedin.com/johnnydoe',
            'github' => 'http://www.github.com/johnnydoe',
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->put('api/v1/students/50', $data);

        $user = $user->fresh();
        $student = $user->student->fresh();

        $response->assertStatus(401);

    }
}

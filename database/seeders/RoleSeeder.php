<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin Role
        $admin = Role::create(['name' => 'admin']);
        //Recruiter Role
        $recruiter = Role::create(['name' => 'recruiter']);
        //Student Role and Permission
        $student = Role::create(['name' => 'student']);

        $updateStudent = Permission::create(['name' => 'update.student']);
        $deleteStudent = Permission::create(['name' => 'delete.student']);

        $student->syncPermissions([$deleteStudent, $updateStudent]);
        //$admin -> syncPermissions([$deleteStudent, $updateStudent]);
    }
}

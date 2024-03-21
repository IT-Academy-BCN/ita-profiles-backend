<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(StudentListSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ProjectSeeder::class);
    }
}

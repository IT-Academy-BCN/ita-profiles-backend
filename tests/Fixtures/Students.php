<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use App\Models\Student;

class Students
{
    public static function aStudent(): Student
    {
        return Student::factory()->create([
            'name' => 'Dokuta',
            'surname' => 'Suranpu',
            'photo' => 'Arale',
        ]);
    }
}

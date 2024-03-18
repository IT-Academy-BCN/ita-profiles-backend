<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentLanguagesDetailController extends Controller
{
    public function __invoke($uuid)
    {
        Student::where('id', $uuid)->firstOrFail();

        $languages_detail = [

            'languages' => [
                [
                    'language_id' => '1',
                    'language_name' => 'Español',
                    'language_level' => 'Nativo',
                ],
                [
                    'language_id' => '2',
                    'language_name' => 'Català',
                    'language_level' => 'Nativo',
                ],
                [
                    'language_id' => '3',
                    'language_name' => 'English',
                    'language_level' => 'Intermedio',
                ]
            ]
        ];

        return response()->json($languages_detail);
    }
}

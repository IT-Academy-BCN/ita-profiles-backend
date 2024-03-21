<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Project;

class StudentProjectsDetailController extends Controller
{
    public function __invoke($uuid)
    {
        $student = Student::where('id', $uuid)->with('resume')->firstOrFail();
        $resume = $student->resume;

        $projectIds = json_decode($resume->project_ids);

        $projects = Project::findMany($projectIds);

        $projects_detail = [
            'projects' => $projects->map(function ($project) {
                return [
                    'uuid' => $project->id,
                    'project_name' => $project->name,
                    'company_name' => $project->company->name,
                    'project_url' => $project->project_url,
                    'tags' => json_decode($project->tags),
                    'github_url' => $project->github_url,
                ];
            })
        ];

        return response()->json($projects_detail);
    }
}

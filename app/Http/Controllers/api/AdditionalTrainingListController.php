<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdditionalTrainingListController extends Controller
{
    public function __invoke(){

        $data = json_decode(file_get_contents(base_path('database/data/addtionalTraining.json')), true);
        
        $additionalTraining = $data['additionalTraining'];

        $quantity = rand(2, min(7, count($additionalTraining))); 
        $selectedProjects = [];
    
        while (count($selectedProjects) < $quantity) {
            $randomProject = $additionalTraining[array_rand($additionalTraining)];
            if (!in_array($randomProject, $selectedProjects)) {
                $selectedProjects[] = $randomProject;
            
            }
        
        }
    
        return response()->json([
            'additionalTraining' => $selectedProjects
        ],200);
    }
}

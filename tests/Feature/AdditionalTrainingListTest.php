<?php 

namespace Tests\Feature;

use Tests\TestCase;

class AdditionalTrainingListTest extends TestCase
{
    public function test_additional_training_list()
    {
        $response = $this->getJson(route('additional-training.list'));

         $response->assertJsonStructure([ 
        'additionalTraining'
        
        ]); 

        $response->assertStatus(200);
  

    }
}
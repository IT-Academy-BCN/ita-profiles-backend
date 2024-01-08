<?php

namespace Tests\Feature;

use App\Rules\DniNieRule;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class DniNieRuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_valid_nif_passes_validation()
    {
        $validator = Validator::make(['dni' => '83749707Z'], [
            'dni' => [new DniNieRule()],
        ]);

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function test_invalid_nif_fails_validation()
    {
        $validator = Validator::make(['dni' => '12345678B'], [
            'dni' => [new DniNieRule()],
        ]);

        $this->assertFalse($validator->passes());
    }

    /** @test */
    public function test_valid_nie_passes_validation()
    {
        $validator = Validator::make(['dni' => 'X7959970S'], [
            'dni' => [new DniNieRule()],
        ]);

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function test_invalid_nie_fails_validation()
    {
        $validator = Validator::make(['dni' => 'X1234567C'], [
            'dni' => [new DniNieRule()],
        ]);

        $this->assertFalse($validator->passes());
    }
}

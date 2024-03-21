<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $tagNames = [
        "PHP", "Laravel", "Javascript",
        "React","Vue","HTML&CSS",
        "MongoDB","SQL","Tailwind",
        "Bootstrap", "JQuery", "Angular",
        "Nodejs","Express", "Java",
        "Python", "C","C++",
        "C#","Ruby","Spring Boot",
        "Ruby on Rails","Django","Redis",
        "Git","GitHub",
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'company_id' => Company::inRandomOrder()->first()->id ?? Company::factory()->create()->id,
            'tags' => json_encode($this->faker->randomElements($this->tagNames, 10)),
            'github_url' => $this->faker->parse('https://github.com/') . $this->faker->userName,
            'project_url' => $this->faker->url,
        ];
    }
}

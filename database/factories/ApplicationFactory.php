<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'document_path' => $this->faker->filePath(),
            'document_name' => $this->faker->fileExtension(),
        ];
    }
}

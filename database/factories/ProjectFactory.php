<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Association;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'association_id' => Association::factory(),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'requested_people' => $this->faker->numberBetween(1, 100),
            'location' => $this->faker->city,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end_date' => $this->faker->dateTimeBetween('+1 year', '+2 years'),
            'expire_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'sum_description' => $this->faker->paragraph,
            'full_description' => $this->faker->text(2000),
            'requirements' => $this->faker->text(500),
            'travel_conditions' => $this->faker->text(500),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private const CATEGORIE = [
        ['name' => 'European Solidarity Corps', 'tag' => 'ESC'],
        ['name' => 'Youth',                     'tag' => 'YTH'],
        ['name' => 'Training',                  'tag' => 'TRG'],
    ];

    public function definition(): array
    {
        return $this->faker->randomElement(self::CATEGORIE);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'tag' => 'ESC',
                'description' => 'European Solidarity Corps'
            ],
            [
                'tag' => 'YTH',
                'description' => 'Youth Programs'
            ],
            [
                'tag' => 'TRG',
                'description' => 'Training and Education'
            ],
            // Puoi aggiungere altre categorie qui
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

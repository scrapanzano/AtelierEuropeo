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
                'name' => 'European Solidarity Corps',
                'tag' => 'ESC',   
            ],
            [
                'name' => 'Youth',
                'tag' => 'YTH',
            ],
            [
                'name' => 'Training',
                'tag' => 'TRG',
            ],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

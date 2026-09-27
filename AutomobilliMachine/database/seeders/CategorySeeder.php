<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Supercar', 'slug' => 'supercar'],
            ['name' => 'Sports Car', 'slug' => 'sports-car'],
            ['name' => 'Grand Tourer', 'slug' => 'grand-tourer'],
            ['name' => 'SUV', 'slug' => 'suv'],
            ['name' => 'Sedan', 'slug' => 'sedan'],
            ['name' => 'Hypercar', 'slug' => 'hypercar'],
            ['name' => 'Track Car', 'slug' => 'track-car'],
            ['name' => 'Race Car', 'slug' => 'race-car'],
            ['name' => 'Coupe', 'slug' => 'coupe'],
            ['name' => 'Convertible', 'slug' => 'convertible'],
            ['name' => 'Concept', 'slug' => 'concept'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}

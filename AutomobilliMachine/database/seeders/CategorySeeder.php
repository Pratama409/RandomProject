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
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}

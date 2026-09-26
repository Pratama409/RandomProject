<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $ferrari = Brand::where('slug', 'ferrari')->firstOrFail();
        $supercar = Category::where('slug', 'supercar')->firstOrFail();
        $grandTourer = Category::where('slug', 'grand-tourer')->firstOrFail();
        $sportsCar = Category::where('slug', 'sports-car')->firstOrFail();

        $cars = [
            [
                'name' => 'Ferrari F40',
                'slug' => 'f40',
                'category_id' => $supercar->id,
                'production_year_start' => 1987,
                'short_description' => 'One of the most iconic Ferrari cars, built around a performance-focused driving experience.',
                'image_path' => 'image/Ferrari F40.jpg',
                'engine' => 'V8 Twin-Turbo',
                'horsepower' => 471,
                'top_speed_kmh' => 324,
                'acceleration_0_100' => 4.10,
                'drivetrain' => 'RWD',
                'is_iconic' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari F12 Berlinetta',
                'slug' => 'f12-berlinetta',
                'category_id' => $grandTourer->id,
                'production_year_start' => 2012,
                'production_year_end' => 2017,
                'short_description' => 'A V12 grand tourer combining high performance, aerodynamic design, and long-distance comfort.',
                'image_path' => 'image/Ferrari F12 Berlinetta.jpg',
                'engine' => '6.3L V12',
                'drivetrain' => 'RWD',
                'is_active' => true,
            ],
            [
                'name' => 'LaFerrari',
                'slug' => 'laferrari',
                'category_id' => $supercar->id,
                'production_year_start' => 2013,
                'production_year_end' => 2018,
                'short_description' => 'A limited-production Ferrari combining a V12 engine with hybrid-assisted performance.',
                'image_path' => 'image/Ferrari LaFerrari.avif',
                'engine' => '6.3L V12 Hybrid',
                'drivetrain' => 'RWD',
                'is_iconic' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari SF90 Spider',
                'slug' => 'sf90-spider',
                'category_id' => $sportsCar->id,
                'production_year_start' => 2020,
                'short_description' => 'A hybrid Ferrari combining a conventional engine with electric motors.',
                'image_path' => 'image/Ferrari SF90 Spider.jpg',
                'engine' => 'V8 Hybrid',
                'horsepower' => 986,
                'top_speed_kmh' => 340,
                'acceleration_0_100' => 2.50,
                'drivetrain' => 'AWD',
                'is_iconic' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari 458 Italia',
                'slug' => '458-italia',
                'category_id' => $sportsCar->id,
                'production_year_start' => 2009,
                'production_year_end' => 2015,
                'short_description' => 'A naturally aspirated V8 sports car combining aerodynamic efficiency with Ferrari design character.',
                'image_path' => 'image/Ferrari 458 Italia.jpg',
                'engine' => '4.5L V8',
                'drivetrain' => 'RWD',
                'is_iconic' => true,
                'is_active' => true,
            ],
        ];

        foreach ($cars as $car) {
            Car::updateOrCreate(
                ['brand_id' => $ferrari->id, 'slug' => $car['slug']],
                array_merge($car, ['brand_id' => $ferrari->id])
            );
        }
    }
}

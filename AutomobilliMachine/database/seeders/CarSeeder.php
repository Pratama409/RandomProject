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
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 4,
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
                'fuel_type' => 'Petrol',
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
                'fuel_type' => 'Hybrid',
                'is_iconic' => true,
                'iconic_order' => 2,
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
                'fuel_type' => 'Hybrid',
                'is_iconic' => true,
                'iconic_order' => 1,
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
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari Enzo',
                'slug' => 'enzo-ferrari',
                'category_id' => $supercar->id,
                'production_year_start' => 2002,
                'production_year_end' => 2004,
                'short_description' => 'A limited-production supercar named after Ferrari founder Enzo Ferrari.',
                'image_path' => 'https://commons.wikimedia.org/wiki/Special:FilePath/FerrariEnzo.JPG',
                'engine' => '6.0L V12',
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari F50',
                'slug' => 'f50',
                'category_id' => $supercar->id,
                'production_year_start' => 1995,
                'production_year_end' => 1997,
                'short_description' => 'A V12 Ferrari supercar developed with a strong connection to Formula 1 engineering.',
                'image_path' => 'https://commons.wikimedia.org/wiki/Special:FilePath/A_Ferrari_F50.jpg',
                'engine' => '4.7L V12',
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari 288 GTO',
                'slug' => '288-gto',
                'category_id' => $supercar->id,
                'production_year_start' => 1984,
                'production_year_end' => 1987,
                'short_description' => 'A limited-production Ferrari that became a landmark in the marque’s supercar lineage.',
                'image_path' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Ferrari_288_GTO_(1984)_(55080132499).jpg',
                'engine' => '2.9L Twin-Turbo V8',
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari Daytona SP3',
                'slug' => 'daytona-sp3',
                'category_id' => $supercar->id,
                'production_year_start' => 2022,
                'short_description' => 'A limited-production Icona model inspired by Ferrari’s legendary sports-prototype racing heritage.',
                'image_path' => 'https://commons.wikimedia.org/wiki/Special:FilePath/2024_Ferrari_Daytona_SP3.jpg',
                'engine' => '6.5L V12',
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 8,
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

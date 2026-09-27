<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::updateOrCreate(
            ['slug' => 'ferrari'],
            [
                'name' => 'Ferrari',
                'country' => 'Italy',
                'founded_year' => 1939,
                'founded_location' => 'Maranello',
                'founder' => 'Enzo Ferrari',
                'vehicle_lineup' => 'Sports Cars & Grand Tourers',
                'tagline' => 'Il Cavallino Rampante',
                'history' => 'Ferrari began with Enzo Ferrari\'s passion for motorsport. He founded Scuderia Ferrari in Modena in 1929, established his own company in 1939, moved the headquarters to Maranello in 1943, built the 125 S in 1947, and produced the first Ferrari road car, the 166 Inter, in 1948.',
                'history_timeline' => [
                    [
                        'year' => '1929',
                        'title' => 'Scuderia Ferrari',
                        'description' => 'Enzo Ferrari founded Scuderia Ferrari in Modena as a racing team, initially competing with Alfa Romeo cars.',
                    ],
                    [
                        'year' => '1939',
                        'title' => 'A New Company',
                        'description' => 'Enzo Ferrari established his own company, initially named Auto Avio Costruzioni.',
                    ],
                    [
                        'year' => '1943',
                        'title' => 'Maranello',
                        'description' => 'Ferrari moved its headquarters from Modena to Maranello, which remains the company\'s home.',
                    ],
                    [
                        'year' => '1947',
                        'title' => 'The 125 S',
                        'description' => 'Ferrari produced the 125 S, its first racing car, powered by a 12-cylinder engine.',
                    ],
                    [
                        'year' => '1948',
                        'title' => 'First Road Car',
                        'description' => 'The Ferrari 166 Inter became the company\'s first road car.',
                    ],
                ],
                'philosophy' => 'Ferrari combines performance, design, aerodynamics, and driving emotion across its road-car portfolio.',
                'known_for' => 'High-performance sports cars and grand tourers.',
                'logo_path' => 'image/CarLogo/FerrariLogo.png',
                'hero_image_path' => 'image/Ferrari SF90 Spider.jpg',
                'history_image_path' => 'image/ferrari.jpg',
                'headquarters' => 'Maranello Factory & Museum',
                'headquarters_address' => 'Via Abetone Inferiore n. 4, 41053 Maranello (MO), Italy.',
                'is_active' => true,
            ]
        );

        Brand::updateOrCreate(
            ['slug' => 'lamborghini'],
            [
                'name' => 'Lamborghini',
                'country' => 'Italy',
                'founded_year' => 1963,
                'founded_location' => "Sant'Agata Bolognese",
                'founder' => 'Ferruccio Lamborghini',
                'vehicle_lineup' => 'Super Sports Cars & SUVs',
                'tagline' => 'Toro Scatenato',
                'known_for' => 'Distinctive supercars and a bold design language.',
                'logo_path' => 'image/CarLogo/LamborghiniLogo.png',
                'hero_image_path' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=1600&auto=format&fit=crop&q=85',
                'history_image_path' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=1600&auto=format&fit=crop&q=85',
                'headquarters' => "Sant'Agata Bolognese",
                'headquarters_address' => "Via Modena 12, 40019 Sant'Agata Bolognese (BO), Italy.",
                'is_active' => true,
            ]
        );

        Brand::updateOrCreate(
            ['slug' => 'mercedes-benz'],
            [
                'name' => 'Mercedes-Benz',
                'country' => 'Germany',
                'founded_year' => 1926,
                'founded_location' => 'Stuttgart',
                'founder' => 'Karl Benz & Gottlieb Daimler',
                'vehicle_lineup' => 'Luxury Cars, SUVs & Performance',
                'tagline' => 'The Best or Nothing',
                'known_for' => 'Luxury, comfort, engineering, and performance vehicles.',
                'logo_path' => 'image/CarLogo/MercedesLogo.png',
                'hero_image_path' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=1600&auto=format&fit=crop&q=85',
                'history_image_path' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=1600&auto=format&fit=crop&q=85',
                'headquarters' => 'Stuttgart',
                'headquarters_address' => 'Stuttgart, Germany.',
                'is_active' => true,
            ]
        );
    }
}

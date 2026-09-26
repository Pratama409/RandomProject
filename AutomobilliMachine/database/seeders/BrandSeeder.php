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
                'history' => 'Rooted in the Scuderia Ferrari racing team founded in 1929, the marque produced its first road car in 1947 with the 125 S.',
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

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
                'history' => 'Ferrari\'s story began with Enzo Ferrari\'s racing career and his ambition to create a team of his own. The company grew from a racing operation into a manufacturer of road and competition cars, with Maranello becoming the centre of the Ferrari story.',
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

                'history_sections' => [
                    [
                        'title' => 'The Beginning',
                        'text' => 'Enzo Ferrari began his motorsport career before founding Scuderia Ferrari in Modena in 1929. The team initially raced Alfa Romeo cars and soon became a major force in Grand Prix competition during the 1930s.',
                        'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Enzo_Ferrari%2C_1947.jpg',
                        'image_alt' => 'Enzo Ferrari with the 1947 Ferrari 125 S',
                    ],
                    [
                        'title' => 'From Scuderia to Ferrari',
                        'text' => 'In 1939, Enzo Ferrari left Alfa Romeo and established Auto Avio Costruzioni. During the Second World War, the company produced aircraft engines and machine tools. In 1943, its headquarters moved from Modena to Maranello, which became the home of Ferrari.',
                        'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/1947-04-20_Maranello_f%C3%A1brica_Ferrari_125_01C_S.jpg',
                        'image_alt' => 'Ferrari 125 S at the Maranello factory in 1947',
                    ],
                    [
                        'title' => 'The First Ferrari Cars',
                        'text' => 'In 1945, Ferrari began developing its own V12 engine and soon adopted the Ferrari name. The 125 S was produced in 1947 and made its racing debut that year, followed by Ferrari’s first road car, the 166 Inter, in 1948.',
                        'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/1947_Ferrari_125_S.jpg',
                        'image_alt' => '1947 Ferrari 125 S',
                    ],
                    [
                        'title' => 'Building the Road-Car Legacy',
                        'text' => 'During the 1950s, Ferrari expanded its road-car business while continuing to compete at the highest level of motorsport. Models such as the 250 series helped establish Ferrari as an internationally recognised manufacturer of high-performance cars.',
                        'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/1953_Ferrari_250_MM_Vignale_Spyder_%2821233465224%29.jpg',
                        'image_alt' => '1953 Ferrari 250 MM Vignale Spyder',
                    ],
                    [
                        'title' => 'A Ferrari That Kept Evolving',
                        'text' => 'From the 1970s onward, Ferrari introduced new mid-engined V6 and V8 road cars alongside its traditional V12 models. The F40 arrived in 1987 and became the final Ferrari introduced during Enzo Ferrari’s lifetime.',
                        'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/1987-1991_Ferrari_F40_%2852870654796%29.jpg',
                        'image_alt' => '1987–1991 Ferrari F40',
                    ],
                    [
                        'title' => 'The Modern Era',
                        'text' => 'Ferrari continued expanding its road-car range and racing programme through the 1990s and 2000s. In 2016, Ferrari completed its separation from FCA and became an independent publicly traded company, continuing its development of sports cars, grand tourers, and newer vehicle segments.',
                        'image' => 'image/Ferrari SF90 Spider.jpg',
                        'image_alt' => 'Ferrari SF90 Spider',
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

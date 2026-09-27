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
                        'text' => 'Enzo Ferrari began working in motorsport before founding Scuderia Ferrari in 1929 in Modena. The team initially supported gentleman drivers and competed with Alfa Romeo machinery, but it soon became a major force in Grand Prix racing during the 1930s.',
                    ],
                    [
                        'title' => 'From Scuderia to Ferrari',
                        'text' => 'After Scuderia Ferrari was absorbed into Alfa Romeo in 1937, Enzo Ferrari left the company in 1939 and founded Auto Avio Costruzioni. Because of an agreement with Alfa Romeo, he could not immediately use the Ferrari name. During the Second World War, the company produced aircraft engines and machine tools, and in 1943 its factory was moved from Modena to Maranello.',
                    ],
                    [
                        'title' => 'The First Ferrari Cars',
                        'text' => 'In 1945 the company adopted the Ferrari name and began work on a new V12 engine. The 125 S became Ferrari\'s first car and made its racing debut in 1947. That same year, it scored Ferrari\'s first victory at the Rome Grand Prix, establishing an important foundation for the company\'s future in motorsport.',
                    ],
                    [
                        'title' => 'Building the Road-Car Legacy',
                        'text' => 'Ferrari\'s success on the track quickly supported its road-car business. During the 1950s, models such as the 250 series helped establish Ferrari among an international audience, while the company continued developing cars that connected racing experience with road use. Ferrari was reorganized as a public company in 1960 and later entered a manufacturing partnership with Fiat.',
                    ],
                    [
                        'title' => 'A Ferrari That Kept Evolving',
                        'text' => 'From the 1970s onward, Ferrari expanded beyond its traditional front-engined V12 formula, introducing mid-engined V6 and V8 road cars. Enzo Ferrari died in 1988, and the F40, which he personally approved, became the final Ferrari introduced during his lifetime.',
                    ],
                    [
                        'title' => 'The Modern Era',
                        'text' => 'Under Luca di Montezemolo in the 1990s and 2000s, Ferrari expanded its road-car range and strengthened its Formula One programme. The company later completed its separation from Fiat Chrysler Automobiles and became an independent publicly traded company in 2016, while continuing to develop sports cars, grand tourers, and newer vehicle segments.',
                    ],
                ],                'philosophy' => 'Ferrari combines performance, design, aerodynamics, and driving emotion across its road-car portfolio.',
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

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
        $trackCar = Category::where('slug', 'track-car')->firstOrFail();
        $raceCar = Category::where('slug', 'race-car')->firstOrFail();

        $cars = [
            [
                'name' => 'Ferrari F40',
                'slug' => 'f40',
                'model_family' => 'F40',
                'production_type' => 'Limited',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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
                'model_family' => 'F12',
                'production_type' => 'Production',
                'vehicle_type' => 'Grand Tourer',
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
                'model_family' => 'LaFerrari',
                'production_type' => 'Limited',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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
                'model_family' => 'SF90',
                'production_type' => 'Production',
                'vehicle_type' => 'Road Car',
                'category_id' => $sportsCar->id,
                'production_year_start' => 2020,
                'short_description' => 'A hybrid Ferrari combining a conventional engine with electric motors.',
                'detail_sections' => [
                    [
                        'label' => 'DESIGN',
                        'title' => 'Aerodynamics & Design',
                        'paragraphs' => [
                            'The SF90 Stradale was developed around a close collaboration between Ferrari's Styling Centre and its engineering teams, with the body designed to manage airflow, cooling, and hybrid-system requirements.',
                            'Ferrari states that the car can generate 390 kg of downforce at 250 km/h. Its rear aero system uses a movable section to balance aerodynamic load and drag.'
                        ],
                        'specs' => [
                            ['label' => 'Design Centre', 'value' => 'Ferrari Styling Centre'],
                            ['label' => 'Design Direction', 'value' => 'Flavio Manzoni'],
                            ['label' => 'Downforce', 'value' => '390 kg at 250 km/h'],
                            ['label' => 'Layout', 'value' => 'Mid-engine, all-wheel drive']
                        ]
                    ],
                    [
                        'label' => 'POWERTRAIN',
                        'title' => 'V8 + Three Electric Motors',
                        'paragraphs' => [
                            'The powertrain combines a 90-degree twin-turbo V8 with three electric motors: one positioned between the engine and gearbox and two on the front axle.',
                            'The combustion engine produces 780 CV while the electric system contributes 220 CV, giving a combined system output of 1,000 CV (986 hp).'
                        ],
                        'specs' => [
                            ['label' => 'Engine', 'value' => '3.99 L 90° twin-turbo V8'],
                            ['label' => 'Engine Output', 'value' => '780 CV'],
                            ['label' => 'Electric Motors', 'value' => '3'],
                            ['label' => 'Electric Output', 'value' => '220 CV'],
                            ['label' => 'Combined Output', 'value' => '1,000 CV / 986 hp'],
                            ['label' => 'Battery', 'value' => '7.9 kWh lithium-ion'],
                            ['label' => 'Electric Range', 'value' => '26 km']
                        ]
                    ],
                    [
                        'label' => 'DRIVING',
                        'title' => 'Four Power Unit Modes',
                        'paragraphs' => [
                            'The eManettino control provides four operating modes that change how the petrol engine, electric motors, battery, and control systems work together.'
                        ],
                        'items' => [
                            'eDrive — electric-only operation.',
                            'Hybrid — automatic management of the combustion engine and electric system.',
                            'Performance — keeps the engine active while prioritising responsiveness and battery charging.',
                            'Qualify — unlocks the maximum performance potential of the powertrain.'
                        ]
                    ],
                    [
                        'label' => 'TRANSMISSION',
                        'title' => 'Eight-Speed Dual-Clutch',
                        'paragraphs' => [
                            'Power is delivered through an eight-speed F1 dual-clutch gearbox. The front electric motors provide the all-wheel-drive system used by the SF90 Stradale.'
                        ],
                        'specs' => [
                            ['label' => 'Gearbox', 'value' => '8-speed F1 dual-clutch'],
                            ['label' => 'Drivetrain', 'value' => 'All-wheel drive'],
                            ['label' => 'Transmission', 'value' => 'Dual-clutch automatic']
                        ]
                    ],
                    [
                        'label' => 'DIMENSIONS',
                        'title' => 'Size & Weight',
                        'specs' => [
                            ['label' => 'Length', 'value' => '4,710 mm'],
                            ['label' => 'Width', 'value' => '1,972 mm'],
                            ['label' => 'Height', 'value' => '1,186 mm'],
                            ['label' => 'Wheelbase', 'value' => '2,650 mm'],
                            ['label' => 'Dry Weight', 'value' => '1,600 kg base'],
                            ['label' => 'Dry Weight', 'value' => '1,570 kg Assetto Fiorano']
                        ]
                    ],
                    [
                        'label' => 'PERFORMANCE',
                        'title' => 'Factory Performance Figures',
                        'paragraphs' => [
                            'The figures below are manufacturer specifications. They remain marked Not Tested in AutomobilliMachine until an independently verified test record is added to the catalog.'
                        ],
                        'specs' => [
                            ['label' => 'Top Speed', 'value' => '340 km/h'],
                            ['label' => '0–100 km/h', 'value' => '2.5 s'],
                            ['label' => '0–200 km/h', 'value' => '6.7 s'],
                            ['label' => '100–0 km/h', 'value' => '<29.5 m'],
                            ['label' => 'Fiorano Lap', 'value' => '79 s'],
                            ['label' => 'Weight / Power', 'value' => '1.57 kg/CV']
                        ]
                    ]
                ],
                'variants' => [
                    [
                        'type' => 'Open-top derivative',
                        'name' => 'SF90 Spider',
                        'years' => '2021–2024',
                        'description' => 'A retractable-hardtop convertible derivative built around the same SF90 hybrid architecture.'
                    ],
                    [
                        'type' => 'Performance package',
                        'name' => 'Assetto Fiorano',
                        'years' => 'SF90 Stradale option package',
                        'description' => 'A lighter, more track-focused configuration using specialised equipment and weight-saving measures.'
                    ],
                    [
                        'type' => 'Track-focused derivative',
                        'name' => 'SF90 XX Stradale',
                        'years' => '2023–2025',
                        'description' => 'A more extreme road-legal derivative developed from Ferrari's XX programme.'
                    ]
                ],
                'source_links' => [
                    [
                        'label' => 'Ferrari technical release',
                        'url' => 'https://cdn.ferrari.com/cms/network/media/pdf/pr_ferrari_sf90_stradale_gbr.pdf'
                    ],
                    [
                        'label' => 'Wikipedia — Ferrari SF90 Stradale',
                        'url' => 'https://en.wikipedia.org/wiki/Ferrari_SF90_Stradale'
                    ]
                ],
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
                'model_family' => '458',
                'production_type' => 'Production',
                'vehicle_type' => 'Road Car',
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
                'model_family' => 'Enzo',
                'production_type' => 'Limited',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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
                'model_family' => 'F50',
                'production_type' => 'Limited',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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
                'model_family' => '288 GTO',
                'production_type' => 'Limited',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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
                'model_family' => 'Daytona SP3',
                'production_type' => 'Icona',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
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

            [
                'name' => 'Ferrari 250 GTO',
                'slug' => '250-gto',
                'model_family' => '250',
                'category_id' => $raceCar->id,
                'production_year_start' => 1962,
                'production_year_end' => 1964,
                'production_count' => 36,
                'production_type' => 'Limited',
                'vehicle_type' => 'Road & Competition',
                'road_legal' => true,
                'publicly_sold' => true,
                'is_limited' => true,
                'short_description' => 'A landmark Ferrari developed for GT competition and homologated for road use.',
                'image_path' => null,
                'engine' => '3.0L V12',
                'fuel_type' => 'Petrol',
                'is_iconic' => true,
                'iconic_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari SP38',
                'slug' => 'sp38',
                'model_family' => 'SP38',
                'category_id' => $supercar->id,
                'production_year_start' => 2018,
                'production_year_end' => 2018,
                'production_count' => 1,
                'production_type' => 'One-Off',
                'vehicle_type' => 'Road Car',
                'road_legal' => true,
                'publicly_sold' => false,
                'is_limited' => true,
                'is_one_off' => true,
                'base_model' => '488 GTB',
                'short_description' => 'A Ferrari One-Off created for a client through Ferrari’s special projects programme.',
                'image_path' => null,
                'engine' => 'V8 Twin-Turbo',
                'fuel_type' => 'Petrol',
                'is_iconic' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari FXX-K',
                'slug' => 'fxx-k',
                'model_family' => 'FXX',
                'category_id' => $trackCar->id,
                'production_year_start' => 2015,
                'production_year_end' => 2016,
                'production_type' => 'Track Series',
                'vehicle_type' => 'Track Car',
                'road_legal' => false,
                'publicly_sold' => false,
                'is_limited' => true,
                'is_track_only' => true,
                'base_model' => 'LaFerrari',
                'short_description' => 'A Ferrari track car developed for high-performance circuit use.',
                'image_path' => null,
                'engine' => 'V12 Hybrid',
                'fuel_type' => 'Hybrid',
                'is_iconic' => false,
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'country',
        'founded_year',
        'founded_location',
        'founder',
        'vehicle_lineup',
        'tagline',
        'history',
        'philosophy',
        'known_for',
        'logo_path',
        'hero_image_path',
        'headquarters',
        'headquarters_address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'founded_year' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}

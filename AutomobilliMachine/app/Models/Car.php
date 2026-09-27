<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'model_family',
        'generation',
        'variant',
        'slug',
        'production_year_start',
        'production_year_end',
        'production_count',
        'production_type',
        'vehicle_type',
        'road_legal',
        'publicly_sold',
        'is_limited',
        'is_one_off',
        'is_concept',
        'is_track_only',
        'is_racing',
        'base_model',
        'short_description',
        'description',
        'image_path',
        'engine',
        'horsepower',
        'torque_nm',
        'acceleration_0_100',
        'top_speed_kmh',
        'drivetrain',
        'transmission',
        'fuel_type',
        'body_type',
        'is_iconic',
        'iconic_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'production_year_start' => 'integer',
            'production_year_end' => 'integer',
            'production_count' => 'integer',
            'road_legal' => 'boolean',
            'publicly_sold' => 'boolean',
            'is_limited' => 'boolean',
            'is_one_off' => 'boolean',
            'is_concept' => 'boolean',
            'is_track_only' => 'boolean',
            'is_racing' => 'boolean',
            'horsepower' => 'integer',
            'torque_nm' => 'integer',
            'acceleration_0_100' => 'decimal:2',
            'top_speed_kmh' => 'integer',
            'is_iconic' => 'boolean',
            'iconic_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function wishlistedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')
            ->withPivot('note')
            ->withTimestamps();
    }
}

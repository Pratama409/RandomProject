<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('car_categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->unsignedSmallInteger('production_year_start')->nullable();
            $table->unsignedSmallInteger('production_year_end')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('engine')->nullable();
            $table->unsignedSmallInteger('horsepower')->nullable();
            $table->unsignedInteger('torque_nm')->nullable();
            $table->decimal('acceleration_0_100', 4, 2)->nullable();
            $table->unsignedSmallInteger('top_speed_kmh')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('body_type')->nullable();
            $table->boolean('is_iconic')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['brand_id', 'slug']);
            $table->index(['brand_id', 'is_active']);
            $table->index(['category_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

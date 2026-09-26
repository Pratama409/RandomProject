<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('country', 100);
            $table->unsignedSmallInteger('founded_year')->nullable();
            $table->string('founded_location')->nullable();
            $table->string('founder')->nullable();
            $table->string('vehicle_lineup')->nullable();
            $table->string('tagline')->nullable();
            $table->text('history')->nullable();
            $table->text('philosophy')->nullable();
            $table->text('known_for')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('headquarters')->nullable();
            $table->text('headquarters_address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};

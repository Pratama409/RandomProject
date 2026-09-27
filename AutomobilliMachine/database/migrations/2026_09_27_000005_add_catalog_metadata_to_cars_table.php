<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('model_family')->nullable()->after('name');
            $table->string('generation')->nullable()->after('model_family');
            $table->string('variant')->nullable()->after('generation');

            $table->unsignedInteger('production_count')->nullable()->after('production_year_end');
            $table->string('production_type', 40)->default('Production')->after('production_count');
            $table->string('vehicle_type', 40)->default('Road Car')->after('production_type');

            $table->boolean('road_legal')->default(true)->after('vehicle_type');
            $table->boolean('publicly_sold')->default(true)->after('road_legal');
            $table->boolean('is_limited')->default(false)->after('publicly_sold');
            $table->boolean('is_one_off')->default(false)->after('is_limited');
            $table->boolean('is_concept')->default(false)->after('is_one_off');
            $table->boolean('is_track_only')->default(false)->after('is_concept');
            $table->boolean('is_racing')->default(false)->after('is_track_only');
            $table->string('base_model')->nullable()->after('is_racing');

            $table->index(['brand_id', 'production_type', 'is_active']);
            $table->index(['brand_id', 'vehicle_type', 'is_active']);
            $table->index(['brand_id', 'production_year_start', 'production_year_end']);
            $table->index(['brand_id', 'is_one_off', 'is_concept']);
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['brand_id', 'production_type', 'is_active']);
            $table->dropIndex(['brand_id', 'vehicle_type', 'is_active']);
            $table->dropIndex(['brand_id', 'production_year_start', 'production_year_end']);
            $table->dropIndex(['brand_id', 'is_one_off', 'is_concept']);

            $table->dropColumn([
                'model_family',
                'generation',
                'variant',
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
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->json('detail_sections')->nullable()->after('description');
            $table->json('gallery_images')->nullable()->after('detail_sections');
            $table->json('variants')->nullable()->after('gallery_images');
            $table->json('source_links')->nullable()->after('variants');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'detail_sections',
                'gallery_images',
                'variants',
                'source_links',
            ]);
        });
    }
};

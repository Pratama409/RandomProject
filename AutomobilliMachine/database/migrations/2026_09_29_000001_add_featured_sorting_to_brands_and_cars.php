<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('is_featured');
            $table->index(['is_active', 'is_featured', 'sort_order']);
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_iconic');
            $table->index(['is_active', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'is_featured']);
            $table->dropColumn('is_featured');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'is_featured', 'sort_order']);
            $table->dropColumn(['is_featured', 'sort_order']);
        });
    }
};

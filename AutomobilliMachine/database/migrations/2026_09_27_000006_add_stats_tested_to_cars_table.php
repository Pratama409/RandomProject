<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->boolean('stats_tested')->default(false)->after('acceleration_0_100');
            $table->index(['brand_id', 'stats_tested', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['brand_id', 'stats_tested', 'is_active']);
            $table->dropColumn('stats_tested');
        });
    }
};

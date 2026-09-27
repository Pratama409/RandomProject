<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedTinyInteger('iconic_order')->nullable()->after('is_iconic');
            $table->index(['brand_id', 'is_iconic', 'iconic_order']);
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['brand_id', 'is_iconic', 'iconic_order']);
            $table->dropColumn('iconic_order');
        });
    }
};

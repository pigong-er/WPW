<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('alat_outdoors', 'is_active')) {
            Schema::table('alat_outdoors', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('alat_outdoors', 'is_active')) {
            Schema::table('alat_outdoors', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};

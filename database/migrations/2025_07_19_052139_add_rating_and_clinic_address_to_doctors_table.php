<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->default(0.00)->after('is_available');
            $table->string('clinic_address')->nullable()->after('rating');
            $table->string('clinic_phone')->nullable()->after('clinic_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['rating', 'clinic_address', 'clinic_phone']);
        });
    }
};

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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->integer('experience_years')->default(0);
            $table->decimal('consultation_fee', 8, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->text('education')->nullable();
            $table->text('certifications')->nullable();
            $table->json('languages')->nullable();
            $table->time('start_time')->default('09:00');
            $table->time('end_time')->default('17:00');
            $table->json('available_days')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};

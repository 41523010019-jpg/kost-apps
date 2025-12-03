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
        Schema::create('price_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->integer('price_per_month'); // 750000, 950000, 1250000
            $table->json('facilities')->nullable(); // list fasilitas
            $table->boolean('is_popular')->default(false); // utk Gold → paling populer

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_packages');
    }
};

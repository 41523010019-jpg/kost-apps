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
        Schema::create('web_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_title');
            $table->text('site_description')->nullable();

            // Simpan sosial media dalam JSON
            // contoh: { "instagram": "...", "facebook": "...", "whatsapp": "..." }
            $table->json('social_media')->nullable();

            $table->string('copyright')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_settings');
    }
};

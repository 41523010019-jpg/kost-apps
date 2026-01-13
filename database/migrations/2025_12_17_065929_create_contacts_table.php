<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->string('title')->default('Hubungi Kami');
            $table->text('description')->nullable();

            $table->text('address');
            $table->text('address_note')->nullable();

            $table->string('phone', 50);
            $table->string('phone_note')->nullable();

            $table->string('email')->nullable();

            $table->longText('map_embed')->nullable();
            // simpan src iframe google maps

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

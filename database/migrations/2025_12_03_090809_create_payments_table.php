<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bill_id')->nullable()->constrained('monthly_bills')->cascadeOnDelete();

            $table->integer('amount');
            $table->enum('method', ['cash', 'midtrans']);

            // khusus Midtrans
            $table->string('order_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

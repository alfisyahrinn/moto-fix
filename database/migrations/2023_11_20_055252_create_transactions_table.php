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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');// Added field for user ID
            $table->string('payment_status')->default('unpaid'); // Added field for payment status
            $table->unsignedBigInteger('total_price')->default('0');
            $table->string('payment_method')->nullable(); // Added field for payment method
            $table->string('payment_transaction_id')->nullable(); // Added field for payment transaction ID
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('queue_id')->constrained()->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
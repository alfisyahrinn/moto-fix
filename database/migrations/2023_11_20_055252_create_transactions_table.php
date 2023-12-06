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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('queue_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid');
            $table->unsignedBigInteger('total_price')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamp('payment_expiration')->nullable();
            $table->string('payment_channel')->nullable();
            $table->timestamp('transaction_time')->nullable(); // Add this line
            $table->string('transaction_status')->nullable(); // Add this line
            $table->string('fraud_status')->nullable(); // Add this line
            $table->string('masked_card')->nullable(); // Add this line
            $table->string('gross_amount')->nullable(); // Add this line
            $table->timestamp('expiry_time')->nullable(); // Add this line
            $table->string('currency')->nullable(); // Add this line
            $table->string('channel_response_message')->nullable(); // Add this line
            $table->string('channel_response_code')->nullable(); // Add this line
            $table->string('card_type')->nullable(); // Add this line
            $table->string('bank')->nullable(); // Add this line
            $table->string('approval_code')->nullable(); // Add this line
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
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
            
            $table->string('status')->default('0');
            $table->unsignedBigInteger('total_price')->default('0');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('queue_id')->constrained()->onDelete('cascade');
            // $table->foreign('detail_service_id')->references('id')->on('detail_service');
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
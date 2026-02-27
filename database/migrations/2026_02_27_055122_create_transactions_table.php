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
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('request_id');

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('wallet_id')->references('id')->on('wallets');
            $table->foreignId('request_id')->references('id')->on('users');

            $table->bigInteger('amount');
            $table->bigInteger('balance_before');
            $table->bigInteger('balance_after');

            $table->enum('type', ['usage', 'purchase', 'bonus']);
            $table->enum('status', ['completed', 'failed', 'pending', 'cancelled']);

            $table->text('description');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
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

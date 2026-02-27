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
        Schema::create('transactions_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('user_id');

            $table->foreignId('wallet_id')->references('id')->on('wallets');
            $table->foreignId('transaction_id')->references('id')->on('transactions');
            $table->foreignId('user_id')->references('id')->on('users');

            $table->text('error_message');

            $table->enum('log_type', ['error', 'request', 'verify', 'callback']);

            $table->integer('http_status_code');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_logs');
    }
};

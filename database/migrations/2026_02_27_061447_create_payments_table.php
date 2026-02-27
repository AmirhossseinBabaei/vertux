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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('gateway_payment_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('gateway_payment_id')->references('id')->on('payment_gateways');

            $table->decimal('amount', 12, 0);
            $table->bigInteger('coin_amount');

            $table->enum('status', ['pending', 'paid', 'completed', 'failed', 'expired'])->default('pending');

            $table->text('bank_operation_code');
            $table->text('authority');

            $table->timestamp('created_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('completed_at')->nullable();
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

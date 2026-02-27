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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('payment_gateway_id');

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways');

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
        Schema::dropIfExists('payment_logs');
    }
};

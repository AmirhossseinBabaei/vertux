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

            $table->foreignId('payment_id')->references('id')->on('payments');
            $table->foreignId('payment_gateway_id')->references('id')->on('payment_gateways');

            $table->enum('log_type', ['error', 'request', 'verify', 'callback']);

            $table->jsonb('request_data');
            $table->jsonb('response_data');

            $table->integer('http_status_code');

            $table->timestamps();
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

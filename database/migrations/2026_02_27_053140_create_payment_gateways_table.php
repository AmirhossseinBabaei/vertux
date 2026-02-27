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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('gateway_code', 50)->unique();
            $table->string('merchant_id');
            $table->string('terminal_id');
            $table->string('user_name');
            $table->string('password_encrypted');
            $table->string('payment_url', 500);
            $table->string('verify_url', 500);
            $table->string('call_back_url', 500);

            $table->text('api_key_encrypted');
            $table->text('description');

            $table->integer('priority')->default(0);

            $table->enum('status', ['active', 'inactive']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};

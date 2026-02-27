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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ai_service_id');
            $table->unsignedBigInteger('request_type_id');

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('ai_service_id')->references('id')->on('ai_services');
            $table->foreignId('request_type_id')->references('id')->on('request_types');

            $table->string('request_title');

            $table->text('request_body');
            $table->text('response_body');
            $table->text('response_tokens');

            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'await_payment'])->default('pending');

            $table->jsonb('meta_data');

            $table->bigInteger('cost_coin');

            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('failed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};

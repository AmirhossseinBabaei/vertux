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
        Schema::create('ai_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('provider_id');
            $table->foreignId('provider_id')->references('id')->on('users');

            $table->string('model_name');
            $table->string('display_name');

            $table->jsonb('abilities');

            $table->integer('max_token');
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
        Schema::dropIfExists('ai_services');
    }
};

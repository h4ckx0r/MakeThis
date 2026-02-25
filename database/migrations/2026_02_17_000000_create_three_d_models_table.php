<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('three_d_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombreModelo', 64);
            $table->string('tipo', 3);
            $table->string('modelo', 256);
            $table->foreignUuid('colorId')->constrained('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('three_d_models');
    }
};
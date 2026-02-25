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
        Schema::create('pieza_catalogos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 64);
            $table->foreignUuid('adjuntoId')->constrained('adjuntos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('colorId')->constrained('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieza_catalogos');
    }
};

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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('userId')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('estadoId')->constrained('estados')->onDelete('cascade');
            $table->text('detalles');
            $table->foreignUuid('3dModelId')->constrained('three_d_models')->onDelete('cascade');
            $table->tinyInteger('porcentajeRelleno');
            $table->float('alturaCapa')->default(0.2);
            $table->enum('patronRelleno', ['rejilla', 'giroide', 'cubico', 'panal_de_abeja', 'panal_de_abeja_3d']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};

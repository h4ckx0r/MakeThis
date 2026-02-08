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
        Schema::create('solicitudes_piezas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pieza_id')->nullable()->constrained();
            $table->enum('tipo', ['propia', 'personalizada']);
            $table->string('material');
            $table->string('color');
            $table->text('indicaciones')->nullable();
            $table->enum('estado', ['pendiente', 'en_proceso', 'completada', 'rechazada'])
                  ->default('pendiente');

            // Campos pieza propia
            $table->string('archivo_3d')->nullable();
            $table->boolean('config_recomendada')->default(false);
            $table->decimal('altura_capa', 8, 2)->nullable();
            $table->integer('porcentaje_relleno')->nullable();
            $table->string('patron_relleno')->nullable();

            // Campos pieza personalizada
            $table->json('imagenes')->nullable();
            $table->boolean('incluye_modelo_3d')->default(false);
            $table->boolean('incluye_pieza')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_piezas');
    }
};

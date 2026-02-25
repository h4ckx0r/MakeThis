<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->string('tipo', 20)->nullable()->after('detalles');
            $table->boolean('incluye_modelo_3d')->nullable()->after('tipo');
            $table->boolean('incluye_pieza')->nullable()->after('incluye_modelo_3d');
            $table->foreignUuid('piezaCatalogoId')
                  ->nullable()
                  ->after('incluye_pieza')
                  ->constrained('pieza_catalogos')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['piezaCatalogoId']);
            $table->dropColumn(['tipo', 'incluye_modelo_3d', 'incluye_pieza', 'piezaCatalogoId']);
        });
    }
};

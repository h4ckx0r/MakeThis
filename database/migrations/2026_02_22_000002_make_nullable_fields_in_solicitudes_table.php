<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hace nullable los campos 3dModelId y patronRelleno en solicitudes.
     * Permite solicitudes de tipo "personalizada" sin modelo 3D.
     */
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->uuid('3dModelId')->nullable()->change();
            $table->string('patronRelleno')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->uuid('3dModelId')->nullable(false)->change();
            $table->string('patronRelleno')->nullable(false)->change();
        });
    }
};

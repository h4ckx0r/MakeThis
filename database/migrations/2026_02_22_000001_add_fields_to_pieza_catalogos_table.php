<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pieza_catalogos', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('nombre');
            $table->boolean('visible_catalogo')->default(false)->after('descripcion');
        });
    }

    public function down(): void
    {
        Schema::table('pieza_catalogos', function (Blueprint $table) {
            $table->dropColumn(['descripcion', 'visible_catalogo']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pieza_catalogos', function (Blueprint $table) {
            $table->foreignUuid('adjuntoId')->nullable()->change();
            $table->foreignUuid('colorId')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pieza_catalogos', function (Blueprint $table) {
            $table->foreignUuid('adjuntoId')->nullable(false)->change();
            $table->foreignUuid('colorId')->nullable(false)->change();
        });
    }
};

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
        Schema::create('pieza_catalogo_tag', function (Blueprint $table) {
            $table->foreignUuid('id_PiezaCatalogo')->constrained('pieza_catalogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('id_tag')->constrained('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['id_PiezaCatalogo', 'id_tag']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieza_catalogo_tag');
    }
};

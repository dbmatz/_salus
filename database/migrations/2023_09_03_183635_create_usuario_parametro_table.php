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
        Schema::create('usuario_parametro', function (Blueprint $table) {
            $table->id();
            $table->foreignID('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreignID('parametro_id')->references('id')->on('parametros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_parametro');
    }
};

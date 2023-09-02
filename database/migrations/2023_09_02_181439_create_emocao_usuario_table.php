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
        Schema::create('emocao_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignID('emocao_id')->references('id')->on('emocao')->onDelete('cascade');
            $table->foreignID('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
            $table->date('data_cricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emocao_usuario');
    }
};

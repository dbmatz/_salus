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
        Schema::create('usuario_emocaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('emocao_id')->references('id')->on('emocaos')->onDelete('cascade');
            $table->string('descricao');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_emocao');
    }
};

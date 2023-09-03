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
        Schema::create('usuario_remedio_dia', function (Blueprint $table) {
            $table->id();
            $table->foreignID('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreignID('remedio_id')->references('id')->on('remedios')->onDelete('cascade');
            $table->date('dia');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_remedio_dia');
    }
};

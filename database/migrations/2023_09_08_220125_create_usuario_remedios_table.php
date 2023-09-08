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
        Schema::create('usuario_remedios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('remedio_id')->references('id')->on('remedios')->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->date('dia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_remedios');
    }
};

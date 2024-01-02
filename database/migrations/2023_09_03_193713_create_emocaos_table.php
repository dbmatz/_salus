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
        Schema::create('emocaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('imagem');
        });

        DB::table('emocaos')->insert([['id' => 1, 'nome' => 'Feliz', 'imagem' => '/feliz.png'],
        ['id' => 2, 'nome' => 'Triste', 'imagem' => '/triste.png'],
        ['id' => 3, 'nome' => 'Bravo', 'imagem' => '/bravo.png'],
        ['id' => 4, 'nome' => 'Neutro', 'imagem' => '/neutro.png'],
        ['id' => 5, 'nome' => 'Animado', 'imagem' => '/animado.png']]
    );
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emocaos');
    }
};

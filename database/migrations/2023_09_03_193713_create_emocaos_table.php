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

        DB::table('emocaos')->insert([['id' => 1, 'nome' => 'Feliz', 'imagem' => '/feliz.jpg'],
        ['id' => 2, 'nome' => 'Triste', 'imagem' => '/triste.jpg'],
        ['id' => 3, 'nome' => 'Surpreso', 'imagem' => '/surpreso.jpg'],
        ['id' => 4, 'nome' => 'Bravo', 'imagem' => '/bravo.jpg'],
        ['id' => 5, 'nome' => 'Neutro', 'imagem' => '/neutro.jpg'],
        ['id' => 6, 'nome' => 'Sonhador', 'imagem' => '/sonhador.jpg']]
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

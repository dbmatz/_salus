<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emocao_usuario;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'email',
        'data_nascimento',
        'data_cadastro',
        'foto',
    ];

    public function emocao_usuario()
    {
        return $this->HasMany(Emocao_usuario::class);
    }
}

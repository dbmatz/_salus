<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emocao;
use App\Models\Usuario;

class Emocao_usuario extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'emocao_id',
        'usuario_id',
        'descricao',
        'data_criacao',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    } 

    public function emocao(): BelongsTo
    {
        return $this->belongsTo(Emocao::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Usuario;
use App\Models\Usuario_emocao;

class Emocao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'imagem',
    ];

    public $timestamps = false;

    public function usuario_emocaos(): HasMany
    {
        return $this->hasMany(Usuario_emocao::class);
    }
}

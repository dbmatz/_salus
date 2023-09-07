<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Emocao;

class UsuarioEmocao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'emocao_id',
        'descricao',
    ];

    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function emocao(): BelongsTo
    {
        return $this->belongsTo(Emocao::class);
    }
}

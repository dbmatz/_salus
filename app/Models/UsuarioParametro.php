<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Parametro;

class UsuarioParametro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'parametro_id',
        'avaliacao',
        'dia',
    ];

    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parametro(): BelongsTo
    {
        return $this->belongsTo(Parametro::class)->withTrashed();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Remedio;

class UsuarioRemedio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'remedio_id',
        'status',
        'dia',
    ];

    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function remedio(): BelongsTo
    {
        return $this->belongsTo(Remedio::class)->withTrashed();
    }
}

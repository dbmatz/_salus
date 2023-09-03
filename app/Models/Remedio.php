<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Remedio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_usuario',
        'nome',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

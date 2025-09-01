<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    use HasFactory;

    protected $table = 'midias';

    protected $fillable = [
        'nome',
        'categoria',
        'descricao',
        'assistido',
        'baixado',
        'usuario_id'
    ];

    protected $casts = [
        'assistido' => 'boolean',
        'baixado' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
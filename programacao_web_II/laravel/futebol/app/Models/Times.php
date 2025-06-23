<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $fillable = [
        'nome',
        'sigla',
        'estado',
    ];

    public function jogadores()
    {
        return $this->hasMany(Jogadores::class);
    }
}

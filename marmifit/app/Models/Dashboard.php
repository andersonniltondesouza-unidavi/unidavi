<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'marmitas';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'tamanho',
    ];
}

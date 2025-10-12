<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marmitas extends Model
{
    protected $table = 'marmitas';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'tamanho',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogadores extends Model
{
    protected $fillable = ['id', 'nome', 'data_nascimento', 'posicao', 'time_id'];

    public function time()
{
    return $this->belongsTo(Times::class);
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calcularConsumo extends Model
{
    public function calcularConsumo($distancia, $valor, $consumo_litro) {
        $consumo = ($distancia * $valor) / $consumo_litro;
        return number_format($consumo,2);
    }
}
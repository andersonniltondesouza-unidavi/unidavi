<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class avaliarSono extends Model
{

    public function calcularIdade($dataNascimento)
    {
       $dataNascimento = new  DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $dataNascimento->diff($hoje);
        return $idade->y;
    }

    public function getAvaliarSono($horas, $idade)
    {
        if (($horas == 0) || ($idade == 0)) {
            throw new \Exception('Hora ou idade não pode ser zero ou nula');
        }   
        else {

        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class calcularImc extends Model
{
    public function calcularIdade($dataNascimento)
    {
       $dataNascimento = new  DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $dataNascimento->diff($hoje);
        return $idade->y;
    }

    public function getCalcularImc($peso, $altura)
    {
        if ($altura == 0 || $altura == null) {
            throw new \Exception('Altura não pode ser zero ou nula');
        }   
        else {
            $imc = $peso / ($altura * $altura);
            return number_format($imc, 2);
        }
    }

    public function getClassificacao($imc)
    {
        if ($imc < 18.5) {
            $classificacao = "Abaixo do peso";
            return $classificacao;
        } elseif ($imc < 25) {
            $classificacao = "Peso normal";
            return $classificacao;
        } elseif ($imc < 30) {
            $classificacao = "Acima do peso (sobrepeso)";
            return $classificacao;
        } elseif ($imc < 35) {
            $classificacao = "Obesidade I";
            return $classificacao;
        } elseif ($imc < 40) {
            $classificacao = "Obesidade II";
            return $classificacao;
        } else {
            $classificacao = "Obesidade III";
            return $classificacao;
        }
    }


}

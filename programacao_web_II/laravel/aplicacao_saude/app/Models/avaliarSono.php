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
        $idade = $hoje->diff($dataNascimento);
            if ($idade->y == 0) {
                return "$idade->m  meses";
            }
            else {
                return "$idade->y anos";
            }
    }

    public function getClassificacao($idade) {   
        if ($idade == null) {
            throw new \Exception('Idade não pode ser zero ou nula');
        }   
        else {
            if ($idade->y == 0 && $idade->m <= 3) {
                $classificacao = 'Recém-nascido';
                return $classificacao;
            } 
            elseif ($idade->y == 0 && $idade->m > 3) {
                $classificacao = 'Bebê';
                return $classificacao;
            } 
            elseif ($idade->y <= 2) {
                $classificacao = 'Primeira infância';
                return $classificacao;
            } 
            elseif ($idade->y >= 3 && $idade->y <= 5) {
                $classificacao = 'Pré-escolar';
                return $classificacao;
            } 
            elseif ($idade->y > 5 && $idade->y <= 13) {
                $classificacao = 'Escolar';
                return $classificacao;
            }    
            elseif ($idade->y > 13 && $idade->y <= 17) {
                $classificacao = 'Adolescente';
                return $classificacao;
            } 
            elseif ($idade->y > 17 && $idade->y <= 25) {
                $classificacao = 'Jovem Adulto';
                return $classificacao;
            } 
            elseif ($idade->y > 25 && $idade->y <= 64) {
                $classificacao = 'Adulto';
                return $classificacao;
            } 
            else {
                $classificacao = 'Idoso';   
                return $classificacao;
            }
        }
    }

    public function getQualidadeSono ($classificacao, $horas) {
        if ($classificacao == 'Recém-nascido') {
            if ($horas >= 14 && $horas <= 17) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 14) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
    }
}
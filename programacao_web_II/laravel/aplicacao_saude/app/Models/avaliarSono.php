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
        $intervalo = $hoje->diff($dataNascimento);
    
        $idade = [
            'anos' => $intervalo->y,
            'meses' => $intervalo->m
        ];
        return $idade;
    }

    public function mostrarIdade ($dataNascimento) {
        $idade= $this->calcularIdade($dataNascimento);
        if ($idade['anos'] == 0) {
            return $idade['meses'] . ' meses';
        }
        else {
            return $idade['anos'] . ' anos ';
        }
    }

    public function getClassificacao($idade) {   
        if ($idade == null) {
            throw new \Exception('Idade não pode ser zero ou nula');
        }   
        else {
            if ($idade['anos'] == 0 && $idade['meses'] <= 3) {
                $classificacao = 'Recém-nascido';
                return $classificacao;
            } 
            elseif ($idade['anos'] == 0 && $idade['meses'] > 3 && $idade['meses'] <= 11) {
                $classificacao = 'Bebê';
                return $classificacao;
            } 
            elseif ($idade['anos'] <= 2) {
                $classificacao = 'Primeira infância';
                return $classificacao;
            } 
            elseif ($idade['anos'] >= 3 && $idade['anos'] <= 5) {
                $classificacao = 'Pré-escolar';
                return $classificacao;
            } 
            elseif ($idade['anos'] > 5 && $idade['anos'] <= 13) {
                $classificacao = 'Escolar';
                return $classificacao;
            }    
            elseif ($idade['anos'] > 13 && $idade['anos'] <= 17) {
                $classificacao = 'Adolescente';
                return $classificacao;
            } 
            elseif ($idade['anos'] > 17 && $idade['anos'] <= 25) {
                $classificacao = 'Jovem Adulto';
                return $classificacao;
            } 
            elseif ($idade['anos'] > 25 && $idade['anos'] <= 64) {
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
        if ($classificacao == 'Bebê') {
            if ($horas >= 12 && $horas <= 15) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 12) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Primeira infância') {
            if ($horas >= 11 && $horas <= 14) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 11) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Pré-escolar') {
            if ($horas >= 10 && $horas <= 13) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 10) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Escolar') {
            if ($horas >= 9 && $horas <= 11) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 9) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Adolescente') {
            if ($horas >= 8 && $horas <= 10) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 8) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Jovem Adulto') {
            if ($horas >= 7 && $horas <= 9) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 7) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Adulto') {
            if ($horas >= 7 && $horas <= 9) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 7) {
                $qualidadeSono = 'Dormindo pouco';
                return $qualidadeSono;
            } 
            else {
                $qualidadeSono = 'Dormindo muito';
                return $qualidadeSono;
            }
        }
        if ($classificacao == 'Idoso') {
            if ($horas >= 7 && $horas <= 8) {
                $qualidadeSono = 'Dormindo bem';
                return $qualidadeSono;
            } 
            elseif ($horas < 7) {
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
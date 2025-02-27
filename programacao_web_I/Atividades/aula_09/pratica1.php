<?php
define("notas",array(8,9,5,7));
define("frequencia", array(0,0,1,0,1,0,0,0,1,1));

function calcularMedia() {
    $somaNotas = 0;
    for($i = 0; $i< count(notas); $i++) {
        $somaNotas += notas[$i];
    }
 return $somaNotas / count(notas);   
}

function statusNotas() {
    if(calcularMedia() >= 7) {
        return "Aprovado";
    }
    return"Reprovado";
};

function calculaFrequencia() {
    $somaFaltas = 0;
    for($i = 0; $i< count(frequencia); $i++) {
        $somaFaltas += frequencia[$i];
    }
    $frequencia = 100 - (($somaFaltas * 100 / $i));
    return $frequencia;
};

function statusFrequencia(){
    if(calculaFrequencia() >= 70) {
        return "Aprovado";
    };
    return "Reprovado";
};

function exibeMensagem($mensagem){
    echo $mensagem;
}

exibeMensagem("Média Notas: " . calcularMedia() . "<br>" . 
              "Status notas: " . statusNotas() . "<br>" .
              "Frequencia: " . calculaFrequencia() . "<br>" .
              "Status Frequencia: " . statusFrequencia() )
?>
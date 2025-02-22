<?php

require_once("funcoes.php");

define("notas", array(8, 3, 5, 7));
define("frequencia", array(0,0,1,0,1,0,0,0,1,1));

$mediaNotas = calculaMediaNotas();
$statusNotas = statusNota();
$frequencia = calculaFrequencia();
$statusFrequencia = statusFrequencia();

exibeMensagem("Média Notas: " . $mediaNotas . "<br>" . 
              "Status Notas: " . $statusNotas . "<br>" .
              "Frequencia: " . $frequencia . "<br>" .
              "Status Frequencia: " . $statusFrequencia);
?>
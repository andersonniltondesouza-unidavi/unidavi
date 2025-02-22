<?php
$salarioBruto = 0;

$impostos = 0;

$liquido = 0;

function calculaFolhaPagto(&$bruto, &$imposto, &$liquido) {

$bruto = 10000;
$imposto = 1000;
$liquido = $bruto - $imposto;

}

calculaFolhaPagto($salarioBruto, $impostos, $liquido);

echo "Bruto: " . $salarioBruto . "Imposto: " . $impostos .

"Líquido: " . $liquido;
?>
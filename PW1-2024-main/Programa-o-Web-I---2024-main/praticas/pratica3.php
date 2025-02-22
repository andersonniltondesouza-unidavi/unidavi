<?php

$salario1= 1000;
$salario2= 2000;

$salario2=$salario1;

++$salario2;

$salario1*=1.1;

echo("Valor Salário 1: $salario1 e Valor Salário 2: $salario2");
    
if ($salario1 > $salario2) {
    echo("Valor da variável 1 é maior que o valor da variável 2");
}
else if ($salario2 > $salario1) {
    echo("Valor da variável 2 é maior que o valor da variável 1");
}
else {
    echo("Os valores são iguais");
}
?>
<?php
    $salario1 = 1000;
    $salario2 = 1050;

    for ($x = 0; $x < 100; $x++){
        if ($x==50){
            break;
        }
        ++$salario1;
        echo "Valor $salario1 <br>";

    }

    if ($salario1 < $salario2){
        echo "Salario 1 é menor: $salario1";
    }
    else{
        echo "Salario 1 é maior: $salario1";
    }
?>
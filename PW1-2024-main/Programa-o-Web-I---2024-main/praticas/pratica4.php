<?php

$salario1= 1000;
$salario2= 2000;

++$salario2;

for ($x = 0; $x <= 100; $x++) {
    $salario1=$salario1+1;
    echo "The number is: $salario1 <br>";
    
    if ($x === 49) {
        break;
    }   
}

if ($salario1 < $salario2) {
    echo ("$salario1");
}

?>
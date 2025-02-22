<?php

    require_once"calculadora.php";

    $calculadora = new Calculadora();

    $calculadora->setOperador1(10);
    $calculadora->setOperador2(10);
    $calculadora->soma();

    echo  $calculadora->escreveResultado();
?>
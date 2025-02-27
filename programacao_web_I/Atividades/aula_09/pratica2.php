<?php
$pastas = array(
    "BSN" => array(
        "3a Fase" => array(
            "Estrutura_Dados I",
            "banco_Dados I",
            "Engenharia_Software I",
        ),
        "4a Fase" => array(
            "Programação_Web I",
            "Banco_Dados II",
            "Engenharia_Software II"
        )
    )
);

function exibirArvore($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {
        echo str_repeat("-", $nivel * 2) . " ";

        if (is_array($valor)) {
            echo $chave . "<br>";
            exibirArvore($valor, $nivel + 1);
        } else {
            echo $valor . "<br>";
        }
    }
}

exibirArvore($pastas);
?>
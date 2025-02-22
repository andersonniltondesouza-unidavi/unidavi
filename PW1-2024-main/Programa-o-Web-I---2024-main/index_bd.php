<?php

    require_once "lib/conexaobd.php";
    require_once "lib/query.php";
    $conexaobd = new conexaobd();
    $conexaobd->setHost("127.0.0.1");
    $conexaobd->setPort(5432);
    $conexaobd->setUserName("postgres");
    $conexaobd->setPassword("postgres");
    $conexao->setDatabase("Postgres");
    if (!$conexaobd->conectar()) {
        echo "Falha na conexão";
    }
    else {
        echo "Conectado com sucesso!";
    }

    $query = new Query($conexaobd);
    $query->setSql("SELECT 1 AS COLUNA");
    if ($query->Open) {
        while ($linha = $query->getNextRow()){
            var_dump($linha);
        }
    }
?>
<?php
    require_once "time.php";
    require_once "jogador.php";
    $time = new Time();
    $time->setAnoFundacao(2024);
    $time->setNome("UNIDAVI FC");
    
    for ($i=0; $i < 11; $i++) {
        $jogador = new Jogador ();
        $jogador->setNome("Jogador ". $i);
        $jogador->setPosicao("P");
        $jogador->setDataNascimento(new DateTime("2000-05-31"));

        $time->addJogador($Jogador);
    }

    var_dump($time->getJogadores());
?>
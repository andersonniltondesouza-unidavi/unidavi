<?php

    class Time {
        private $Nome;
        private $anoFundacao;
        private $Jogadores;
        
        public function __construct() {
            $this->jogadores = array();
        }
        public function setNome ($Nome) {
            $this->nome = $Nome;
        }
        public function setAnoFundacao ($anoFundacao) {
            $this->anoFundacao = $anoFundacao;
        }
        public function addJogador ($Jogador) {
            array_pop($this->jogador    $Jogadores);
        }
        public function getJogadores() {
            return $this->jogadores;
        }
    }
?> 
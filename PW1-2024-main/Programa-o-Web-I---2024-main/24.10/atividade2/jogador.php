<?php

    class jogador {
        private $Nome;
        private $posicao;
        private $dataNascimento;
  
        public function setNome ($nome) {
            $this->nome = $nome;
        }
        public function setPosicao ($posicao) {
            $this->posicao = $posicao;
        }
        public function setDataNascimento ($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }
    }

?>
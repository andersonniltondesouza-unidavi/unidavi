<?php
    namespace app\model;

    class Pessoa {
        private $nome;
        private $sobreNome;
        private $dataNascimento;
        private $cpfCnpj;
        private $tipo;
        private $telefone;
        private $endereco;

        public function __construct() {
            $this->telefone = new contato();
            $this->endereco = new endereco();
        }

        public function __toString()
        {
            return 
            "Nome Completo: " . $this->getNomeCompleto() . 
            "Idade: " . $this->getIdade() .
            "Endereço: " . $this->getEndereco()->getLogradouro(); 

        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setSobreNome($sobreNome) {
            $this->sobreNome = $sobreNome;
        }
        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }
        public function setCpfCnpj($cpfCnpj) {
            $this->cpfCnpj = $cpfCnpj;
        }
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }
        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }
        public function getNomeCompleto() {
            return $this->nome . " " . $this->sobreNome;
        }
        public function getIdade() {
            if(isset($this->dataNascimento)) {
                /*
                  OBS: O \DateTime é necessário por conta do uso de NAMESPACE no arquivo.
                */
                $idade = $this->dataNascimento->diff( new \DateTime( date('Y-m-d') ) );
                return $idade->y; 
            }
        }

        public function getTelefone() {
            return $this->telefone;
        }
        public function getEndereco() {
            return $this->endereco;
        }
    }

?>
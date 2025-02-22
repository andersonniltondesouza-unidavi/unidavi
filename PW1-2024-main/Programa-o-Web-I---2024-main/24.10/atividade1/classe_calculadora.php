<?php

    class Calculadora {
        private $operador1;
        private $operador2;
        private $valorMemoria;
        private $operando;
        
        public function setOperador1($valor) {
            $this->Operador1 = $valor;
        }
        public function setOperador2($valor) {
            $this->Operador2= $valor;
        }

        public function setOperando($operando) {
            $this->operando = $operando;
        } 
        
        public function soma() {
            return $this->valorMemoria = $this->Operador1 + $this->Operador2;
        }
        public function escreveResultado() {
            return "Resultado = ". $this->valorMemoria;
        }


    }

?>
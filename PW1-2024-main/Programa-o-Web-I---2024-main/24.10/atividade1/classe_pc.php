<?php

    class computador{
        private $estado;

        public function ligar(){
            $this->estado = "Ligado";
            return $this->getstatus();
        }
        public function desligar(){
            $this->estado = "Desligado";  
            return $this->getstatus();  
        }
        public function getstatus(){
            return "Resultado = ". $this->estado;
        }
    }

?>
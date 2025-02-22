<?php

    class conexaobd {
        private $host;
        private $port;
        private $username;
        private $password;
        private $database;
        public function setHost ($host) {
            $this->host= $host;
        }
        public function setPort ($port) {
            $this->port=$port;
        }
        public function setUsername ($username) {
            $this->username = $username;
        }
        public function setPassword ($password) {
            $this->password=$password;
        }
        public function setDatabase ($database) {
            $this->database=$database;
        }
        public function conectar () {
            try {
                $this->dbconn = pg_connect($this->getConnection);
                if ($this->dbconn) {
                    return true;
                }
            }   catch (Exception $e) {
                //$this->setStatus ('Erro: ' .$e->getMessage)
            }
        }
       private function getConnectionString() {
            return "host=".$this->host.
                    "port="$this->port.
                    "username="$this->username.
                    "password="$this->password.
                    "database="$this->database
       }
       public function getInternalConnection() {
        return $this->dbconn;
       }
        
    }
    

?>
<?php

    class Query {
        private $sql;
        private $registros;
        private $connection;
        private $lastQuery;
        public function __construct($connection) {
            $this->connection=$connection;
        }
        public function setSql($sql) {
            $this->sql=$sql;
        }
        public function getRegistros () {
            return $this->registros;
        }
        public function Open() {
           $this>lastQuery = pg_query($this->connection->getInternalConnection(), $this->sql);
           if ($this->lastQuery) {
            // Retorna a quantidade de linhas da query
            $this->registros = pg_num_rows($this->lastQuery);
            return true;
           }
           return false;
        }
        public function getNextRow() {
            $row = pg_fetch_assoc($this->lastQuery);
            if ($row) {
                return $row;
            }
            return false;
        }
    }

?>
<?php
    require_once 'Connection.php';
    
    class connectionMethods {
        protected $connection;

        public function startConnection(){
            $this->connection = Connection::startConnection();
        }

        public function endConnection(){
            $this->connection = Connection::endConnection();
        }
    }
?>
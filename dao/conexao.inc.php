<?php
    class Conexao
    {
        private $servidor_mysql = 'localhost';
        private $nome_banco = 'lojat3ek';
        private $usuario = 'root';
        private $senha = ''; 
        private $con;

        public function getConexao()
        {
                $this->con = new PDO("mysql:host=$this->servidor_mysql;dbname=$this->nome_banco","$this->usuario","$this->senha");
                return $this->con;
        }
    }
?>
<?php

class Conexao {
    static private $instance = null;
    private $conn;

    private function __construct(){
        $servidor_mysql = 'localhost';
        $usuario = 'root';
        $senha = '';
        $nome_banco = 'lojat3ek';
        $this->conn = new PDO("mysql:host=$servidor_mysql;dbname=$nome_banco", "$usuario", "$senha");
    }

    static public function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Conexao();
        }
        return self::$instance->conn;
    }
}
?>
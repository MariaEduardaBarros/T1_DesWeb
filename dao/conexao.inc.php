<?php
    $servidor_mysql = 'localhost';
    $usuario = 'root';
    $senha = '';
    $nome_banco = 'lojat3ek';

    $conn = new PDO("mysql:host=$servidor_mysql;dbname=$nome_banco", "$usuario", "$senha");

?>
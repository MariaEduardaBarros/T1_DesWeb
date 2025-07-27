<?php
require_once '../dao/conexao.inc.php';

if(isset($_POST)){
    $acao = $_POST['acao'] ?? '';
    
    if($acao == 'cadastrar'){

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $tipo_servico = $_POST['tipo_servico'];
        $sql = $conn->prepare("INSERT INTO servicos (nome, valor, descricao, id_tipo) VALUES (:nome, :valor, :descricao, :tipo_servico)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':tipo_servico', $tipo_servico);
        if($sql->execute()){
            header('Location: ../views/servicos.php?msg=1');
        } else {
            header('Location: ../views/servicos.php?msg=2');
        }
    }
    if($acao == 'deletar'){
        $id_servico = $_POST['id_servico'];
        $sql = $conn->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        if($sql->execute()){
            header('Location: ../views/servicos.php?msg=3');
        } else {
            header('Location: ../views/servicos.php?msg=4');
        }
    }
}

$sql = $conn->prepare("SELECT * FROM servicos");
$sql->execute();
$servicos = $sql->fetchAll(PDO::FETCH_ASSOC);




?>
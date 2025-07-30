<?php
    require_once "../dao/ClienteDao.inc.php";

    $opcao = $_REQUEST['pOpcao'];

    if($opcao == 1){
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];

        $dao = new ClienteDao();
        $cliente = $dao->autenticar($email, $senha);

        if($cliente != NULL){
            session_start();
            $_SESSION['cliente'] = $cliente;
            header("Location: controllerServico.php?acao=exibir");
        }
        else{ 
            header("Location: ../views/login.php?erro=1");
        }
    } 
?>
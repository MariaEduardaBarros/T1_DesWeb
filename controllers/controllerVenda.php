<?php
include_once "../dao/VendaDao.inc.php";

$opcao = (int)$_REQUEST['opcao'];

if($opcao == 1){ //incluir venda
    session_start();
    $carrinho = $_SESSION['carrinho'];
    $usuario = $_SESSION['usuario'];
    $total = $_SESSION['total'];

    $boleto = $_REQUEST['pag'];

    $venda = new Venda($usuario->CodCli, $total);
    $dao = new VendaDao();
    $dao->incluirVenda($venda, $carrinho);

    if($boleto == 'bb') {
        header("Location: ../views/boleto/meuBoletoBB.php");
    } else if ($boleto == 'caixa') {
        header("Location: ../views/boleto/meuBoletoCaixa.php");
    } else if ($boleto == 'itau') {
        header("Location: ../views/boleto/meuBoletoItau.php");
    } else if ($boleto == 'santander') {
        header("Location: ../views/boleto/meuBoletoSantander.php");
    }
}
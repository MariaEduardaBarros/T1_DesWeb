<?php
include_once "../classes/ItemCarrinho.inc.php";
include_once "../dao/ServicoDao.inc.php";
include_once "../dao/VendaDao.inc.php";

$opcao = (int)$_REQUEST['opcao'];

if($opcao == 1){ //incluir venda
    session_start();
    $carrinho = $_SESSION['carrinho'];
    $usuario = $_SESSION['usuario'];
    $total = $_SESSION['total'];
    $itensCarrinho = $_SESSION['itensCarrinho'];

    $boleto = $_REQUEST['pag'];

    $venda = new Venda($usuario->CodCli, $total);
    $dao = new VendaDao();
    $dao->incluirVenda($venda, $carrinho);

    if($itensCarrinho != null){
        $servicoDao = new ServicoDao();

        foreach($itensCarrinho as $item){
            $data = $item->getData();
            $servicoDao->editarDatasDisponiveis($item->getServico()->getId(), $data);
        }
    }

    unset($_SESSION['carrinho']);
    unset($_SESSION['itensCarrinho']);

    if($boleto == 'bb') {
        header("Location: ../views/pedidoConcluido.php?boleto=bb");
    } else if ($boleto == 'caixa') {
        header("Location: ../views/pedidoConcluido.php?boleto=caixa");
    } else if ($boleto == 'itau') {
        header("Location: ../views/pedidoConcluido.php?boleto=itau");
    } else if ($boleto == 'santander') {
        header("Location: ../views/pedidoConcluido.php?boleto=santander");
    }

}
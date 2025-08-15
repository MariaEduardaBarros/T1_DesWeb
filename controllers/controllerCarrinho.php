<?php
require_once "../classes/servico.inc.php";
require_once "../dao/servicoDao.inc.php";

$opcao = (int) $_REQUEST['opcao'];

if($opcao == 1) { // Adicionar ao carrinho
    $id = $_REQUEST['id'];
    $servicoDao = new ServicoDao();
    $servico = $servicoDao->buscarServicoPorId($id);   

    session_start();
    if(isset($_SESSION['carrinho'])) {
        $carrinho = $_SESSION['carrinho'];
    } else {
        $carrinho = array();
    }

    // Verifica se o carrinho já atingiu o limite
    if(count($carrinho) >= 5) {
        header("Location: ../views/servicosVenda.php?erro=1"); // Limite de 5 serviços no carrinho
    }

    // Verifica se o serviço já está no carrinho
    /*$idsCarrinho = array_map(fn($item) => $item->getServico()->getId(), $carrinho);
    if(in_array($id, $idsCarrinho)) {
        header("Location: ../views/servicosVenda.php?erro=2"); // Serviço já está no carrinho
    }*/

    // Adiciona o serviço ao carrinho
    $carrinho[] = $servico;
    $_SESSION['carrinho'] = $carrinho;

    header("Location: ../views/carrinho.php"); // Mensagem: serviço adicionado
}


if ($opcao == 2) { // Adicionar ao carrinho
    $idServico = $_GET['id'] ?? null;

    if ($idServico) {
        // Inicializa o carrinho na sessão se não existir
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adiciona o serviço ao carrinho (você pode controlar quantidade se quiser)
        if (!in_array($idServico, $_SESSION['carrinho'])) {
            $_SESSION['carrinho'][] = $idServico;
        }

        // Redireciona de volta para a página de serviços com o ID do item adicionado
        header("Location: ../views/servicosVenda.php?id=$idServico&from=servicosVenda");
        exit;
    }
}

// Aqui você pode tratar outras opções do controller

<?php
require_once "../classes/servico.inc.php";
require_once "../dao/servicoDao.inc.php";

$opcao = (int) ($_REQUEST['opcao']);

function array_search2($chave, $vetor){
    $index = -1;

    for($i = 0; $i<count($vetor);$i++){
        if($chave == $vetor[$i]->getId()){
            $index = $i;
            break;
        }
    }
    return $index;
}

if($opcao == 1){ //Adiciona serviço ao carrinho
        $id = (int)$_REQUEST['id'] ?? null;
        $servicoDao = new ServicoDao();
        $servico = $servicoDao->buscarServicoPorId($id);

        session_start();
        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];
        }
        else{
            $carrinho = array();
        }
        
        $key = array_search2($servico->getId(), $carrinho);
        if($key != -1){
            header("Location: ../views/carrinho.php?erro=O serviço já está no carrinho.");
            exit;
        }
        else if(count($carrinho) >= 5){
            header("Location: ../views/carrinho.php?erro=O carrinho já está cheio! Finalize o pedido ou esvazie o carrinho antes de adicionar mais serviços.");
            exit;
        }
        else{
            $carrinho[] = $servico;
        }

        $_SESSION['carrinho'] = $carrinho;

        header("Location: ../views/carrinho.php");
}
else if($opcao == 2){ //Remove serviço do carrinho
    $index = (int)$_REQUEST['index']; 
    
    session_start();
    $carrinho = $_SESSION['carrinho'];
    unset($carrinho[$index]);
    sort($carrinho);

    $_SESSION['carrinho'] = $carrinho;
    if(empty($carrinho)){
        header("Location: controllerCarrinho.php?opcao=4");
        exit;
    }
    header("Location: ../views/carrinho.php?msg=Serviço removido do carrinho com sucesso");
}
else if($opcao == 3){ //Esvazia o carrinho
    session_start();
    unset($_SESSION['carrinho']);
    header("Location: ../views/carrinho.php?status=1");
}
else if($opcao == 4){ //Verifica se o carrinho está vazio
    if((!isset($_SESSION['carrinho']) || sizeof($_SESSION['carrinho'])==0)){
        header("Location: ../views/carrinho.php?status=1");
    }
    else{
        header("Location: ../views/carrinho.php");
    }
}
else if($opcao == 5){ //Finalizar o pedido
    session_start();

    $_SESSION['total'] = (float)$_REQUEST['total'];
    $_SESSION['data'] = $_REQUEST['data_servico'];

    if(isset($_SESSION['usuario'])){
        header("Location: ../views/dadosCompra.php");
    }else{
        header("Location: ../views/login.php?status=1");
    }
}
else if($opcao == 6){ //Listar serviços no carrinho
    session_start();
    if(!isset($_SESSION['carrinho'])){
        header("Location: controllerCarrinho.php?opcao=4");
        exit;
    }
    $carrinho = $_SESSION['carrinho'];
    header("Location: ../views/carrinho.php");
}
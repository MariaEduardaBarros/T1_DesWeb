<?php
require_once '../dao/ServicoDao.inc.php';
require_once '../classes/servico.inc.php';


if(isset($_REQUEST['opcao'])) {
    
    $opcao = $_REQUEST['opcao'];
    $id_servico = $_REQUEST['id'];


    if($opcao == "1"){
        $servicoDao = new ServicoDao();
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $tipo_servico = $_POST['tipo_servico'];

        if(!empty($nome) && !empty($valor) && !empty($descricao) && !empty($tipo_servico)){
            
            $servico = new Servico();
            $servico->setServico($nome, $descricao, $valor, $tipo_servico);

            if($servicoDao->inserirServico($servico)){
                header('Location: controllerServico.php?opcao=3&msg="Sucesso ao deletar o serviço"');
            } else {
                header('Location: ../views/servicos.php?opcao=3&erro="Erro ao deletar o serviço"');
            }
        }
        else {
            header('Location: ../views/servicos.php?msg=3');
        }
    }
    
    else if ($opcao == "2"){
        $servicoDao = new ServicoDao();
        if(!empty($id_servico)){
            if($servicoDao->deletarServico($id_servico)){
                header('Location: controllerServico.php?opcao=3&msg="Sucesso ao deletar o serviço"');
            } else {
                header('Location: ../views/servicos.php?opcao=3&erro="Erro ao deletar o serviço"');
            }
        }
    }

    else if ($opcao == "3"){
        session_start();
        $servicoDao = new ServicoDao();
        $servicos = $servicoDao->listarServicos();
        $_SESSION['servicos'] = $servicos;
        
        if($_REQUEST['msg']){
            $msg = $_REQUEST['msg'];
            header('Location: ../views/servicos.php?msg=".$msg."');
        } 
        else if($_REQUEST['erro']){
            $erro = $_REQUEST['erro'];
            header('Location: ../views/servicos.php?erro=".$erro."');
        }
        header('Location: ../views/servicos.php');
    }

    else if ($opcao == "4"){
        $servicoDao = new ServicoDao();
        if(!empty($id_servico)){
            $servico = $servicoDao->buscarServicoPorId($id_servico);
            if($servico){
                $nome = $_POST['nome'];
                $valor = $_POST['valor'];
                $descricao = $_POST['descricao'];
                $tipo_servico = $_POST['tipo_servico'];

                $servico->setServico($nome, $descricao, $valor, $tipo_servico);
                $servico->setId($id_servico);

                if ($servicoDao->atualizarServico($servico)){
                    header('Location: controllerServico.php?opcao=3&msg="Sucesso ao atualizar o serviço"');
                }
                else {
                    header('Location: ../views/servicos.php?opcao=3&erro="Erro ao atualizar o serviço"');
                }
            
            } else {
                header('Location: ../views/servicos.php?erro="Serviço não encontrado"');
            }
        }
    }
    
    /*else if ($opcao == "adicionarDatas"){
        if(!empty($id_servico)){
            $i = 0;
            $data = [];
            while($i < 7) {
                if(empty($_POST['data_' . ($i + 1)])) {
                    $i++;
                }
                else{
                    $data[] = $_POST['data_' . ($i + 1)];
                    $i++;
                }
            }
            if(!empty($data)){
                $servico = $servicoDao->buscarServicoPorId($id_servico);
                $servico = new Servico();
                $servico->setId($id_servico);
                $servico->setServico($servico->getNome(), $servico->getDescricao(), $servico->getValor(), $servico->getTipoServico());
                if($servicoDao->inserirDatas($id_servico, $data)){
                    header('Location: ../views/servicos.php?msg="Data adicionada com sucesso"');
                } else {
                    header('Location: ../views/servicos.php?erro="Erro ao adicionar data"');
                }
            } else {
                header('Location: ../views/servicos.php?msg=3');
            }
        }
    }*/
}


?>
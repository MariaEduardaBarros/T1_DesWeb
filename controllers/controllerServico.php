<?php
require_once '../dao/ServicoDao.inc.php';
require_once '../classes/servico.inc.php';


if(isset($_REQUEST['opcao'])) { // verifica se a opção foi passada
    
    $opcao = $_REQUEST['opcao'];
    $id_servico = $_REQUEST['id'] ?? null;



    if($opcao == "1"){ // opção para inserir um novo serviço
        $servicoDao = new ServicoDao();
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $tipo_servico = $_POST['tipo_servico'];

        if(!empty($nome) && !empty($valor) && !empty($descricao) && !empty($tipo_servico)){
            
            $servico = new Servico();
            $servico->setServico($nome, $descricao, $valor, $tipo_servico);

            if($servicoDao->inserirServico($servico)){
                header('Location: controllerServico.php?opcao=3&msg=Sucesso ao incluir o serviço');
            } else {
                header('Location: ../views/servicos.php?opcao=3&erro=Erro ao incluir o serviço');
            }
        }
        else {
            header('Location: ../views/servicos.php?msg=3');
        }
    }
    
    else if ($opcao == "2"){ // opção para deletar um serviço
        $servicoDao = new ServicoDao();
        if(!empty($id_servico)){
            if($servicoDao->deletarServico($id_servico)){
                header('Location: controllerServico.php?opcao=3&msg=Sucesso ao deletar o servico');
            } else {
                header('Location: controllerServico.php?opcao=3&erro=Erro ao deletar o servico');
            }
        }
    }

    else if ($opcao == "3"){ // opção para listar os serviços
        session_start();
        $servicoDao = new ServicoDao();
        $servicos = $servicoDao->listarServicos(); 

        $_SESSION['servicos'] = $servicos;

        if($_REQUEST['msg'] ?? null){
            $msg = $_REQUEST['msg'];
            header('Location: ../views/servicos.php?msg='.$msg);
        } 
        else if($_REQUEST['erro'] ?? null){
            $erro = $_REQUEST['erro'];
            header('Location: ../views/servicos.php?erro='.$erro);
        }

        else {
            
            
            header('Location: ../views/servicos.php');
        }
    }

    else if ($opcao == "4"){ // opção para atualizar um serviço
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
                    header('Location: controllerServico.php?opcao=3&msg=Sucesso ao atualizar o serviço');
                }
                else {
                    header('Location: ../views/servicos.php?opcao=3&erro=Erro ao atualizar o serviço');
                }
            
            } else {
                header('Location: ../views/servicos.php?erro=Serviço não encontrado');
            }
        }
    }
    
    else if ($opcao == "5"){ // opção para inserir datas disponiveis para um serviço
        $servicoDao = new ServicoDao();
        if(!empty($id_servico)){
            $i = 0;
            $data = array();
            while($i < 7) { //pego datas de 1 a 7
                if(empty($_POST['data_' . ($i + 1)])) { // se a data não foi preenchida, não adiciono ao array
                    $i++;
                }
                else{
                    $data[] = $_POST['data_' . ($i + 1)]; // adiciono a data ao array
                    $i++;
                }
            }
            if(!empty($data)){ // se o array de datas não estiver vazio
                $servico = $servicoDao->buscarServicoPorId($id_servico);
                $servico->setId($id_servico);
                if($servicoDao->inserirDatas($servico, $data)){
                    header('Location: controllerServico.php?opcao=3&msg=Sucesso ao adicionar data');
                } else {
                    header('Location: controllerServico.php?opcao=3&msg=Erro ao adicionar data');
                }
            }
        }
    }
}


?>
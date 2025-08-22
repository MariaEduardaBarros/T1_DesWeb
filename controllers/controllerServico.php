<?php
require_once '../classes/tipoServico.inc.php';
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
            if(!is_numeric($valor)){
                header('Location: ../views/servicos.php?erro=Valor inválido, use apenas números.');
                exit;
            }

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

    else if ($opcao == "3" || $opcao == "6"){ // opção para listar os serviços
        session_start();
        $servicoDao = new ServicoDao();
        $servicos = $servicoDao->listarServicos(); 
        $tipos_servico = $servicoDao->listarTiposServico(); // busca os tipos de serviço
        $_SESSION['tipos_servico'] = $tipos_servico;

        $_SESSION['servicos'] = $servicos;
        if($opcao == "3"){
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
        } else if ($opcao == "6") {
            foreach($servicos as $servico){
                if(!$servicoDao->verificarDisponibilidadeServico($servico->getId())){
                    $servico->setDisponivel(false); 
                } else {
                    $servico->setDisponivel(true);
                }
            }
            header('Location: ../views/servicosVenda.php');
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
            $hoje = new DateTime();

            while($i < 7) { //pego datas de 1 a 7
                $dataInput = $_POST['data_' . ($i + 1)];
                if(!empty($dataInput)) {
                    $dataObj = DateTime::createFromFormat('Y-m-d', $dataInput);

                    if($dataObj && $dataObj >= $hoje){
                        $data[] = $dataInput;
                    }
                    
                }
                $i++;
            }
            if(!empty($data)){ // se o array de datas não estiver vazio
                $servico = $servicoDao->buscarServicoPorId($id_servico);
                $servico->setId($id_servico);
                if($servicoDao->inserirDatas($servico, $data)){
                    header('Location: controllerServico.php?opcao=3&msg=Sucesso ao adicionar data');
                } else {
                    header('Location: controllerServico.php?opcao=3&msg=Erro ao adicionar data');
                }
            }else {
                header('Location: controllerServico.php?opcao=3&erro=Nenhuma data válida foi informada');
            }
        }
    }

    else if ($opcao == "7"){
        $servicoDao = new ServicoDao();
        $nome = $_POST['nome'];
        if(!empty($nome)){
            if($servicoDao->inserirTipoServico($nome)){
                header('Location: controllerServico.php?opcao=3&msg=Sucesso ao incluir o tipo de serviço');
            } else {
                header('Location: ../views/servicos.php?opcao=3&erro=Erro ao incluir o tipo de serviço');
            }
        } else {
            header('Location: ../views/servicos.php?msg=3');
        }
    }
}


?>
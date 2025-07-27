<?php
require_once '../dao/conexao.inc.php';
require_once '../dao/servicoDao.inc.php';
require_once '../classes/servico.inc.php';

if(isset($_POST)){
    $acao = $_POST['acao'] ?? '';
    $servicoDao = new ServicoDao();

    if($acao == 'cadastrar'){

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $tipo_servico = $_POST['tipo_servico'];

        if(!empty($nome) && !empty($valor) && !empty($descricao) && !empty($tipo_servico)){
            $servico = new Servico();
            $servico->setServico($nome, $descricao, $valor, $tipo_servico);

            if($servicoDao->inserirServico($servico)){
                header('Location: ../views/servicos.php?msg=1');
            } else {
                header('Location: ../views/servicos.php?msg=2');
            }
        }
        else {
            header('Location: ../views/servicos.php?msg=3');
        }
    }

}

$servicos = $servicoDao->listarServicos();


?>
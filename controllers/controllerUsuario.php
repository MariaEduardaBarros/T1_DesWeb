<?php

require_once '../dao/UsuarioDao.inc.php';
require_once '../classes/usuario.inc.php';

if(isset($_REQUEST['opcao'])) {
    $opcao = $_REQUEST['opcao'];
    $id_usuario = $_REQUEST['id'] ?? null;

    $usuarioDao = new UsuarioDao();

    if ($opcao == "1") { // Inserir novo usuário
        $nome = $_REQUEST['nome'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $senha = $_REQUEST['senha'] ?? '';
        $endereco = $_REQUEST['endereco'] ?? '';
        $telefone = $_REQUEST['telefone'] ?? '';
        $cpf = $_REQUEST['cpf'] ?? '';
        $dtNascimento = $_REQUEST['dtNascimento'] ?? '';
        $tipo = $_REQUEST['tipo'] ?? 'C';

        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($endereco) && !empty($cpf) && !empty($dtNascimento)){
            $usuario = new Usuario();
            $usuario->setUsuario(null, $nome, $email, $tipo, $endereco, $telefone, $cpf, $dtNascimento, $senha);

            if($usuarioDao->inserirUsuario($usuario)){
                $ultimoId = $usuarioDao->getLastInsertId();
                $usuario->setId($ultimoId);
                header('Location: controllerUsuario.php?opcao=3&msg=Sucesso ao incluir usuário');
            } else {
                header('Location: ../views/usuarios.php?erro=Erro ao incluir usuário'); 
            }
        } else {
            header('Location: ../views/usuarios.php?erro=Preencha os campos obrigatórios');
        }
    }

    else if ($opcao == "2") { // Deletar usuário
        if(!empty($id_usuario)){
            if($usuarioDao->excluirUsuario($id_usuario)){
                header('Location: controllerUsuario.php?opcao=3&msg=Sucesso ao deletar usuário');
            
            } else {
                header('Location: controllerUsuario.php?opcao=3&erro=Erro ao deletar usuário');
            }
        }
    }

    else if ($opcao == "3") { // Listar usuários
        $usuarios = $usuarioDao->listarUsuarios();
        session_start();
        $_SESSION['usuarios'] = $usuarios;

        if($_REQUEST['msg'] ?? null){
            $msg = $_REQUEST['msg'];
            header('Location: ../views/usuarios.php?msg='.$msg);
        } else if($_REQUEST['erro'] ?? null){
            $erro = $_REQUEST['erro'];
            header('Location: ../views/usuarios.php?erro='.$erro);
        } else {
            header('Location: ../views/usuarios.php');
        }
    }

    else if ($opcao == "4") { // Atualizar usuário
        if(!empty($id_usuario)){
            $usuario = $usuarioDao->buscarUsuarioPorId($id_usuario);
            if($usuario){
                $nome = $_REQUEST['nome'] ?? '';
                $email = $_REQUEST['email'] ?? '';
                $senha = $_REQUEST['senha'] ?? $usuario->getSenha(); // mantém a senha se não for alterada
                $endereco = $_REQUEST['endereco'] ?? '';
                $telefone = $_REQUEST['telefone'] ?? '';
                $cpf = $_REQUEST['cpf'] ?? '';
                $dtNascimento = $_REQUEST['dtNascimento'] ?? '';
                $tipo = $_REQUEST['$tipo'] ?? 'C';

                $usuario->setUsuario($id_usuario, $nome, $email, $tipo, $endereco, $telefone, $cpf, $dtNascimento, $senha);

                if($usuarioDao->atualizarUsuario($usuario)){
                    header('Location: controllerUsuario.php?opcao=3&msg=Sucesso ao atualizar usuário');
                } else {
                    header('Location: ../views/usuarios.php?erro=Erro ao atualizar usuário');
                }
            } else {
                header('Location: ../views/usuarios.php?erro=Usuário não encontrado');
            }
        }
    }

    else if ($opcao == "5" || $opcao == "9") { // Login
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];

        $usuario = $usuarioDao->autenticar($email, $senha);
        if ($usuario != null) {
            session_start();
            $_SESSION['usuario'] = $usuario;

            if ($usuario->tipo == 'A') {
                header('Location: controllerServico.php?opcao=3');
            } else {
                if($opcao == "5") {
                    header('Location: controllerServico.php?opcao=6');
                } else if($opcao == "9") {
                    header('Location: ../views/dadosCompra.php');
                }
            }
        } else {
            if($opcao == "9" && isset($_REQUEST['status'])) {
                header('Location: ../views/login.php?erro=1&status=1');
            } else {
                header('Location: ../views/login.php?erro=1');
            }
        }
    }

    else if ($opcao == "6") { // Atualizar perfil do usuário logado
            $usuario = $usuarioDao->buscarUsuarioPorId($_REQUEST['id']);
            if($usuario){
                $nome = $_REQUEST['nome'] ?? $usuario->getNome();
                $email = $_REQUEST['email'] ?? $usuario->getEmail();
                $senha = $_REQUEST['senha'] ?? $usuario->getSenha();
                $telefone = $_REQUEST['telefone'] ?? $usuario->getTelefone();
                $endereco = $_REQUEST['endereco'] ?? $usuario->getEndereco();

                $usuario->setUsuario($usuario->getId(), $nome, $email, $usuario->getTipo(), $endereco, $telefone, $usuario->getCpf(), $usuario->getDtNascimento(), $senha);

                if ($usuario = $usuarioDao->atualizarUsuario($usuario)) {
                    session_start();
                    $_SESSION['usuario'] = $usuario; // Atualiza a sessão com os novos dados
                    header('Location: ../views/editarPerfil.php?msg=Perfil atualizado com sucesso');
                }
                else {
                    header('Location: ../views/servicos.php?opcao=3&erro=Erro ao atualizar perfil');
                }
            }
            else{
                header('Location: ../views/servicos.php?erro=Usuário não encontrado');
            }
    }

    else if($opcao == "7"){ // Logout
        session_start();
        unset($_SESSION['usuario']);
        header("Location:../views/index.php");
    }

    else if($opcao == "8"){ // Recuperar senha
        $email = $_REQUEST['pEmail'];
        $novaSenha = $_REQUEST['pSenha'];
        $confirmacaoSenha = $_REQUEST['pConfirmacaoSenha'];   
        
        if(!empty($email) && !empty($novaSenha) && !empty($confirmacaoSenha)){
            $usuario = $usuarioDao->buscarUsuarioPorEmail($email);
            
            if($usuario != null){
                if($novaSenha == $confirmacaoSenha){
                    if($usuarioDao->atualizarSenha($email, $novaSenha)){
                        header('Location: ../views/recuperarSenha.php?msg=1');
                    }
                    else{
                        header('Location: ../views/recuperarSenha.php?erro=3');
                    }
                }
                else {
                    header('Location: ../views/recuperarSenha.php?erro=1');
                }
            }
            else {
                header('Location: ../views/recuperarSenha.php?erro=2');
            }
        }
    }
}
?>

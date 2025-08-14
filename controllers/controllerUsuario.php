<?php
session_start();
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
        $admin = $_REQUEST['admin'] ?? 0;

        if(!empty($nome) && !empty($email) && !empty($senha)){
            $usuario = new Usuario();
            $usuario->setUsuario(null, $nome, $email, $admin, $endereco, $telefone, $cpf, $dtNascimento, $senha);

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
                $admin = $_REQUEST['admin'] ?? 0;

                $usuario->setUsuario($id_usuario, $nome, $email, $admin, $endereco, $telefone, $cpf, $dtNascimento, $senha);

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

    else if ($opcao == "5") { // login
    $email = $_REQUEST['pEmail'] ?? '';
    $senha = $_REQUEST['pSenha'] ?? '';
       
    if (!empty($email) && !empty($senha)) {

        $usuario = $usuarioDao->buscarUsuarioPorEmailSenha($email, $senha);
        if ($usuario) {
            
            $_SESSION['usuario_logado'] = $usuario;

            // Se for admin, vai pra admin
            if ($usuario->getAdmin()) {
                header('Location: ../views/servicos.php');
            } else {
                header('Location: ../views/index.php');
            }
        } else {
            header('Location: ../views/login.php?erro=1');
        }
    } else {
        header('Location: ../views/login.php?erro=1');
    }
}

else if ($opcao == "6") { // Atualizar perfil do usuário logado
    $usuario = $_SESSION['usuario_logado'] ?? null;

    if ($usuario) {
        $nome = $_REQUEST['nome'] ?? $usuario->getNome();
        $email = $_REQUEST['email'] ?? $usuario->getEmail();
        $senha = $_REQUEST['senha'] ?? $usuario->getSenha();
        $telefone = $_REQUEST['telefone'] ?? $usuario->getTelefone();

        $usuario->setUsuario(
            $usuario->getId(),
            $nome,
            $email,
            0, // sem admin
            '', // endereco opcional
            $telefone,
            '', // cpf opcional
            '', // dtNascimento opcional
            $senha
        );

        if ($usuarioDao->atualizarUsuario($usuario)) {
            $_SESSION['usuario_logado'] = $usuario; // atualiza a sessão
            header('Location: ../views/editarPerfil.php?msg=Perfil atualizado com sucesso');
        } else {
            header('Location: ../views/editarPerfil.php?erro=Erro ao atualizar perfil');
        }
    } else {
        header('Location: ../views/login.php');
    }
}

}
?>

<?php
session_start();
require_once '../dao/UsuarioDao.inc.php';

if (isset($_REQUEST['pOpcao']) && $_REQUEST['pOpcao'] == 1) {
    $email = $_REQUEST['pEmail'] ?? '';
    $senha = $_REQUEST['pSenha'] ?? '';

    $usuarioDao = new UsuarioDao();
    $usuario = $usuarioDao->autenticar($email, $senha);

    if ($usuario) {
        // Salva a sessão para todos os usuários autenticados
        $_SESSION['usuario'] = $usuario;

        if ((int)$usuario->is_admin === 1) {
            header('Location: ../views/servicos.php');
            exit;
        } else {
            header('Location: ../views/index.php');
            exit;
        }
    } else {
        // Usuário ou senha incorretos
        header('Location: ../views/login.php?erro=1');
        exit;
    }
}
?>


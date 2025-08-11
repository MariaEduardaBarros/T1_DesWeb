<?php

require_once "includes/cabecalho.inc.php";
require_once "../classes/usuario.inc.php";

$usuarioLogado = $_SESSION['usuario'] ?? null;

if (!$usuarioLogado) {
    // Redirecionar para login se não estiver logado
    header('Location: login.php');
    exit;
}

require_once "includes/cabecalho.inc.php";

// Para exibir mensagens de sucesso ou erro
$msg = $_GET['msg'] ?? '';
$erro = $_GET['erro'] ?? '';
?>

<div class="container my-5">
    <h2>Editar Perfil</h2>

    <?php if ($msg): ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="../controllers/controllerUsuario.php" method="post" class="mt-4">
        <input type="hidden" name="pOpcao" value="atualizarPerfil">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioLogado->getId()) ?>">

        <div class="form-group">
            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome" class="form-control" required
                value="<?= htmlspecialchars($usuarioLogado->getNome()) ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required
                value="<?= htmlspecialchars($usuarioLogado->getEmail()) ?>">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" class="form-control"
                value="<?= htmlspecialchars($usuarioLogado->getTelefone()) ?>">
        </div>

        <div class="form-group">
            <label for="senha">Nova senha (deixe em branco para manter atual)</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Nova senha">
        </div>

        <button type="submit" class="btn btn-primary">Salvar alterações</button>
    </form>
</div>



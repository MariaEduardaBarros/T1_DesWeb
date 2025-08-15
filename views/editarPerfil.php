<?php
require_once "../classes/usuario.inc.php";
require_once "includes/cabecalho.inc.php"; 

$usuario = $_SESSION['usuario'];
$msg = $_REQUEST['msg'] ?? '';
$erro = $_REQUEST['erro'] ?? '';
?>

<div class="container my-5">
    <h2>Editar Perfil</h2>

    <?php if ($msg): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?> 

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?> 

    <form action="../controllers/controllerUsuario.php" method="post" class="mt-4">
        <input type="hidden" name="opcao" value="6">
        <input type="hidden" name="id" value="<?= $usuario->CodCli ?>">

        <div class="form-group">
            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome" class="form-control" required
                   value="<?= $usuario->Nome ?>">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" class="form-control"
                   value="<?= $usuario->Telefone ?>">
        </div>

        <div class="form-group">
            <label for="endereco">Endereco</label>
            <input type="text" id="endereco" name="endereco" class="form-control"
                   value="<?= $usuario->Endereco ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required
                   value="<?= $usuario->Email ?>">
        </div>

        <div class="form-group">
            <label for="senha">Nova senha (deixe em branco para manter atual)</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Nova senha">
        </div>

        <button type="submit" class="btn btn-primary">Salvar alterações</button>
    </form>
</div>

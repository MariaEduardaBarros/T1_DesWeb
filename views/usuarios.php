<?php
require_once "includes/cabecalho.inc.php";
require_once "../classes/usuario.inc.php";
require_once "../dao/UsuarioDao.inc.php";

$usuarioDao = new UsuarioDao();
$usuarios = $usuarioDao->listarUsuarios(); 
?>

<div class="row">
    <div class="col-12 p-0">
        <div class="jumbotron jumbotron-fluid" id="jumbotron">
            <div class="container">
                <h1 class="display-4">Gerenciador de Usuários</h1>
                <p class="lead">Aqui você pode criar, editar, excluir e buscar usuários.</p>
            </div>
        </div>
    </div>
</div>

<div class="container" style="max-width: 1500px;">

    <?php if(isset($_REQUEST['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_REQUEST['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if(isset($_REQUEST['erro'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_REQUEST['erro'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-12 text-right">
            <button type="button" class="btn" style="background-color: #14213D; color: #fff; font-weight: 600;" data-toggle="modal" data-target="#modalAdicionarUsuario">
                Adicionar Usuário
            </button>
        </div>
    </div>

    <div class="table-responsive d-none d-md-block">
        <table class="table table-hover" id="tabela-servicos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Data Nascimento</th>
                    <th>Endereço</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario){ ?>
                    <tr>
                        <td><?= $usuario->getId() ?></td>
                        <td><?= $usuario->getTipo() ?></td>
                        <td><?= $usuario->getNome() ?></td>
                        <td><?= $usuario->getEmail() ?></td>
                        <td><?= $usuario->getTelefone() ?></td>
                        <td><?= $usuario->getCpf() ?></td>
                        <td><?= date('d/m/Y', strtotime($usuario->getDtNascimento())) ?></td>
                        <td><?= $usuario->getEndereco() ?></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalEditar<?= $usuario->getId() ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <td>
                            <a href="../controllers/controllerUsuario.php?opcao=2&id=<?= $usuario->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma a exclusão deste usuário?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-md-none">
        <?php foreach($usuarios as $usuario){ ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #14213D; font-weight: 700;"><?= $usuario->getNome() ?></h5>
                    <p class="card-text"><strong>Tipo:</strong> <?= $usuario->getTipo()?></p>
                    <p class="card-text"><strong>Email:</strong> <?= $usuario->getEmail() ?></p>
                    <p class="card-text"><strong>Telefone:</strong> <?= $usuario->getTelefone() ?></p>
                    <p class="card-text"><strong>CPF:</strong> <?= $usuario->getCpf() ?></p>
                    <p class="card-text"><strong>Data Nascimento:</strong> <?= $usuario->getDtNascimento() ?></p>
                    <p class="card-text"><strong>Endereço:</strong> <?= $usuario->getEndereco()?></p>
                    <div class="d-flex justify-content-between flex-wrap">
                        <button type="button" class="btn btn-light btn-sm mb-1" data-toggle="modal" data-target="#modalEditar<?= $usuario->getId() ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <a href="../controllers/controllerUsuario.php?opcao=2&id=<?= $usuario->getId() ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Confirma a exclusão deste usuário?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Modal de Editar Usuário -->
<?php foreach($usuarios as $usuario){ ?>
<div class="modal fade" id="modalEditar<?= $usuario->getId() ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerUsuario.php" method="post">
                    <input type="hidden" name="opcao" value="4">
                    <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome" value="<?= $usuario->getNome() ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" name="telefone" value="<?= $usuario->getTelefone() ?>">
                    </div>
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" name="cpf" value="<?= $usuario->getCpf() ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Data Nascimento</label>
                        <input type="date" class="form-control" name="dtNascimento" 
                        value="<?= date('Y-m-d', strtotime($usuario->getDtNascimento()))?>" required>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" class="form-control" name="endereco" value="<?= $usuario->getEndereco() ?>" required>
                    </div>                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $usuario->getEmail() ?>" required>
                    </div>                    
                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" class="form-control" name="tipo" value="<?= $usuario->getTipo() ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal de Adicionar Usuário -->
<div class="modal fade" id="modalAdicionarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../controllers/controllerUsuario.php" method="post">
                <input type="hidden" name="opcao" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" name="telefone">
                    </div>
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" name="cpf" required>
                    </div>
                    <div class="form-group">
                        <label>Data Nascimento</label>
                        <input type="date" class="form-control" name="dtNascimento" required>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" class="form-control" name="endereco" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control" name="senha" required>
                    </div>
                    <div class="form-group">
                        <label>Admin</label>
                        <select class="form-control" name="tipo" required>
                            <option value="C">Não</option>
                            <option value="A">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Salvar Usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require_once "includes/cabecalho.inc.php";
    require_once "../classes/usuario.inc.php"; // Classe Usuario
    require_once "../dao/UsuarioDao.inc.php"; // Classe UsuarioDao

    
    $usuarioDao = new UsuarioDao();
$usuarios = $usuarioDao->listarUsuarios(); 
?>

<div class="row">
    <div class="col-md-12 p-0">
        <div class="jumbotron jumbotron-fluid" id="jumbotron">
            <div class="container">
                <h1 class="display-4">Gerenciador de Usuários</h1>
                <p class="lead">Aqui você pode criar, editar, excluir e buscar usuários.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="container">

            <div class="row mb-2 d-flex align-items-center">
                <div class="col-md-8">
                    <h5>Usuários</h5>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <form class="form-inline flex-grow-1" action="../controllers/controllerUsuario.php" method="get">
                        <input type="hidden" name="opcao" value="3"> <!-- opção para busca no controller -->
                        
                    </form>

                    <!-- Botão que abre modal para adicionar usuário -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAdicionarUsuario">
                        Adicionar Usuário
                    </button>
                </div>
            </div>

            <?php 
                if (isset($_REQUEST['msg'])){
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_REQUEST['msg']) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <?php 
                if (isset($_REQUEST['erro'])){
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_REQUEST['erro']) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <table class="table table-hover" id="tabela-usuarios">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($usuarios as $usuario) {
                    ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($usuario->getId()) ?></th>
                        <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                        <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                        <td><?= htmlspecialchars($usuario->getTelefone()) ?></td>
                        <td><?= htmlspecialchars($usuario->getCpf()) ?></td>
                        <td><?= htmlspecialchars($usuario->getDtNascimento()) ?></td>
                        <td>
                            <!-- Botão para editar -->
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalEditar<?= $usuario->getId() ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Modal editar usuário -->
                            <div class="modal fade" id="modalEditar<?= $usuario->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel<?= $usuario->getId() ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel<?= $usuario->getId() ?>">Editar Usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../controllers/controllerUsuario.php" method="post">
                                                <input type="hidden" name="opcao" value="4"> <!-- editar -->
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario->getId()) ?>">
                                                <div class="form-group">
                                                    <label for="nome<?= $usuario->getId() ?>">Nome</label>
                                                    <input type="text" class="form-control" id="nome<?= $usuario->getId() ?>" name="nome" value="<?= htmlspecialchars($usuario->getNome()) ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email<?= $usuario->getId() ?>">Email</label>
                                                    <input type="email" class="form-control" id="email<?= $usuario->getId() ?>" name="email" value="<?= htmlspecialchars($usuario->getEmail()) ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefone<?= $usuario->getId() ?>">Telefone</label>
                                                    <input type="text" class="form-control" id="telefone<?= $usuario->getId() ?>" name="telefone" value="<?= htmlspecialchars($usuario->getTelefone()) ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cpf<?= $usuario->getId() ?>">CPF</label>
                                                    <input type="text" class="form-control" id="cpf<?= $usuario->getId() ?>" name="cpf" value="<?= htmlspecialchars($usuario->getCpf()) ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dtNascimento<?= $usuario->getId() ?>">Data de Nascimento</label>
                                                    <input type="date" class="form-control" id="dtNascimento<?= $usuario->getId() ?>" name="dtNascimento" value="<?= htmlspecialchars($usuario->getDtNascimento()) ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Salvar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botão para excluir -->
                            <a href="../controllers/controllerUsuario.php?opcao=2&id=<?= htmlspecialchars($usuario->getId()) ?>" class="btn btn-danger" onclick="return confirm('Confirma a exclusão deste usuário?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal para adicionar usuário -->
<div class="modal fade" id="modalAdicionarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../controllers/controllerUsuario.php" method="post">
        <input type="hidden" name="opcao" value="1"> <!-- opção para adicionar no controller -->
        <div class="modal-header">
          <h5 class="modal-title" id="modalAdicionarUsuarioLabel">Adicionar Usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- codCli não precisa de input pois é autoincrement -->
          <div class="form-group">
            <label for="nomeNovo">Nome</label>
            <input type="text" class="form-control" id="nomeNovo" name="nome" required>
          </div>
          <div class="form-group">
            <label for="enderecoNovo">Endereço</label>
            <input type="text" class="form-control" id="enderecoNovo" name="endereco" required>
          </div>
          <div class="form-group">
            <label for="telefoneNovo">Telefone</label>
            <input type="text" class="form-control" id="telefoneNovo" name="telefone">
          </div>
          <div class="form-group">
            <label for="cpfNovo">CPF</label>
            <input type="text" class="form-control" id="cpfNovo" name="cpf">
          </div>
          <div class="form-group">
            <label for="dtNascimentoNovo">Data de Nascimento</label>
            <input type="date" class="form-control" id="dtNascimentoNovo" name="dtNascimento">
          </div>
          <div class="form-group">
            <label for="emailNovo">Email</label>
            <input type="email" class="form-control" id="emailNovo" name="email" required>
          </div>
          <div class="form-group">
            <label for="senhaNovo">Senha</label>
            <input type="password" class="form-control" id="senhaNovo" name="senha" required>
          </div>
          <div class="form-group">
            <label for="adminNovo">Admin</label>
            <select class="form-control" id="adminNovo" name="admin" required>
              <option value="0">Não</option>
              <option value="1">Sim</option>
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

</body>
</html>

<?php
    require_once "../controllers/processa_servico.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style-servicos.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-dark bg-dark navbar-expand-lg .d-print-none" id="navbar">
                    <a class="navbar-brand" href="#">Navbar</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(Página atual)</span></a>
                            <a class="nav-item nav-link" href="#">Destaques</a>
                            <a class="nav-item nav-link" href="#">Preços</a>
                            <a class="nav-item nav-link disabled" href="#">Desativado</a>
                        </div>

                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid" id="jumbotron">
                    <div class="container">
                        <h1 class="display-4">Bem-vindo ao gerenciador de serviços!</h1>
                        <p class="lead">Nesta página você pode criar, editar, excluir e buscar serviços.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row mb-2"> 
                        <div class="col-md-10">
                            <h5>Serviços</h5>
                        </div>
                        <div class="col md-2">
                            <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#modalExemplo">Adicionar Serviço</button>
                            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de serviço</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../controllers/processa_servico.php" method="post">
                                                <input type="hidden" name="acao" value="cadastrar">
                                                <div class="form-group">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do serviço" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="valor">Valor</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">R$</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="valor" name="valor" inputmode="decimal" aria-label="Quantia" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descricao">Descrição</label>
                                                    <textarea class="form-control" rows="3"
                                                    id="descricao" 
                                                    name="descricao"
                                                    placeholder="Digite aqui os detalhes do serviço..."
                                                    required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo_servico">Tipo de serviço</label>
                                                    <select class="form-control" id="tipo_servico" name="tipo_servico" required>
                                                        <option value="1">Elétrica</option>
                                                        <option value="2">Encanador</option>
                                                        <option value="3">Pedreiro</option>
                                                        <option value="4">Vidraceiro</option>
                                                        <option value="5">Pintura</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn w-100">Salvar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                if (isset($_REQUEST['msg'])){
                                    if ($_REQUEST['msg'] == 1) {
                            ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo "Sucesso ao adicionar novo serviço" ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                    } elseif ($_REQUEST['msg'] == 2) {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo "Erro ao adicionar novo serviço" ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            <?php
                                    } 
                                }
                            ?>

                            <form action="../controllers/processa_servico.php" method="post">
                                <table class="table" id="tabela-servicos">
                                    <thead class="thead p-0 m-0">
                                        <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($servicos as $servico) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $servico['id_servico'] ?></th>
                                            <td><?= $servico['nome'] ?></td>
                                            <td><?= $servico['valor'] ?></td>
                                            <td><?= $servico['descricao'] ?></td>
                                            <td><?= $servico['id_tipo'] ?></td>
                                            <td><button type="submit" value="<?php $servico['id_servico']?>" class="btn btn-light"><i class="bi bi-pencil-square"></i></button></td>
                                            <td><button type="submit" name="acao" value="deletar" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                                            <input type="hidden" name="id_servico" value="<?= $servico['id_servico'] ?>">
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
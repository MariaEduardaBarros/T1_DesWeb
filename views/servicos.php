<?php
    require_once "../classes/servico.inc.php";
    require_once "includes/cabecalho.inc.php";
  
    $servicos = $_SESSION['servicos'] ?? null;
?>
        <div class="row">
            <div class="col-md-12 p-0">
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
                                            <form action="../controllers/controllerServico.php" method="post">
                                                <input type="hidden" name="opcao" value="1">
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
                                                        <option value="1">Desenvolvedor</option>
                                                        <option value="2">Analista de Dados</option>
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
                            ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= $_REQUEST['msg'] ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            <?php
                                }
                                if (isset($_REQUEST['erro'])){
                            ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= $_REQUEST['erro'] ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            <?php
                                }
                            ?>

                            <form action="../controllers/controllerServico.php" method="post">
                                <table class="table table-hover" id="tabela-servicos">
                                    <thead class="thead p-0 m-0">
                                        <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Datas</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($servicos as $servico) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $servico->getId() ?></th>
                                            <td><?= $servico->getNome() ?></td>
                                            <td><?= $servico->getValor() ?></td>
                                            <td><?= $servico->getDescricao() ?></td>
                                            <td><?= $servico->getTipoServico() ?></td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#modalData<?= $servico->getId() ?>" class="btn btn-light">Adicionar datas</button>
                                                <div class="modal fade" id="modalData<?= $servico->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Datas</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../controllers/controllerServico.php" method="post">
                                                                    <input type="hidden" name="opcao" value=5>
                                                                    <input type="text" name="id" value="<?= $servico->getId() ?>" hidden>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 1</label>
                                                                        <input type="date" class="form-control" id="data_1" name="data_1" value="<?= date("Y-m-d", $servico->getDataServico()[0]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 2</label>
                                                                        <input type="date" class="form-control" id="data_2" name="data_2" value="<?= date("Y-m-d", $servico->getDataServico()[1]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 3</label>
                                                                        <input type="date" class="form-control" id="data_3" name="data_3" value="<?= date("Y-m-d", $servico->getDataServico()[2]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 4</label>
                                                                        <input type="date" class="form-control" id="data_4" name="data_4" value="<?= date("Y-m-d", $servico->getDataServico()[3]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 5</label>
                                                                        <input type="date" class="form-control" id="data_5" name="data_5" value="<?= date("Y-m-d", $servico->getDataServico()[4]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 6</label>
                                                                        <input type="date" class="form-control" id="data_6" name="data_6" value="<?= date("Y-m-d", $servico->getDataServico()[5]) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Data 7</label>
                                                                        <input type="date" class="form-control" id="data_7" name="data_7" value="<?= date("Y-m-d", $servico->getDataServico()[6]) ?>">
                                                                    </div>
                                                                    <button type="submit" class="btn w-100">Salvar</button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#modalEditar<?= $servico->getId() ?>" class="btn btn-light"><i class="bi bi-pencil-square"></i></button>
                                                <div class="modal fade" id="modalEditar<?= $servico->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar serviço</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../controllers/controllerServico.php" method="post">
                                                                    <input type="hidden" name="opcao" value="4">
                                                                    <input type="hidden" name="id" value="<?= $servico->getId() ?>">
                                                                    <div class="form-group">
                                                                        <label for="nome">Nome</label>
                                                                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $servico->getNome() ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="valor">Valor</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">R$</span>
                                                                            </div>
                                                                            <input type="text" class="form-control" id="valor" name="valor" inputmode="decimal" value="<?= $servico->getValor() ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="descricao">Descrição</label>
                                                                        <textarea class="form-control" rows="3"
                                                                        id="descricao" 
                                                                        name="descricao"
                                                                        required><?= $servico->getDescricao() ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tipo_servico">Tipo de serviço</label>
                                                                        <select class="form-control" id="tipo_servico" name="tipo_servico" value="<?= $servico->getTipoServico() ?>" required>
                                                                            <option value="1">Desenvolvedor</option>
                                                                            <option value="2">Analista de Dados</option>
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
                                            </td>
                                            <td><a href='../controllers/controllerServico.php?opcao=1&id=<?= $servico->getId()?>' class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
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
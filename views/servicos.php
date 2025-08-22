<?php
require_once "../classes/servico.inc.php";
require_once "includes/cabecalho.inc.php";

$servicos = $_SESSION['servicos'] ?? [];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <div class="jumbotron jumbotron-fluid" id="jumbotron">
                <div class="container">
                    <h1 class="display-4">Bem-vindo ao gerenciador de serviços!</h1>
                    <p class="lead">Nesta página você pode criar, editar, excluir e buscar serviços.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php if(isset($_REQUEST['msg'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_REQUEST['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <?php if(isset($_REQUEST['erro'])){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_REQUEST['erro'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <div class="row mb-3">
        <div class="col-12 text-right">
            <button type="button" class="btn" style="background-color: #14213D; color: #fff; font-weight: 600;" data-toggle="modal" data-target="#modalAddTipoServico">
                Adicionar Tipo de Serviço
            </button>
            <button type="button" class="btn" style="background-color: #14213D; color: #fff; font-weight: 600;" data-toggle="modal" data-target="#modalAddServico">
                Adicionar Serviço
            </button>
        </div>
    </div>

    <form action="../controllers/controllerServico.php" method="post">
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover" id="tabela-servicos">
                <thead>
                    <tr>
                        <th scope="col" style="width:5%;">ID</th>
                        <th scope="col" style="width:15%;">Nome</th>
                        <th scope="col" style="width:10%;">Valor</th>
                        <th scope="col" style="width:25%;">Descrição</th>
                        <th scope="col" style="width:5%;">Tipo</th>
                        <th scope="col" style="width:15%;">Datas</th>
                        <th scope="col" style="width:5%;">Editar</th>
                        <th scope="col" style="width:5%;">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($servicos as $servico){ ?>
                        <tr>
                            <td><?= $servico->getId() ?></td>
                            <td><?= $servico->getNome() ?></td>
                            <td>R$ <?= number_format($servico->getValor(), 2, ',', '.') ?></td>
                            <td><?= $servico->getDescricao() ?></td>
                            <td><?= $servico->getTipoServico() ?></td>
                            <td>
                                <?php
                                $datas = $servico->getDataServico();
                                if (!empty($datas)) {
                                    foreach($datas as $data){
                                        echo date("d/m/Y", $data) . "<br>";
                                    }
                                } else {
                                    echo "<small class='text-muted'>Sem datas</small><br>";
                                }
                                ?>
                                <button type="button" class="btn btn-light btn-sm mt-1" data-toggle="modal" data-target="#modalData<?= $servico->getId() ?>">
                                    Adicionar/Editar datas
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalEditar<?= $servico->getId() ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td>
                                <a href='../controllers/controllerServico.php?opcao=2&id=<?= $servico->getId() ?>' class="btn btn-danger btn-sm" onclick="return confirm('Confirma a exclusão deste serviço?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    

    <div class="d-md-none">
        <?php foreach($servicos as $servico){ ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #14213D; font-weight: 700;"><?= $servico->getNome() ?></h5>
                    <p class="card-text text-center" style="font-weight: bold;">R$<?= number_format($servico->getValor(), 2, ',', '.') ?></p>
                    <p class="card-text"><?= $servico->getDescricao() ?></p>
                    <p class="card-text"><small class="text-muted">Tipo: <?= $servico->getTipoServico() ?></small></p>
                    <p class="card-text">
                        <strong>Datas:</strong><br>
                        <?php
                        $datas = $servico->getDataServico();
                        if (!empty($datas)) {
                            foreach($datas as $data){
                                echo date("d/m/Y", $data) . "<br>";
                            }
                        } else {
                            echo "<small class='text-muted'>Sem datas</small>";
                        }
                        ?>
                    </p>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalData<?= $servico->getId() ?>">
                            Adicionar/Editar datas
                        </button>
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalEditar<?= $servico->getId() ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <a href='../controllers/controllerServico.php?opcao=2&id=<?= $servico->getId() ?>' class="btn btn-danger btn-sm" onclick="return confirm('Confirma a exclusão deste serviço?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modalAddTipoServico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Tipo de Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerServico.php" method="post">
                    <input type="hidden" name="opcao" value="7">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Adicionar Serviço -->
<div class="modal fade" id="modalAddServico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerServico.php" method="post">
                    <input type="hidden" name="opcao" value="1">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" name="valor" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Serviço</label>
                        <select name="tipo_servico" class="form-control" required>
                            <option value="1">Desenvolvedor</option>
                            <option value="2">Analista de Dados</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
foreach($servicos as $servico){
    $id = $servico->getId();
    $datas = $servico->getDataServico();
?>
<!-- Modal de Adicionar/Editar Datas -->
<div class="modal fade" id="modalData<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar/Editar Datas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerServico.php" method="post">
                    <input type="hidden" name="opcao" value="5">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <?php for($i=0;$i<7;$i++){ ?>
                        <div class="form-group">
                            <label>Data <?= $i+1 ?></label>
                            <input type="date" class="form-control" name="data_<?= $i+1 ?>" value="<?= isset($datas[$i]) ? date("Y-m-d",$datas[$i]) : '' ?>">
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar Serviço -->
<div class="modal fade" id="modalEditar<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controllers/controllerServico.php" method="post">
                    <input type="hidden" name="opcao" value="4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" value="<?= $servico->getNome() ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" name="valor" class="form-control" value="<?= $servico->getValor() ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" required><?= $servico->getDescricao() ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Serviço</label>
                        <select name="tipo_servico" class="form-control" required>
                            <option value="1" <?= $servico->getTipoServico()=='Desenvolvedor' ? 'selected':'' ?>>Desenvolvedor</option>
                            <option value="2" <?= $servico->getTipoServico()=='Analista de Dados' ? 'selected':'' ?>>Analista de Dados</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

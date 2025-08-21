<?php
    require_once "../utils/funcoesUteis.php";
    require_once "../classes/servico.inc.php";
    require_once "includes/cabecalho.inc.php";
?>

<div class="container-fluid px-0">
    <div class="jumbotron jumbotron-fluid bg-light py-4" id="jumbotron">
        <div class="container">
            <h1 class="display-4 text-center">Carrinho de Serviços</h1>
            <p class="text-center text-muted">
                Escolha uma data para a conversa inicial do serviço antes de prosseguir.
            </p>
        </div>
    </div>
</div>
<?php
    if(isset($_REQUEST['status'])){
?>
        <div class="container my-5">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Carrinho vazio</h3>
                    <p class="card-text text-muted">Você ainda não adicionou nenhum serviço.</p>
                    <a href="../controllers/controllerServico.php?opcao=6" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Ir para lista de serviços
                    </a>
                </div>
            </div>
        </div>
<?php
    } 
    else {
        $carrinho = $_SESSION['carrinho']; 
?>
<div class="container my-5" style="max-width: 1500px;">
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
        
        <form action="../controllers/controllerCarrinho.php?opcao=5" method="post">
            <div class="table-responsive">
                <table class="table table-hover " id="tabela-carrinho">
                    <thead class="thead p-0 m-0">
                        <tr>
                            <th scope="col" style="width:5%;">ID</th>
                            <th scope="col" style="width:20%;">Serviço</th>
                            <th scope="col" style="width:35%;">Descrição</th>
                            <th scope="col" style="width:10%;">Valor</th>
                            <th scope="col" style="width:12%;">Data</th>
                            <th scope="col" style="width:5%;">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $index = 0;
                            $total = 0;
                            foreach($carrinho as $servico) {
                                $total += $servico->getValor();
                        ?>
                        <tr>
                            <th data-label="ID"><?= $servico->getId() ?></th>
                            <td data-label="Serviço"><?= $servico->getNome() ?></td>
                            <td data-label="Descrição"><?= $servico->getDescricao() ?></td>
                            <td data-label="Valor">R$<?= number_format($servico->getValor(), 2, ',', '.')?></td>
                            <td data-label="Data">
                                <select name="data_servico_<?= $index ?>" class="form-control">
                                    <option value="" selected>Escolha uma data...</option>
                                    <?php
                                        foreach ($servico->getDataServico() as $data) { ?>
                                            <option value="<?= $data ?>"><?= formatarData($data)?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td data-label="Remover" class="text-right">
                                <a href="../controllers/controllerCarrinho.php?opcao=2&index=<?=$index?>" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                                $index++;
                            }
                        ?>
                        <tr align="right">
                            <td colspan="8"><p style="font-size: 1.5rem; color: #0b103f;"><b>Total = R$ <?=number_format($total, 2, ',', '.')?></b></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container text-center">
            
                <div class="row">
                    <div class="col col-sm mb-2">
                        <a href="../controllers/controllerServico.php?opcao=6" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-left"></i> Continuar comprando
                        </a>
                    </div>

                    <div class="col col-sm mb-2">
                        <a href="../controllers/controllerCarrinho.php?opcao=3" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Esvaziar carrinho
                        </a>
                    </div>
                    <div class="col col-sm mb-2">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle"></i> Confirmar compra
                        </button>
                    </div>
                    <input type="hidden" name="total" value="<?= $total ?>">
                </div>
            </div>
        </form>
</div>
<?php
     }
?>

</body>
</html>
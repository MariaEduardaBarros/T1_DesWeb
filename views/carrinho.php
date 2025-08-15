<?php
    require_once "../classes/servico.inc.php";
    require_once "includes/cabecalho.inc.php";

    $carrinho = $_SESSION['carrinho'];
?>

<div class="container-fluid px-0">
    <div class="jumbotron jumbotron-fluid bg-light py-4" id="jumbotron">
        <div class="container">
            <h1 class="display-4 text-center">Carrinho de Serviços</h1>
            <p class="lead text-center">Confirme os serviços selecionados!</p>
        </div>
    </div>
</div>

<div class="container my-5" style="max-width: 1500px;">
    <form action="../controllers/controllerServico.php" method="post">
        
        <div class="table-responsive">
            <table class="table table-hover " id="tabela-servicos">
                <thead class="thead p-0 m-0">
                    <tr>
                        <th scope="col" style="width:5%;">ID</th>
                        <th scope="col" style="width:20%;">Serviço</th>
                        <th scope="col" style="width:35%;">Descrição</th>
                        <th scope="col" style="width:10%;">Valor</th>
                        <th scope="col" style="width:15%;">Data</th>
                        <th scope="col" style="width:5%;">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($carrinho as $servico) {
                    ?>
                    <tr>
                        <th>id</th>
                        <td><?= $servico->getNome() ?></td>
                        <td><?= $servico->getDescricao() ?></td>
                        <td><?= $servico->getValor() ?></td>
                        <td>
                            <select name="data_servico" class="form-select" id="">
                                <option value="">Selecione uma data</option>
                                <?php 
                                    foreach ($servico->getDatasServico() as $data) { ?>
                                        <option value="<?= $data ?>"><?= $data ?></option>
                                <?php 
                                    } 
                                ?>
                            </select>
                        </td>
                        <td class="text-center"><a href='#' class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                    </tr>
                    <?php
                        } // termina a lógica de exibição dos serviços no carrinho
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

</body>
</html>

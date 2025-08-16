<?php
    require_once "../utils/funcoesUteis.php";
    require_once "../classes/usuario.inc.php";
    require_once "../classes/ItemCarrinho.inc.php";
    require_once "includes/cabecalho.inc.php";

    $usuario = $_SESSION['usuario'];
    $total =  $_SESSION['total'];
    $itensCarrinho = $_SESSION['itensCarrinho'];
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Confirmação da Contratação</h2>

    <div class="card mb-4">
        <div class="card-header">Dados do Cliente</div>
        <div class="card-body">
            <p><strong>Nome: </strong><?= $usuario->Nome?> </p>
            <p><strong>CPF: </strong><?= $usuario->CPF?></p>
            <p><strong>Endereco: </strong><?= $usuario->Endereco?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Serviços contratados</div>
        <div class="card-body">
            <table class="table" id="tabela-servicos">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($itensCarrinho as $item) {
                    ?>
                    <tr>
                        <td><?=$item->getServico()->getId()?></td>
                        <td><?=$item->getServico()->getNome()?></td>
                        <td><?=$item->getServico()->getDescricao()?></td>
                        <td><?= formatarData($item->getData()) ?></td>
                        <td><?=$item->getServico()->getValor() ?></td>
                    </tr>
                   <?php } ?>
                </tbody>
                <tfoot>
                    <tr align="right">
                            <td colspan="8"><p style="font-size: 1.5rem; color: #0b103f;"><b>Total = R$ <?=number_format($total, 2, ',', '.')?></b></p>
                            </td>
                        </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <form method="post" action="../controllers/controllerCompra.php">
        <input type="hidden" name="opcao" value="1">
        <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar Contratação</button>
    </form>
</div>

</body>
</html>
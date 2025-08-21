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
            <p><strong>ID: </strong><?= $usuario->CodCli ?></p>
            <p><strong>Nome: </strong><?= $usuario->Nome ?> </p>
            <p><strong>CPF: </strong><?= $usuario->CPF ?></p>
            <p><strong>Endereço: </strong><?= $usuario->Endereco ?></p>
        </div>
    </div>

    <div class="card mb-4 d-none d-md-block">
        <div class="card-header">Serviços contratados</div>
        <div class="card-body">
            <table class="table table-hover" id="tabela-servicos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($itensCarrinho as $item){ ?>
                    <tr>
                        <td><?= $item->getServico()->getId() ?></td>
                        <td><?= $item->getServico()->getNome() ?></td>
                        <td><?= $item->getServico()->getDescricao() ?></td>
                        <td><?= formatarData($item->getData()) ?></td>
                        <td>R$ <?= number_format($item->getServico()->getValor(), 2, ',', '.') ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr align="right">
                        <td colspan="5">
                            <p style="font-size: 1.5rem; color: #0b103f;"><b>Total = R$ <?= number_format($total, 2, ',', '.') ?></b></p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="d-md-none">
        <div class="card-header">Serviços contratados</div>
        <?php foreach($itensCarrinho as $item){ ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold" style="color: #14213D;"><?= $item->getServico()->getNome() ?></h5>
                    <p class="card-text"><strong>ID:</strong> <?= $item->getServico()->getId() ?></p>
                    <p class="card-text"><strong>Descrição:</strong> <?= $item->getServico()->getDescricao() ?></p>
                    <p class="card-text"><strong>Data:</strong> <?= formatarData($item->getData()) ?></p>
                    <p class="card-text"><strong>Valor:</strong> R$ <?= number_format($item->getServico()->getValor(), 2, ',', '.') ?></p>
                </div>
            </div>
        <?php } ?>
        <div class="text-right mb-3">
            <p style="font-size: 1.5rem; color: #0b103f;"><b>Total = R$ <?= number_format($total, 2, ',', '.') ?></b></p>
        </div>
    </div>

    <div class="alert alert-warning text-center mb-3" role="alert" style="font-size: 1rem;">
        Revise seus itens antes de confirmar. Caso precise,
        <a href="../controllers/controllerCarrinho.php?opcao=6" class="alert-link font-weight-bold">clique aqui para voltar ao carrinho</a>
    </div>

    <a href="dadosPagamento.php"><button type="submit" class="btn btn-success btn-lg btn-block">Confirmar Contratação</button></a>
</div>
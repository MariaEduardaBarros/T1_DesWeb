<?php
include_once "includes/cabecalho.inc.php";

$boleto = $_GET['boleto'];

$boletos = [
    'bb' => 'boleto/meuBoletoBB.php',
    'caixa' => 'boleto/meuBoletoCaixa.php',
    'itau' => 'boleto/meuBoletoItau.php',
    'santander' => 'boleto/meuBoletoSantander.php',
];

$boletoUrl = $boletos[$boleto];
?>
<div class="d-flex align-items-center justify-content-center" style="height: 90vh;">  
    <div class="container mt-5">
        <div class="card shadow p-4 text-center">
            <h1 class="mb-3" style="color: #14213D; font-weight: 600;">Pedido concluído com sucesso!</h1>
            <p class="lead">
                Seu boleto foi gerado. <a href="<?= $boletoUrl ?>" target="_blank"><strong>Clique aqui</strong></a> para abrir em outra aba.
            </p>
            <a href="index.php" class="btn mt-3" style="background-color: #14213D; color: #fff;">Voltar para a página inicial</a>
        </div>
    </div>
</div>


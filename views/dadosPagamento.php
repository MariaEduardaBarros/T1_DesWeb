<?php
require_once "includes/cabecalho.inc.php";
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Pagamento</h2>

    <div class="card mb-4">
        <div class="card-header">Boleto Bancário</div>
        <div class="card-body">
            <p>Escolha o banco para gerar seu boleto:</p>

            <form action="../controllers/controllerVenda.php" method="get">
                <input type="hidden" name="opcao" value="1">

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="pag" id="bb" value="bb" required>
                    <label class="form-check-label" for="bb">Banco do Brasil</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="pag" id="caixa" value="caixa">
                    <label class="form-check-label" for="caixa">Caixa</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="pag" id="itau" value="itau">
                    <label class="form-check-label" for="itau">Itaú</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="pag" id="santander" value="santander">
                    <label class="form-check-label" for="santander">Santander</label>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="dadosCompra.php" class="btn btn-secondary">← Confirmar dados</a>
                    <button type="submit" class="btn btn-success">Gerar Boleto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "../classes/servico.inc.php";
require_once "includes/cabecalho.inc.php";

$servicos = $_SESSION['servicos'] ?? array();
?>

<div class="container-fluid px-0">
    <div class="jumbotron jumbotron-fluid bg-light py-4 mb-5" id="jumbotron">
        <div class="container">
            <h1 class="display-4 text-center">Bem-vindo aos nossos serviços!</h1>
            <p class="lead text-center">Confira abaixo os serviços disponíveis e adicione no máximo 5 ao seu carrinho.</p>
        </div>
    </div>
</div>

<div id="servicos" class="container mb-5">
    <?php
        if (empty($servicos)) {
    ?>
        <p class="lead text-center">Nenhum serviço disponível no momento.</p>
    <?php
        }
    ?>
    <div class="row">
        <?php foreach ($servicos as $servico){ ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center fw-bold" style="font-weight: 700; color: #14213D;"><?= strtoupper($servico->getNome()) ?></h5>
                    <p class="card-text flex-grow-1"><strong>Descrição: </strong> <?= $servico->getDescricao() ?></p>
                    <h6 class="card-subtitle mb-2"><strong>Valor:</strong> R$ <?= number_format($servico->getValor(), 2, ',', '.') ?></h6>

                    <div class="mt-auto">
                        <?php 
                            if($servico->getDisponivel()) {
                        ?>
                            <a class="btn w-100" style="background-color:  #14213D; color: #fff"
                                href="../controllers/controllerCarrinho.php?opcao=1&id=<?= $servico->getId()?>">
                                Adicionar ao carrinho
                            </a>
                        <?php
                            } else {
                        ?>
                            <p class="card-text text-center text-danger">Serviço indisponível no momento!</p>
                        <?php
                            }
                        ?>
                    </div>

                </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


</body>
</html>

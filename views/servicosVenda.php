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

<!-- Cards dos serviços -->
<div id="servicos" class="container mb-5">
  <div class="row">
    <?php foreach ($servicos as $servico){ ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center fw-bold"><?= $servico->getNome() ?></h5>
            <p class="card-text flex-grow-1"><?= $servico->getDescricao() ?></p>
			<h6 class="card-subtitle mb-2">Valor: R$ <?= number_format($servico->getValor(), 2, ',', '.') ?></h6>

            <div class="mt-auto">
              <a class="btn btn-primary w-100"
                 href="../controllers/controllerCarrinho.php?opcao=1&id=<?= $servico->getId()?>">
                Adicionar ao carrinho
              </a>
            </div>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


</body>
</html>

<?php
require_once "../classes/servico.inc.php";
require_once "includes/cabecalho.inc.php";
$servicos = $_SESSION['servicos'] ?? [];
?>

<section class="container my-5">
  <div class="row align-items-center">
    <div class="col-md-6 col-12 p-0">
      <div class="conteudo-texto px-4 px-md-0">
        <h1 class="display-4" style="font-size: 50px;">
          Transformamos ideias em<br />
          <span class="text-primary" style="font-weight: bold;">SOLUÇÕES DIGITAIS INTELIGENTES.</span>
        </h1>
      </div>
    </div>
    <div class="col-md-6 p-0">
      <div class="conteudo-imagem text-center text-md-right">
        <img src="imagens/inicial.svg" alt="Ilustração inicial" class="img-fluid" />
      </div>
    </div>
  </div>
</section>

<div class="container-fluid px-0">
  <div class="jumbotron jumbotron-fluid bg-light py-4 mb-5" id="jumbotron">
    <div class="container">
      <h1 class="display-4">Bem-vindo aos nossos serviços!</h1>
      <p class="lead">Confira abaixo os serviços disponíveis e adicione ao seu carrinho.</p>
    </div>
  </div>
</div>

<!-- Cards dos serviços -->
<div id="servicos" class="container mb-5">
  <div class="row">
    <?php foreach ($servicos as $servico): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($servico->getNome()) ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">R$ <?= number_format($servico->getValor(), 2, ',', '.') ?></h6>
            <p class="card-text flex-grow-1"><?= htmlspecialchars($servico->getDescricao()) ?></p>
            <button class="btn btn-primary mt-auto adicionar-carrinho" data-id="<?= $servico->getId() ?>">Adicionar ao carrinho</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="modalCarrinho" tabindex="-1" role="dialog" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCarrinhoLabel">Item adicionado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Serviço adicionado ao carrinho com sucesso!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Continuar</button>
        <a href="carrinho.php" class="btn btn-primary">Ir para o carrinho</a>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.adicionar-carrinho').forEach(button => {
    button.addEventListener('click', () => {
      const servicoId = button.getAttribute('data-id');
      
      $('#modalCarrinho').modal('show');
    });
  });
</script>

</body>
</html>

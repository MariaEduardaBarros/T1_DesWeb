<a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
    Sair
</a>

<!-- Modal de logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Sair do sistema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body text-center">
        Você realmente deseja sair do sistema?
      </div>
      
      <div class="modal-footer d-flex flex-column flex-sm-row justify-content-center">
        <a class="btn btn-primary mb-2 mb-sm-0 mr-sm-2 w-100 w-sm-auto" href="../controllers/controllerUsuario.php?opcao=7">
          Sair
        </a>
        <button type="button" class="btn btn-secondary w-100 w-sm-auto" data-dismiss="modal">
          Não
        </button>
      </div>
      
    </div>
  </div>
</div>

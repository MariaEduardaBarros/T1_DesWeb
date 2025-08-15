    <div class="row">
        <div class="col-md-12 p-0 ">
            <nav class="navbar navbar-dark bg-dark navbar-expand-lg" id="navbar">
                <a class="navbar-brand" href="#"><img src="./imagens/logo.png" alt="Logo" class="img-fluid" width="45" height="45"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    
                    <div class="navbar-nav mx-auto">
                        <a class="nav-item nav-link" href="index.php">Home</a>
                        <a class="nav-item nav-link" href="../controllers/controllerServico.php?opcao=6">Serviços</a>
                        <a class="nav-item nav-link" href="../controllers/controllerServico.php?opcao=3">Gerenciador de Serviços </a>
                        <a class="nav-item nav-link" href="usuarios.php">Gerenciador de Usuários</a>
                    </div>

                    <div class="navbar-nav">
                        <?php
                            if(!isset($_SESSION['usuario']))
                            {
                        ?>
                                <a class="nav-item nav-link" href="login.php">Login</a>
                        <?php 
                            }else{
                                include_once "modal.inc.php";
                            }
                        
                        ?>        
                    </div>
                </div>
            </nav>
        </div>
    </div>


    

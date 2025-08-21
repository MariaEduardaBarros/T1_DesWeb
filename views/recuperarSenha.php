<?php
require_once "includes/cabecalho.inc.php";
?>
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center pt-5">
    <div class="row w-100 justify-content-center">

        <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-center align-items-center mb-4 mb-md-0">
            <img src="imagens/reset-password-animate.svg" class="img-fluid w-75" alt="Imagem ilustrativa de recuperação de senha">
        </div>

        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center py-5 py-md-0">
            <div class="p-4 p-md-5 bg-white shadow w-100">

                <h1 class="text-center fw-bold mb-2" style="font-size: 2rem; font-weight: bold; color: #14213D;">RECUPERAR SENHA</h1>
                <p class="text-center text-secondary mb-4">Digite seu email e a nova senha</p>

                <form action="../controllers/controllerUsuario.php" method="get">
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label fw-semibold" style="color: #14213D;"><strong>Email</strong></label>
                        <input type="email" class="form-control" id="email" name="pEmail" placeholder="Digite seu email" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="senha" class="form-label fw-semibold" style="color: #14213D;"><strong>Nova senha</strong></label>
                        <input type="password" class="form-control" id="senha" name="pSenha" placeholder="Digite a nova senha" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="confirmacao" class="form-label fw-semibold" style="color: #14213D;"><strong>Confirme a nova senha</strong></label>
                        <input type="password" class="form-control" id="confirmacao" name="pConfirmacaoSenha" placeholder="Confirme a nova senha" required>
                    </div>

                    <div class="mb-3 text-center">
                        <?php
                            $msg = "&nbsp;";
                            $erro = "&nbsp;";
                            if(isset($_REQUEST['erro'])){
                                $tipo = (int)$_REQUEST['erro'];
                                if($tipo == 1){
                                    $erro = "As senhas não conferem!";
                                }else if($tipo == 2){
                                    $erro = "O email não foi encontrado!";
                                }else if ($tipo == 3){
                                    $erro = "Erro ao atualizar senha!";
                                }
                            }
                            if(isset($_REQUEST['msg'])){
                                $tipo = (int)$_REQUEST['msg'];
                                if($tipo == 1){
                                    $msg = "Senha atualizada com sucesso! Faça seu <a class='recuperar-link fw-semibold' href='login.php'>Login</a>.";
                                }
                            }
                        ?>
                        <p class="text-danger fw-semibold mb-1"><?=$erro ?></p>
                        <p class="text-success fw-semibold mb-1"><?=$msg ?></p>
                    </div>

                    <button type="submit" class="btn w-100 fw-bold mb-3" style="background-color: #14213D; color: #fff;"><strong>Recuperar</strong></button>
                    <input type="hidden" value="8" name="opcao">
                </form>

                <hr class="my-3">

                <p class="text-center mb-0">
                    Lembrou sua senha? 
                    <a href="login.php" class="text-decoration-none fw-semibold" style="color: #14213D;">Fazer Login</a>
                </p>

            </div>
        </div>

    </div>
</div>

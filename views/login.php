<?php
    require_once "includes/cabecalho.inc.php";
?>
    <div class="container-fluid login">
        <div class="row no-gutters">
            <div class="col-6">
                <div id="login-left">
                        <img src="imagens/login-animate.svg" id="login-img">
                </div>
            </div>
            <div class="col-6">
                <div id="login-right">
                        <div id="content-login">
                                <h1 id="title-login">LOGIN</h1>
                                <p>Entre com suas credenciais</p>

                                <form action="../controllers/controllerUsuario.php" method="get" id="form-login">
                                    <div class="form-group formulario">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control formulario-input" id="email" name="pEmail" placeholder="Digite seu email" required>
                                    </div>
                                    <div class="form-group formulario">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control formulario-input" id="Senha" name="pSenha" placeholder="Digite sua senha" required>
                                    </div>
                                    <div class="login-error">
                                        <?php
                                            $msg = "&nbsp;";
                                            if(isset($_REQUEST['erro'])){
                                                $tipo = (int)$_REQUEST['erro'];
                                                if($tipo == 1){
                                                    $msg = "Login incorreto!";
                                                }
                                            }
                                        ?>
                                        <p><?=$msg ?></p>
                                        <div id="forget-pass">
                                            <a href="recuperarSenha.php" class="login-link">Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                    <button id="btn-login" type="submit" class="btn w-100">Entrar</button>

                                    <?php
                                        if(isset($_REQUEST['status']) && $_REQUEST['status'] == 1) {
                                    ?>
                                            <input type="hidden" value="9" name="opcao">
                                            <input type="hidden" name="status" value="1">
                                    <?php } else {?>
                                            <input type="hidden" value="5" name="opcao">
                                    <?php } ?>
                                </form>

                                <hr>
                                <p id="cadastro">Não tem uma conta? <a href="cadastro.php" class="login-link">Cadastre-se</a></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
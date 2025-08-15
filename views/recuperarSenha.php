<?php
    require_once "includes/cabecalho.inc.php";
?>
    <div class="container-fluid recuperar">
        <div class="row no-gutters">
            <div class="col-6">
                <div id="recuperar-esquerda">
                        <img src="imagens/reset-password-animate.svg" id="recuperar-img">
                </div>
            </div>
            <div class="col-6">
                <div id="recuperar-direita">
                        <div id="content-recuperar">
                                <h3 id="titulo-recuperar">RECUPERE SUA SENHA</h3>

                                <form action="../controllers/controllerUsuario.php" method="get" id="form-recuperar">
                                    <div class="form-group formulario">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control formulario-input" id="email" name="pEmail" placeholder="Digite seu email" required>
                                    </div>
                                    <div class="form-group formulario">
                                        <label for="senha">Nova senha</label>
                                        <input type="password" class="form-control formulario-input" id="senha" name="pSenha" placeholder="Digite a nova senha" required>
                                    </div>
                                    <div class="form-group formulario">
                                        <label for="confirmacao">Confirme a nova senha</label>
                                        <input type="password" class="form-control formulario-input" id="confirmacao" name="pConfirmacaoSenha" placeholder="Confirme a nova senha" required>
                                    </div>
                                    <div class="recuperar-error">
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
                                                    $msg = "Senha atualizada com sucesso! Faça seu <a class='recuperar-link' href='login.php'>Login</a>.";
                                                }
                                            }
                                        ?>
                                        
                                        <p id="erro"><?=$erro ?></p>
                                        <p id="msg"><?=$msg ?></p>
                                        
                                    </div>
                                    <button id="btn-recuperar" type="submit" class="btn w-100">Recuperar</button>

                                    <input type="hidden" value="8" name="opcao">
                                </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
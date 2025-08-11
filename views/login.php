<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style_login.css">
    
</head>
<body>
    <div class="container-fluid login">
        <div class="row no-gutters">
            <div class="col-6">
                <div id="login-left">
                        <img src="imagens/login-animate.svg" alt="">
                </div>
            </div>
            <div class="col-6">
                <div id="login-right">
                        <div id="content-login">
                                <h1>LOGIN</h1>
                                <p>Entre com suas credenciais</p>

                                <form action="../controllers/controllerUsuario.php" method="get">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="pEmail" placeholder="Digite seu email"><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" id="Senha" name="pSenha" placeholder="Digite sua senha">
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
                                            <a href="#">Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn w-100">Entrar</button>

                                    <input type="hidden" value="1" name="pOpcao">
                                </form>

                                <hr>
                                <p id="cadastro">Não tem uma conta? <a href="#">Cadastre-se</a></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
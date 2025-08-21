<?php
require_once "../classes/usuario.inc.php";
require_once "includes/cabecalho.inc.php";

$informacoes = $_SESSION['informacoes'] ?? new Usuario();
?>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center pt-5">
    <div class="row w-100 justify-content-center">

        <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-center align-items-center mb-4 mb-md-0">
            <img src="imagens/sign-up-animate.svg" class="img-fluid w-75" alt="Imagem ilustrativa de cadastro">
        </div>

        <div class="col-lg-6 col-md-8 col-12 d-flex justify-content-center align-items-center py-5 py-md-0">
            <div class="p-4 p-md-5 bg-white shadow w-100">

                <h1 class="text-center fw-bold mb-2" style="font-size: 2.5rem; font-weight: bold; color: #14213D;">CADASTRO</h1>
                <p class="text-center text-secondary mb-4">Preencha seus dados para criar uma conta</p>

                <form action="../controllers/controllerUsuario.php" method="get">

                    <div class="mb-3 text-start">
                        <label for="nome" class="form-label fw-semibold" style="color: #14213D;"><strong>Nome completo</strong></label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" value="<?= $informacoes->getNome() ?>" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="endereco" class="form-label fw-semibold" style="color: #14213D;"><strong>Endereço</strong></label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu endereço" value="<?= $informacoes->getEndereco() ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="telefone" class="form-label fw-semibold" style="color: #14213D;"><strong>Telefone</strong></label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite seu telefone" value="<?= $informacoes->getTelefone() ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cpf" class="form-label fw-semibold" style="color: #14213D;"><strong>CPF</strong></label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" value="<?= $informacoes->getCpf() ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dataNascimento" class="form-label fw-semibold" style="color: #14213D;"><strong>Data de Nascimento</strong></label>
                            <input type="date" class="form-control" id="dataNascimento" name="dtNascimento" value="<?= $informacoes->getDtNascimento() ?>" required>
                        </div>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label fw-semibold" style="color: #14213D;"><strong>Email</strong></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" value="<?= $informacoes->getEmail() ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="senha" class="form-label fw-semibold" style="color: #14213D;"><strong>Senha</strong></label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" value="<?= $informacoes->getSenha() ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmacaoSenha" class="form-label fw-semibold" style="color: #14213D;"><strong>Confirme a senha</strong></label>
                            <input type="password" class="form-control" id="confirmacaoSenha" name="confirmacaoSenha" placeholder="Confirme sua senha" required>
                        </div>
                    </div>

                    <?php if(isset($_REQUEST['msg'])){ ?>
                        <p class="text-success fw-bold mb-3 text-center">
                            <?= $_REQUEST['msg'] ?>
                        </p>
                    <?php } ?>

                    <?php if(isset($_REQUEST['erro'])){ ?>
                        <p class="text-danger fw-semibold mb-3 text-center">
                            <?= $_REQUEST['erro'] ?>
                        </p>
                    <?php } ?>

                    <button type="submit" class="btn w-100 fw-bold mb-3" style="background-color: #14213D; color: #fff;"><strong>Cadastrar</strong></button>

                    <input type="hidden" value="10" name="opcao">
                </form>

                <hr class="my-3">

                <p class="text-center mb-0">Já tem uma conta? 
                    <a href="login.php" class="text-decoration-none fw-semibold" style="color: #14213D;">Faça login</a>
                </p>

            </div>
        </div>

    </div>
</div>

<?php unset($_SESSION['informacoes']); ?>
</body>
</html>

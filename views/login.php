<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style-login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="auth-container">
        <div id="auth-illustration">
            <img src="imagens/login-imagem.svg" alt="Ilustração de autenticação">
        </div>

        <div id="auth-form">
            <div id="logo">
                <img src="imagens/logo.png" alt="Logo da Empresa">
            </div>
            <h1>Faça seu <span>LOGIN</span></h1>
            <p>Por favor, entre com suas credenciais</p>

            <form action="#" method="post">
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Digite seu email" required>
                </div>

                <div class="form-field">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
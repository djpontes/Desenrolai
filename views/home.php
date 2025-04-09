<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mostra erro apenas se existir na URL
if (isset($_GET['erro'])) {
    $mensagem = "E-mail ou senha incorretos. Por favor, verifique ou cadastre-se.";
    if ($_GET['erro'] === 'cadastro') {
        $mensagem = "Este e-mail já está cadastrado.";
    }
    echo '<script>alert("'.$mensagem.'");</script>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Desenrola.i</title>
</head>
<body>
    <main class="main">
        <section class="conteudo">
            <div class="conteudo-escrito">
                <h1 class="conteudo-titulo">Enrolado com suas despesas?</h1>
                <img class="conteudo-image" src="images/logo-desenrolai.svg" alt="Logo Desenrola.i">
                <button id="abrirModalSing" class="conteudo-botao">Entrar</button>
            </div>
            <img src="images/image-telefone.svg" class="conteudo-image-telefone" alt="Imagem de telefone">
        </section>
    </main>

    <div id="modal" class="modal">
        <div class="modal-content">
            <a class="fechar" id="fecharModalSing">&times;</a>

            <div class="btnForm">
                <div class="btnColor"></div>
                <button id="btnSignin">Entrar</button>
                <button id="btnSignup">Cadastrar</button>
            </div>

            <!-- Formulário de Login -->
            <form id="login" action="../controllers/AuthController.php?action=login" method="POST">
                <input type="email" name="email" placeholder="Digite seu e-mail" class="input-email" required>
                <div class="password-container">
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" class="input-senha" required>
                    <i class="fa-solid fa-eye" id="toggleSenha"></i>
                </div>
                <button type="submit" class="form-botao" id="btnLogin">Entrar</button>
            </form>

            <!-- Formulário de Cadastro -->
            <form id="signup" action="../controllers/AuthController.php?action=cadastrar" method="POST">
                <input type="text" name="nome" placeholder="Digite seu nome" class="input-name" required>
                <input type="email" name="email" placeholder="Digite seu e-mail" class="input-email" required>
                <div class="campo-senha">
                    <input type="password" name="senha" id="passwordSignup" placeholder="Digite sua senha" class="input-senha" required>
                    <i class="fa-solid fa-eye" id="togglePasswordSignup"></i>
                </div>                
                <button type="submit" class="form-botao" id="btnCadastrar">Cadastrar</button>
            </form>
        </div>
    </div>

    <script src="script/home.js"></script>
</body>
</html>
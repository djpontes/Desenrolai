
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['id_usuario'])) {
    header('Location: home.php');
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Corrigindo caminhos (remova a barra inicial /view/) -->
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Desenrola.i</title>
</head>
<body>
    <header class="header"> 
        <img src="images/logo-desenrolai.svg" class="image-logo">
        <!-- Alterando para logout (irá destruir a sessão) -->
        <i class="fa-solid fa-arrow-right-to-bracket fa-2x" style="color: #000000;" 
           onclick="window.location.href='controllers/AuthController.php?action=logout'"></i>
    </header>

    <main class="main"> 
        <div class="container">
             <!-- Alterando links para .php -->
             <button class="btn-enorme" onclick="window.location.href='despesa.php'">
                <img src="images/despesas.svg" alt="Icone de despesas">
                <h3>Suas despesas</h3>
             </button>

             <button class="btn-enorme" onclick="window.location.href='relatorio.php'">
                <img src="images/relatorio.svg" alt="Icone de relatório">
                <h3>Relatório</h3>
             </button>

             <button class="btn-enorme" id="abrirModalEdit">
                <img src="images/perfil.svg" alt="Icone de perfil">
                <h3>Seu perfil</h3>
             </button>
        </div>
    </main>

    <div id="modal" class="modal">
        <div class="modal-content">
            <a class="fechar" id="fecharModalEdit">&times;</a>

            <div class="edit-perfil">
                <h2>Editar seu perfil</h2>
            </div>

            <!-- Formulário para editar perfil (substitua pelos dados reais do usuário) -->
            <form class="form-perfil" action="controllers/UsuarioController.php?action=editar" method="POST">
                <input type="text" name="nome" value="<?php echo $_SESSION['nome_usuario'] ?? ''; ?>" class="input-name">
                <input type="email" name="email" value="<?php echo $_SESSION['email_usuario'] ?? ''; ?>" class="input-email">
                <div class="campo-senha">
                    <input type="password" name="senha" placeholder="Nova senha (deixe em branco para manter)" class="input-senha">
                    <i class="fa-solid fa-eye" id="togglePasswordSignup"></i>
                </div>                
                <button type="submit" class="form-botao" id="btnCadastrar">Editar</button>
            </form>
        </div>
    </div>

    <!-- Corrigindo caminho do JS -->
    <script src="script/menu.js"></script>

    <!-- Mostrando nome do usuário logado (opcional) -->
    <script>
        console.log("Usuário logado: <?php echo $_SESSION['nome_usuario'] ?? 'Visitante'; ?>");
    </script>
</body>
</html>
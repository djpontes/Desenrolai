<?php
require_once '../models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = new UsuarioModel();
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['id_usuario'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;

            if (empty($nome) || empty($email)) {
                $_SESSION['erro'] = "Nome e e-mail são obrigatórios!";
                header('Location: ../views/menu.php');
                exit();
            }

            $resultado = $this->model->atualizarUsuario($id, $nome, $email, $senha);

            if ($resultado) {
                $_SESSION['nome_usuario'] = $nome;
                $_SESSION['email_usuario'] = $email;
                $_SESSION['sucesso'] = "Perfil atualizado com sucesso!";
            } else {
                $_SESSION['erro'] = "Erro ao atualizar perfil. Tente novamente.";
            }

            header('Location: ../views/menu.php');
            exit();
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'editar') {
    $controller = new UsuarioController();
    $controller->editar();
}
?>

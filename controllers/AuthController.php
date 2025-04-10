<?php
require_once '../models/UsuarioModel.php';

class AuthController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = new UsuarioModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuario = $this->model->login($email, $senha);
            
            if ($usuario) {
                // Login bem-sucedido
                $_SESSION['id_usuario'] = $usuario['ID_USUARIO'];
                $_SESSION['nome_usuario'] = $usuario['NOME'];
                $_SESSION['email_usuario'] = $usuario['EMAIL'];
                header('Location: ../views/menu.php');
                exit();
            } else {
                // Login falhou
                header('Location: ../views/home.php?erro=1');
                exit();
            }
        }

        // Se não for POST, redireciona
        header('Location: ../views/home.php');
        exit();
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            try {
                $id = $this->model->cadastrar($nome, $email, $senha);

                if ($id) {
                    $_SESSION['id_usuario'] = $id;
                    $_SESSION['nome_usuario'] = $nome;
                    $_SESSION['email_usuario'] = $email;
                    header('Location: ../views/menu.php?sucesso=1');
                    exit();
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    header('Location: ../views/home.php?erro=Este email já está cadastrado');
                } else {
                    header('Location: ../views/home.php?erro=Erro no servidor');
                }
                exit();
            }
        }

        header('Location: ../views/home.php');
        exit();
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ../views/home.php');
        exit();
    }
}

$action = $_GET['action'] ?? '';
$controller = new AuthController();

if (method_exists($controller, $action)) {
    $controller->$action();
}
?>

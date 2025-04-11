<?php
require_once __DIR__ . '/../models/Despesa.php';
session_start();

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new Despesa();

    if ($action === 'cadastrar') {
        $descricao = $_POST['descricao'];
        $valor = floatval($_POST['valor']); // já tratado no JS
        $data = $_POST['data'];
        $categoria = $_POST['categoria'];
        $usuario_id = $_SESSION['id_usuario'];

        $model->cadastrar($descricao, $valor, $data, $categoria, $usuario_id);

        header("Location: ../views/despesa.php?sucesso=1");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'deletar') {
        $id = intval($_POST['id']);
        $model = new Despesa();
        $model->deletar($id);
    
        header("Location: ../views/despesa.php?sucesso=1");
        exit;
    }
}
?>

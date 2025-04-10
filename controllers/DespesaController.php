<?php
require_once __DIR__ . '/../models/Despesa.php';
session_start();

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrar') {
    session_start();

    $descricao = $_POST['descricao'];
    $valor = floatval($_POST['valor']); // formato correto já tratado no JS
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $usuario_id = $_SESSION['id_usuario'];

    require_once '../models/Despesa.php';
    $model = new Despesa();
    $model->cadastrar($descricao, $valor, $data, $categoria, $usuario_id);

    header("Location: ../views/despesa.php?sucesso=1");
    exit;
}

?>

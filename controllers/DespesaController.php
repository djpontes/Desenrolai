<?php
require_once __DIR__ . '/../models/Despesa.php';
session_start();

$action = $_GET['action'] ?? '';
$model = new Despesa();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'cadastrar') {
        $descricao = $_POST['descricao'];
        $valor = floatval($_POST['valor']); 
        $data = $_POST['data'];
        $categoria = $_POST['categoria'];
        $usuario_id = $_SESSION['id_usuario'];

        $model->cadastrar($descricao, $valor, $data, $categoria, $usuario_id);

        header("Location: ../views/despesa.php?sucesso=1");
        exit;
    }

    if ($action === 'deletar') {
        $id = intval($_POST['id']);
        $model->deletar($id);
    
        header("Location: ../views/despesa.php?sucesso=1");
        exit;
    }
}


if ($action === 'filtrar') {
    $usuario_id = $_SESSION['id_usuario'] ?? null;

    if ($usuario_id) {
        $mes = $_GET['mes'] ?? null;
        $ano = $_GET['ano'] ?? null;

        $despesasFiltradas = $model->filtrarPorMesEAno($usuario_id, $mes, $ano);

       
        $_SESSION['despesas_filtradas'] = $despesasFiltradas;
    }

    header("Location: ../views/despesa.php");
    exit;
}

if ($action === 'editar') {
    $id = intval($_POST['id']);
    $descricao = $_POST['descricao'];
    $valor = floatval($_POST['valor']);
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];

    $model->editar($id, $descricao, $valor, $data, $categoria);

    header("Location: ../views/despesa.php?sucesso=1");
    exit;
}

?>

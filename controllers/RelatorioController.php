<?php
require_once('../models/RelatorioModel.php');

class RelatorioController {
    public function index() {
        $anoSelecionado = isset($_GET['ano']) ? intval($_GET['ano']) : date('Y');

        $model = new RelatorioModel();
        $totaisMensais = $model->getTotaisMensaisPorAno($anoSelecionado);
        $totalAnual = array_sum($totaisMensais);

        // Passar dados para a view
        include 'views/relatorio.php';
    }
}
?>
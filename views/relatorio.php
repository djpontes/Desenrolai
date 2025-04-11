<?php
require_once __DIR__ . '/../models/RelatorioModel.php';

$model = new RelatorioModel();

$anoSelecionado = isset($_GET['ano']) ? intval($_GET['ano']) : date('Y');
$totaisMensais = $model->getTotaisMensaisPorAno($anoSelecionado);
$totalAnual = array_sum($totaisMensais);
$anosDisponiveis = $model->getAnosDisponiveis();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/relatorio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Desenrola.i</title>
</head>
<body>
    <header class="header"> 
        <img src="images/logo-desenrolai.svg" class="image-logo">
        <i class="fa-solid fa-arrow-right-to-bracket fa-2x" style="color: #000;" onclick="window.location.href='home.html'"></i>
    </header>

    <main class="main">
        <section class="table-header">
            <h1>Relatório das suas despesas</h1>
        </section>

        <section class="container-main d-flex justify-content-center align-items-center gap-3 flex-wrap">
            <form method="GET" class="d-flex align-items-center gap-2">
                <select name="ano" class="form-select">
                    <?php foreach ($anosDisponiveis as $ano): ?>
                        <option value="<?= $ano ?>" <?= $ano == $anoSelecionado ? 'selected' : '' ?>>
                            <?= $ano ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
        </section>

        <section class="table-body mt-4">
            <table class="table table-hover">
                <thead>
                    <tr class="col-main">
                        <th scope="col">Mês</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomesMeses = [
                        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                    ];

                    foreach ($totaisMensais as $mes => $valor):
                    ?>
                        <tr>
                            <td><?= $nomesMeses[$mes] ?></td>
                            <td>R$ <?= number_format($valor, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="col-main">
                        <th>Total Anual</th>
                        <td><strong>R$ <?= number_format($totalAnual, 2, ',', '.') ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

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

  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .header {
    display: flex;
    align-items: center;
    justify-content:space-around;
    padding: 20px;
    position: relative;
    width: 100%;
    }

    .image-logo {
      height: 40px;
    }

    .main {
      padding: 2rem;
    }

    .table-header h1 {
      text-align: center;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .container-main {
      margin-bottom: 2rem;
    }

    .btn-success {
      background-color: #aae865 !important;
      border-color: #aae865 !important;
    }

    .table-body {
      background-color: white;
      border-radius: 8px;
      padding: 0;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .scroll-wrapper {
      max-height: 300px;
      overflow-y: auto;
    }

    .table-fixed {
      width: 100%;
      margin: 0;
      border-collapse: collapse;
    }

    .table-fixed thead th {
      position: sticky;
      top: 0;
      background-color: #aae865 !important;
      color: #000000;
      z-index: 10;
      padding: 16px;
    }

    .table-fixed tfoot td,
    .table-fixed tfoot th {
      position: sticky;
      bottom: 0;
      background-color: #aae865 !important;
      color:  #000000;
      padding: 16px;
      z-index: 10;
    }

    .table-fixed td,
    .table-fixed th {
      padding: 16px;
      font-size: 1rem;
    }

    .table-fixed th:first-child,
    .table-fixed td:first-child {
      text-align: left;
      width: 60%;
    }

    .table-fixed th:last-child,
    .table-fixed td:last-child {
      text-align: right;
      width: 40%;
    }
    
    .scroll-wrapper::-webkit-scrollbar {
      width: 6px;
    }

    .scroll-wrapper::-webkit-scrollbar-thumb {
      background-color: #ccc;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <header class="header">
    <img src="images/logo-desenrolai.svg" class="image-logo">
    <i class="fa-solid fa-arrow-right-to-bracket fa-2x" style="color: #000;" onclick="window.location.href='home.php'"></i>
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

    <section class="table-body">
      <table class="table-fixed">
        <thead>
          <tr>
            <th>Mês</th>
            <th>Valor</th>
          </tr>
        </thead>
      </table>

      <div class="scroll-wrapper">
        <table class="table-fixed">
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
        </table>
      </div>

      <table class="table-fixed">
        <tfoot>
          <tr>
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

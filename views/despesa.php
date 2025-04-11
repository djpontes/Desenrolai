<?php
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo '<script>alert("Dados salvos com sucesso!");</script>';
}

require_once '../models/Despesa.php';
session_start();

$usuario_id = $_SESSION['id_usuario'] ?? null;

$despesas = [];

if ($usuario_id) {
    $model = new Despesa();
    $despesas = $model->listarPorUsuario($usuario_id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/despesa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Desenrola.i</title>
</head>
<body>
    <header class="header"> 
        <img src="images/logo-desenrolai.svg" class="image-logo">
        <i class="fa-solid fa-arrow-right-to-bracket fa-2x" style="color: #000;" onclick="window.location.href='home.php'"></i>
    </header>

    <main class="main">
        <section class="table-header">
            <h1>Suas despesas</h1>
        </section>

        <section class="container-main">
            <div class="btn-group">
                <button type="button" id="btnMes" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Escolha um mês
                </button>
                <ul class="dropdown-menu dropdown-menu-scroll">
                    <li><a class="dropdown-item">Janeiro</a></li>
                    <li><a class="dropdown-item">Fevereiro</a></li>
                    <li><a class="dropdown-item">Março</a></li>
                    <li><a class="dropdown-item">Abril</a></li>
                    <li><a class="dropdown-item">Maio</a></li>
                    <li><a class="dropdown-item">Junho</a></li>
                    <li><a class="dropdown-item">Julho</a></li>
                    <li><a class="dropdown-item">Agosto</a></li>
                    <li><a class="dropdown-item">Setembro</a></li>
                    <li><a class="dropdown-item">Outubro</a></li>
                    <li><a class="dropdown-item">Novembro</a></li>
                    <li><a class="dropdown-item">Dezembro</a></li>
                </ul>
            </div>

            <p>E</p>
   
            <div class="btn-group">
                <button type="button" id="btnAno" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Escolha um ano
                </button>
                <ul class="dropdown-menu dropdown-menu-scroll" id="anosLista"></ul>
            </div>

            <div class="btn-filter">
                <button class="btn-filte">Filtrar</button>
            </div>

            <div class="add">
                <i class="fa-solid fa-circle-plus fa-2x" style="color: #aae865;" id="abrirModalAdd" aria-label="Adicionar despesa"></i>
            </div>
        </section>

        <section class="table-body">
        <table class="table table-hover">
            <thead>
                <tr class="col-main">
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($despesas as $despesa) :
                    $total += $despesa['VALOR'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($despesa['DESCRICAO']) ?></td>
                        <td>R$ <?= number_format($despesa['VALOR'], 2, ',', '.') ?></td>
                        <td><?= date('d/m/Y', strtotime($despesa['DATAS'])) ?></td>
                        <td><?= htmlspecialchars($despesa['CATEGORIA']) ?></td>
                        <td>
                            <i class="fas fa-edit fa-lg icon editar" id="abrirModalEdit"></i>
                        </td>
                        <td>
                        <form action="../controllers/DespesaController.php?action=deletar" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta despesa?');" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($despesa['ID_DESPESA']) ?>">
                            <button type="submit" class="btn btn-link p-0 m-0 border-0" style="color: red;">
                                <i class="fas fa-trash-alt fa-lg icon excluir"></i>
                            </button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="col-main">
                    <th>Total</th>
                    <td colspan="5">R$ <?= number_format($total, 2, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
        </section>
    </main>

    <!------ ADICIONAR UMA DESPESA ------->
    <div id="modal-add" class="modal">
        <div class="modal-content">
            <a class="fechar" id="fecharModalAdd">&times;</a><!-- fecha o modal -->

            <div class="text-add">
                <h2>Adicionar despesa</h2>
            </div>
    
            <form class="add-despesa" action="../controllers/DespesaController.php?action=cadastrar" method="POST">
                <input type="text" name="descricao" placeholder="Digite sua despesa..." class="input-despesa" required>
                <!-- Campo visível -->
                <input type="text" name="valor_formatado" placeholder="Digite o valor (ex: 1234,56)" class="input-valor" required oninput="formatarValor(this)">

                <!-- Campo real escondido -->
                <input type="hidden" name="valor" id="valorReal">
                <input type="date" name="data" class="input-data" required/>   
                
                <select name="categoria" class="input-categoria" required>
                    <option value="" disabled selected>Selecione uma categoria</option>
                    <option value="Moradia">Moradia</option>
                    <option value="Alimentação">Alimentação</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Saúde">Saúde</option>
                    <option value="Educação">Educação</option>
                    <option value="Lazer">Lazer</option>
                    <option value="Serviços e Assinaturas">Serviços e Assinaturas</option>
                    <option value="Investimentos">Investimentos</option>
                    <option value="Outro">Outro</option>
                </select>

                <button type="submit" class="form-botao" id="btnAdicionar">Adicionar</button>
            </form>

</div>
    </div>

<!---------- EDITAR UMA DESPESA ---------->
    <div id="modal-edit" class="modal">
    <div class="modal-content">
        <a class="fechar" id="fecharModalEdit">&times;</a><!-- fecha o modal -->

        <div class="text-add">
            <h2>Editar despesa</h2>
        </div>

<form class="edit-despesa">
    <input type="text" placeholder="Bolo de morango" class="input-despesa">
    <input type="text" placeholder="84" class="input-valor" id="valor">
    <input type="date" class="input-data" required/>   
    <input type="text" class="input-observacao" placeholder="Dividido em 3x, proximo vencimento dia 02/06">             
    <button class="form-botao" id="btnEditar">Editar</button>
</form>
</div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="script/despesa.js"></script>

    <script>
    function formatarValor(input) {
        let valor = input.value;

        // Remove tudo que não é número ou vírgula
        valor = valor.replace(/[^\d,]/g, '');

        // Se já tiver mais de uma vírgula, remove a extra
        let partes = valor.split(',');
        if (partes.length > 2) {
            valor = partes[0] + ',' + partes[1];
        }

        input.value = valor;

        // Converte para formato americano
        let valorBanco = valor.replace('.', '').replace(',', '.');
        document.getElementById('valorReal').value = valorBanco;
    }
    </script>

    <script>
        // Abrir o modal de remoção e preencher os dados
        document.querySelectorAll('.open-remove-modal').forEach(icon => {
            icon.addEventListener('click', () => {
                const id = icon.getAttribute('data-id');
                const descricao = icon.getAttribute('data-desc');

                document.getElementById('id-despesa-deletar').value = id;
                document.getElementById('descricao-despesa-remove').textContent = descricao;
                document.getElementById('modal-remove').style.display = 'block';
            });
        });

        // Fechar modal
        document.getElementById('fecharModalRemove').addEventListener('click', () => {
            document.getElementById('modal-remove').style.display = 'none';
        });
        document.getElementById('fecharModalRemoveBtn').addEventListener('click', () => {
            document.getElementById('modal-remove').style.display = 'none';
        });
    </script>

</body>
</html> 
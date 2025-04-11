<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/relatorio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <h1>Relatório da suas despesas</h1>
        </section>

        <section class="container-main">
            <div class="btn-group">
                <button type="button" id="btnAno" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Escolha um ano
                </button>
                <ul class="dropdown-menu dropdown-menu-scroll" id="anosLista"></ul>
            </div>

            <div class="btn-filter">
                <button class="btn-filte">Filtrar</button>
            </div>
        </section>

        <section class="table-body">
            <table class="table table-hover">
                <thead>
                  <tr class="col-main">
                    <th scope="col">Mês</th>
                    <th scope="col">Valor</th>
                  </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Janeiro</td>
                            <td>84</td>
                        </tr>
                        <tr>
                            <td>Fevereiro</td>
                            <td>320</td>
                        </tr>
                        <tr>
                        <tfoot>
                            <tr class="col-main">
                                <th>Total</th>
                                <td>15000</td>
                            </tr>
                        </tfoot>
                    </tbody>
              </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="script/despesa.js"></script>
</body>
</html>
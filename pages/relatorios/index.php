<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet"/>
    <link href="relatorio.css" rel="stylesheet"/>
</head>
<body>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/pages">Início</a></li>
        <li><a class="active" href="/projeto_condominio/pages/relatorios">Relatórios</a></li>
        <li><a href="/projeto_condominio/pages/configuracao">Configuração</a></li>
        <li><a href="/projeto_condominio/pages/adicionar-usuario">Cadastrar</a></li>
        <li><a href="#" id="logout">Sair</a></li>
    </ul>
    <div class="content">
        <div class="card">
            <div class="filters">
                <h3 class="title">RELATORIO MENSAL</h3>
                <form action="" method="">
                    <span>Filtros: </span>
                    <select name="filtro" id="filter">
                        <option value="">Selecione...</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Anual">Anual</option>
                    </select>
                    <button id="filter-btn">Filtrar</button>
                </form>

            </div>
            <table id="resume">
                <thead>
                    <tr>
                        <th>N° casa</th>
                        <th>Consumo agua</th>
                        <th>Valor agua</th>
                        <th>Consumo Energia</th>
                        <th>Valor Energia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>9m³</td>
                        <td>R$ 90</td>
                        <td>1 kw</td>
                        <td>R$ 10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>20m³</td>
                        <td>R$ 200</td>
                        <td>1 kw</td>
                        <td>R$ 10</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>1m³</td>
                        <td>R$ 10</td>
                        <td>8 kw</td>
                        <td>R$ 80</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p>Desenvolvido por ADS/IFSP &copy;<?php echo date('Y'); ?></p>
    </div>
</body>
</html>
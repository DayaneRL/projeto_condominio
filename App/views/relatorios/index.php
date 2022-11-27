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
    <?php 
		require_once "../../../vendor/autoload.php";
        //VERIFICAR SE EXISTE SESSAO E USUARIO
        //SIM = MUDAR MENU E RELATORIOS PRA ID_CASA
        //EXISTE SESSAO E ADMIN = GERAL
	?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a class="active" href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
        <li><a href="/projeto_condominio/app/views/adicionar-usuario">Cadastrar</a></li>
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
                        <th>Mês</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $controller = new \App\controller\relatorioController();
                        foreach($controller->relatorioAguaMensal() as $row){
                            $valor_agua = $row['consumo'] * 3.06;
                            echo '<tr>
                                <td>'.$row['id_casa'].'</td>
                                <td>'.$row['consumo']. ' m³</td>
                                <td> R$ '.$valor_agua.' </td>
                                <td>  '.$row['MES'].' </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
            <br/>
            <table id="resume">
                <thead>
                    <tr>
                        <th>N° casa</th>
                        <th>Consumo Energia</th>
                        <th>Valor Energia</th>
                        <th>Mês</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $controller = new \App\controller\relatorioController();
                        foreach($controller->relatorioEnergiaMensal() as $row){
                            $valor_energia = $row['consumo'] * 0.065;
                            echo '<tr>
                                <td>'.$row['id_casa'].'</td>
                                <td>'.$row['consumo'].' kWh</td>
                                <td> R$ '.$valor_energia.' </td>
                                <td>  '.$row['MES'].' </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p>Desenvolvido por ADS/IFSP &copy;<?php echo date('Y'); ?></p>
    </div>
</body>
</html>
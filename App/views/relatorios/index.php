<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: /projeto_condominio");
        exit;
    }
?>
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
	?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a class="active" href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <?php if($_SESSION['tipo'] === 'Admin'){ ?>
            <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
            <li><a href="/projeto_condominio/app/views/usuarios">Usuários</a></li>
        <?php } ?>
        <li><a href="#" id="logout" onclick="sair()">Sair</a></li>
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
                    <?php
                        $controller = new \App\controller\relatorioController();
                        foreach($controller->relatorioGeral() as $row){
                            $valor_agua = $row['consumo_agua'] * 3.06;
                            $valor_energia = $row['consumo_energia'] * 0.065;
                            echo '<tr>
                                <td>'.$row['id_casa'].'</td>
                                <td>'.$row['consumo_agua']. ' m³</td>
                                <td>R$'.$valor_agua.'</td>
                                <td>'.$row['consumo_energia'].' kWh</td>
                                <td>R$'.$valor_energia.'</td>
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
<script>
    function sair(){
        window.location = '/projeto_condominio';
    }
</script>
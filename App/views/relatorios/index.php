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
        $controller = new \App\controller\relatorioController();
        //VERIFICAR SE EXISTE SESSAO E USUARIO
        //SIM = MUDAR MENU E RELATORIOS PRA ID_CASA
        //EXISTE SESSAO E ADMIN = GERAL
        if(isset($_GET['filtro'])){
            if($_GET['filtro']=="Semanal"){
                $filtro = "Semana";
                $titulo = "semanal";
            }else if($_GET['filtro']=="Anual"){
                $filtro = "Ano";
                $titulo = "Anual";
            }
        }
        if(!isset($_GET['filtro']) || $_GET['filtro']=="Mensal"){
            $filtro = "Mês";
            $titulo = "mensal";
        }

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
                <h3 class="title">RELATORIO 
                    <?php echo mb_strtoupper($titulo, 'UTF-8') ?>
                </h3>
                <form action="" method="GET">
                    <span>Filtros: </span>
                    <select name="filtro" id="filter">
                        <option value="">Selecione...</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Mensal">Mensal</option>
                        <option value="Anual">Anual</option>
                    </select>
                    <button type="submit" id="filter-btn">Filtrar</button>
                </form>
            </div>

            <table class="resume">
                <thead>
                    <tr>
                        <th>N° casa</th>
                        <th><?php echo $filtro ?></th>
                        <th>Consumo agua</th>
                        <th>Valor agua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($filtro=="Semana"){
                            foreach($controller->relatorioAguaSemanal() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                $semana_inicial = substr($row['semana_inicial'], 8, 2).'/'.substr($row['semana_inicial'], 5, 2);
                                $semana_fim = substr($row['semana_fim'], 8, 2).'/'.substr($row['semana_fim'], 5, 2).' ('.substr($row['semana_fim'], 0, 4).')';
    
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:220px">  '.$semana_inicial.' - '.$semana_fim.' </td>
                                    <td>'.$row['consumo']. ' m³</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }else if($filtro=="Ano"){
                            foreach($controller->relatorioAguaAnual() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:120px">  '.$row['ANO'].' </td>
                                    <td>'.$row['consumo']. ' m³</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }else if($filtro=="Mês"){
                            foreach($controller->relatorioAguaMensal() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:120px">  '.$row['MES'].' </td>
                                    <td>'.$row['consumo']. ' m³</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
            <br/>
            <table class="resume">
                <thead>
                    <tr>
                        <th>N° casa</th>
                        <th><?php echo $filtro ?></th>
                        <th>Consumo Energia</th>
                        <th>Valor Energia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($filtro=="Semana"){
                            foreach($controller->relatorioEnergiaSemanal() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                $semana_inicial = substr($row['semana_inicial'], 8, 2).'/'.substr($row['semana_inicial'], 5, 2);
                                $semana_fim = substr($row['semana_fim'], 8, 2).'/'.substr($row['semana_fim'], 5, 2).' ('.substr($row['semana_fim'], 0, 4).')';
    
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:220px">  '.$semana_inicial.' - '.$semana_fim.' </td>
                                    <td>'.$row['consumo']. ' kWh</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }else if($filtro=="Ano"){
                            foreach($controller->relatorioEnergiaAnual() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:120px">  '.$row['ANO'].' </td>
                                    <td>'.$row['consumo']. ' kWh</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }else if($filtro=="Mês"){
                            foreach($controller->relatorioEnergiaMensal() as $row){
                                $valor_agua = $row['consumo'] * 3.06;
                                echo '<tr>
                                    <td style="width:120px">'.$row['id_casa'].'</td>
                                    <td style="width:120px">  '.$row['MES'].' </td>
                                    <td>'.$row['consumo']. ' kWh</td>
                                    <td> R$ '.$valor_agua.' </td>
                                </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p>Desenvolvido por ADS/IFSP &copy; <?php echo date('Y'); ?></p>
    </div>
</body>
</html>
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
    <title>Casas</title>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet"/>
    <link href="casa.css" rel="stylesheet">
    <link href="../configuracao/configuracao.css" rel="stylesheet">
</head>
<body>
    <?php 
		require_once "../../../vendor/autoload.php";
        $controller = new \App\controller\casaController();
    ?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <?php if($_SESSION['tipo'] === 'Admin'){ ?>
            <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
            <li><a href="/projeto_condominio/app/views/casas" class="active" >Casas</a></li>
            <li><a href="/projeto_condominio/app/views/usuarios">Usuários</a></li>
        <?php } ?>
        <li><a href="#" id="logout" onclick="sair()">Sair</a></li>
    </ul>
    <div class="content">
        <div class="row">
            <div class="col-6 col-m-12">
                <div class="card">
                    <h3 class="title">Cadastrar Casa</h3>
                    <?php
                        if (isset($_POST['numero']) && isset($_POST['status_agua']) && isset($_POST['status_energia']) ) {
                            $controller->cadastrar();
                        }else if(isset($_POST['id_casa'])){
                            $controller->delete();
                        }
                    ?>
                    <form action="" method="POST">
                    <div class="row" id="form">
                        <?php if (isset($_SESSION['mensagem_casa'])) { ?>
                            <p id="error"><?php echo $_SESSION['mensagem_casa']; ?></p>
                        <?php 
                        unset($_SESSION['mensagem_casa']);
                        } 
                        ?>

                        <div class="col-12">
                            <label>Número da casa:</label>
                            <input type="number" name="numero" class="form-input" required/>
                        </div>

                        <div class="col-12 form-radio">
                            <label>Água:</label>
                            <input type="radio" id="AguaLigada" name="status_agua" value="1" />
                            <label for="AguaLigada">Ligada</label>

                            <input type="radio" id="AguaDesligada" name="status_agua" value="0" />
                            <label for="AguaDesligada">Desligada</label>
                        </div>
                        
                        <div class="col-12 form-radio">
                            <label>Energia:</label>
                            <input type="radio" id="EnergiaLigada" name="status_energia" value="1" />
                            <label for="EnergiaLigada">Ligada</label>

                            <input type="radio" id="EnergiaDesligada" name="status_energia" value="0" />
                            <label for="EnergiaDesligada">Desligada</label>
                        </div>

                        <button id="send">Enviar</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-6 col-m-12">
                <div class="card">
                    <h3 class="title">Listar Casas</h3>
                    <table class="resume">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Agua</th>
                                <th>Energia</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($controller->show() as $row){
                                echo '
                                    <tr>
                                        <td>'.$row['id_casa'].'</td>
                                        <td>'.(($row['status_agua']==1)?'On':'Off').'</td>
                                        <td>'.(($row['status_energia']==1)?'On':'Off').'</td>
                                        <td id="actions">
                                            <form method="POST">
                                                <input type="hidden" name="id_casa" value="'.$row['id_casa'].'" >
                                                <button class="delete-btn" type="submit">
                                                    <img src="../../images/excluir.png" alt="apagar">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                ';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
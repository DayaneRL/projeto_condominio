<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: /projeto_condominio");
        exit;
    }
    elseif($_SESSION['tipo'] === 'Usuario'){
        header("Location: /projeto_condominio/App/views");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
    <link href="usuario.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9cd7366f7c.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
		require_once "../../../vendor/autoload.php";
	?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
        <li><a href="/projeto_condominio/app/views/casas">Casas</a></li>
        <li><a href="/projeto_condominio/app/views/usuarios" class="active">Usuários</a></li>
        <li><a href="#" id="logout" onclick="sair()">Sair</a></li>
    </ul>
        <div class="content row">
            <div class="card col-12 col-md-6">
                <h3 class="title">Cadastrar Usuario</h3>
    
                <?php
                    $controller = new \App\controller\usuarioController();
                    if (isset($_POST['userIdU'])) {
                        $datas = $controller->edit();
                    }
                    
                    if(isset($_POST['update'])){
                        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['numero'])) {
                            if($_POST['senha'] == "" && $_POST['confirmar-senha'] == ""){
                                $_POST['senha'] = $datas['senha'];
                                $_POST['confirmar-senha'] = $datas['senha'];
                            }
                            echo $controller->update();
                        }
                    }else{
                        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['numero']) && isset($_POST['senha']) && isset($_POST['confirmar-senha'])) {
                            $controller->store();
                        }
                    }
                ?>
    
                <form action="" method="POST">
                    <div class="row" id="usuario-form">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <p id="login-error"><?php echo $_SESSION['message']; ?></p>
                        <?php } ?>

                        <div class="col-12">
                            <label>Nome:</label>
                            <input type="text" name="nome" value="<?php 
                                if(isset($datas['nome'])){
                                    echo $datas['nome'];
                                }
                            ?>" required/>
                        </div>
                        <div class="col-12">
                            <label>Email:</label>
                            <input type="email" name="email" value="<?php 
                                if(isset($datas['email'])){
                                    echo $datas['email'];
                                }
                            ?>" required/>
                        </div>
                        <div class="col-12">
                            <label for="houses">Número da casa:</label>
                            <select name="numero" id="houses">
                                <?php 
                                    if(isset($datas['nome'])){
                                        echo '<option value="'.$datas['id_casa'].'">'.$datas['id_casa'].'</option>';
                                        $houses = $controller->getAvailableHouse();
                                        foreach($houses as $house){
                                            echo '<option value="'.$house['id_casa'].'">'.$house['id_casa'].'</option>';
                                        }
                                    }else{
                                        $houses = $controller->getAvailableHouse();
                                        foreach($houses as $house){
                                            echo '<option value="'.$house['id_casa'].'">'.$house['id_casa'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label>Senha:</label>
                            <?php if(isset($_POST['userIdU'])){
                                echo '<input type="password" name="senha" />';
                            }else{
                                echo '<input type="password" name="senha" required/>';
                            } ?>
                        </div>
                        <div class="col-12">
                            <label>Confirmar senha:</label>
                            <?php if(isset($_POST['userIdU'])){
                                echo '<input type="password" name="confirmar-senha"/>';
                            }else{
                                echo '<input type="password" name="confirmar-senha" required/>';
                            } ?>
                        </div>
                        <?php if (isset($_POST['userIdU'])){ ?>
                            <input type="hidden" value="update" name="update">
                        <?php 
                            if(isset($datas['id'])){
                                echo '<input type="hidden" name="userId" value="'.$datas['id'].'" >';
                            }
                        } ?>
                        <button id="send">Enviar</button>
                    </div>
                </form>
            </div>
    
            <div class="card card col-12 col-md-6">
                <h3 class="title">Listar Usuario</h3>
                <table id="resume">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_POST['userIdR'])) {
                                $controller->delete();
                                exit;
                            }
                            
                            foreach($controller->show() as $row){
                                echo '
                                    <tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['nome'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td id="actions">
                                            <div id="remove">
                                                <form method="POST">
                                                    <input type="hidden" class="userId" name="userIdR" value="'.$row['id'].'" >
                                                    <button type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div id="update">
                                                <form method="POST">
                                                    <input type="hidden" class="userId" name="userIdU" value="'.$row['id'].'" >
                                                    <button type="submit">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                ';
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
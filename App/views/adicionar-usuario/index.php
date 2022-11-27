<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: /projeto_condominio");
        exit;
    }
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_tipo']) && $_SESSION['user_tipo']=="Admin"){
        $admin = true;
    }else{
        $admin = false;
        if($_SESSION['user_tipo']=="Usuario"){
            header("Location: /projeto_condominio/app/views");
            exit;
        }
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
    <link href="adicionar-usuario.css" rel="stylesheet">
</head>
<body>
    <?php 
		require_once "../../../vendor/autoload.php";
	?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <?php
            if($admin){
        ?>
        <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
        <li><a href="/projeto_condominio/app/views/adicionar-usuario" class="active">Cadastrar</a></li>
        <?php
            }
        ?>
        <li><a href="#" id="logout" onclick="sair()">Sair</a></li>
    </ul>
    <div class="content">
        <div class="card">
            <h3 class="title m-0">Cadastrar Usuario</h3>

            <?php
                $controller = new \App\controller\usuarioController();
                if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['numero']) && isset($_POST['senha']) && isset($_POST['confirmar-senha'])) {
                    $controller->store();
                }
            ?>

            <form action="" method="POST">
            <div class="row" id="usuario-form">
                <?php if (isset($_SESSION['message'])) { ?>
                    <p id="login-error"><?php echo $_SESSION['message']; ?></p>
                <?php } ?>

                <div class="col-12">
                    <label>Nome:</label>
                    <input type="text" name="nome" required/>
                </div>
                <div class="col-12">
                    <label>Email:</label>
                    <input type="email" name="email" required/>
                </div>
                <div class="col-12">
                    <label>Número da casa:</label>
                    <input type="number" name="numero" required/>
                </div>
                <div class="col-12">
                    <label>Senha:</label>
                    <input type="password" name="senha" required/>
                </div>
                <div class="col-12">
                    <label>Confirmar senha:</label>
                    <input type="password" name="confirmar-senha" required/>
                </div>
                <button id="send">Enviar</button>
            </div>
            </form>
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
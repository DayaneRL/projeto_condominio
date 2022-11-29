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
    <title>Home</title>
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet"/>
</head>
<body>
    <ul class="sidenav">
        <li><a class="active" href="/projeto_condominio/app/views">Início</a></li>
        <li><a href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <?php if($_SESSION['tipo'] === 'Admin'){ ?>
            <li><a href="/projeto_condominio/app/views/configuracao">Configuração</a></li>
            <li><a href="/projeto_condominio/app/views/usuarios">Usuários</a></li>
        <?php } ?>
        <li><a href="#" id="logout" onclick="sair()">Sair</a></li>
    </ul>
    <div class="content">
        <div class="row">
            <div class="col-6 col-m-12">
                <div class="card">
                    <div class="center">
                        <img src="../images/report.png" alt="relatorio icon" />
                    </div>
                    <p class="title">Acessar relatorios mensais, semanais e anuais.</p>
                    <a href="/projeto_condominio/app/views/relatorios">VER relatorios</a>
                </div>
            </div>
            <?php if($_SESSION['tipo'] === 'Admin'){ ?>
                <div class="col-3 col-m-6">
                    <div class="card">
                        <div class="center">
                            <img src="../images/gear.png" alt="relatorio icon" />
                        </div>
                        <p class="title">Acessar configuração.</p>
                        <a href="/projeto_condominio/app/views/configuracao">Acessar</a>
                    </div>
                </div>
                <div class="col-3 col-m-6">
                    <div class="card">
                        <div class="center">
                            <img src="../images/add-user.png" alt="relatorio icon" />
                        </div>
                        <p class="title">Acessar gerenciamento de usuários.</p>
                        <a href="/projeto_condominio/app/views/usuarios">acessar</a>
                    </div>
                </div>
            <?php } ?>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
    <link href="../css/styles.css" rel="stylesheet"/>
    <link href="../css/responsive.css" rel="stylesheet"/>
    <link href="configuracao.css" rel="stylesheet"/>
</head>
<body>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/views">Início</a></li>
        <li><a href="/projeto_condominio/views/relatorios">Relatórios</a></li>
        <li><a class="active" href="/projeto_condominio/views/configuracao">Configuração</a></li>
        <li><a href="/projeto_condominio/views/adicionar-usuario">Cadastrar</a></li>
        <li><a href="#" id="logout">Sair</a></li>
    </ul>
    <div class="content">
        <div class="row">
            <div class="col-4 col-m-12">
                <div class="card">
                    <div class="img">
                        <img src="../../images/home.png" alt="casa" />
                    </div>
                    <h4 class="title">Casa 1</h4>
                    <div class="img">
                        <span>Valvula: </span>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-12">
                <div class="card">
                    <div class="img">
                        <img src="../../images/home.png" alt="casa" />
                    </div>
                    <h4 class="title">Casa 2</h4>
                    <div class="img">
                        <span>Valvula: </span>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-12">
                <div class="card">
                    <div class="img">
                        <img src="../../images/home.png" alt="casa" />
                    </div>
                    <h4 class="title">Casa 3</h4>
                    <div class="img">
                        <span>Valvula: </span>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Desenvolvido por ADS/IFSP &copy;<?php echo date('Y'); ?></p>
    </div>
</body>
</html>
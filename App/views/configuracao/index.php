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
    <?php 
		require_once "../../../vendor/autoload.php";
        $controller = new \App\controller\configuracaoController();
    ?>
    <ul class="sidenav">
        <li><a href="/projeto_condominio/app/views">Início</a></li>
        <li><a href="/projeto_condominio/app/views/relatorios">Relatórios</a></li>
        <li><a href="/projeto_condominio/app/views/configuracao" class="active">Configuração</a></li>
        <li><a href="/projeto_condominio/app/views/adicionar-usuario">Cadastrar</a></li>
        <li><a href="#" id="logout">Sair</a></li>
    </ul>
    <div class="content">
        <div class="row">
            <?php
                foreach($controller->read() as $row){
                    echo "
                    <div class='col-4 col-m-12'>
                        <div class='card'>
                            <div class='row'>
                                <div class='col-5'>
                                    <div class='center'>
                                        <img src='../../images/home.png' alt='casa' />
                                    </div>
                                </div>
                                <div class='col-7'>
                                    <h4 class='title m-0'>Casa ".$row['id_casa']."</h4>
                                    <input type='hidden' class='id_casa' value='".$row['id_casa']."'/>
                                    <div class='row mt-1'>
                                        <div class='col-12 center'>
                                            <span class='desc'>Agua: </span>
                                            <label class='switch'>";
                                                if($row['status_agua']==1){
                                                    echo "<input type='checkbox' name='status_agua' checked>";
                                                }else{
                                                    echo "<input type='checkbox' name='status_agua'>";
                                                }
                                                echo "<span class='slider round'></span>
                                            </label>
                                        </div>
                                        <br/>
                                        <div class='col-12 center mt-1'>
                                            <span class='desc'>Energia: </span>
                                            <label class='switch'>";
                                                if($row['status_energia']==1){
                                                    echo "<input type='checkbox' name='status_energia' checked>";
                                                }else{
                                                    echo "<input type='checkbox' name='status_energia'>";
                                                }
                                                echo "<span class='slider round'></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            ?> 
        </form>
    </div>
    <div class="footer">
        <p>Desenvolvido por ADS/IFSP &copy;<?php echo date('Y'); ?></p>
    </div>
</body>
<script src="../js/jquery-3.6.1.min.js"></script>
<script>
    $(document).on('change','input[type="checkbox"]', function(){
        let id_casa = $(this).parents('.card').find('.id_casa').val();
        let status_agua = $(this).parents('.card').find('input[name="status_agua"]').is(':checked')?1:0;
        let status_energia = $(this).parents('.card').find('input[name="status_energia"]').is(':checked')?1:0;

        $.ajax({
            type: "POST",
            url: '../../services/alterarStatusCasa.php',
            data: {id_casa, status_energia, status_agua},
        });
    })
</script>
</html>
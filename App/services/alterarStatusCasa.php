<?php
    require_once "../../vendor/autoload.php";
    $controller = new \App\controller\configuracaoController();
    $controller->update($_POST['id_casa'], $_POST['status_energia'], $_POST['status_agua']);
?>
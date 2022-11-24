<?php

namespace App\model;
class Conexao{

    private static $instance;

    public static function getConexao(){
        if(!isset(self::$instance)){
            self::$instance = new \PDO('mysql:host=localhost;dbname=projeto_condominio;charset=utf8', 'root', '');
        }
        return self::$instance;
        
    }
}
?>
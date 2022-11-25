<?php

    namespace App\controller;

    class usuarioController{
        public function login(){
            $email = $_POST['username'];
            $senha = $_POST['pass'];
            
            $sql = "SELECT * FROM usuario WHERE email='$email';";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->execute();
            
            $usuario = $tmp->fetchAll(\PDO::FETCH_ASSOC);

            if($email == null || $senha == null){
                session_start();
                $_SESSION['error'] = "Usuário ou senha não preenchidos";
                return false;
            }

            if(isset($usuario[0]['email'])){
                if(($usuario[0]['email'] == $email) && ($usuario[0]['senha'] == $senha)){
                    header("Location: /projeto_condominio/app/views");
                    exit;
                }else{
                    session_start();
                    $_SESSION['error'] = "Usuário ou senha invalido";
                    return false;
                }
            }else{
                session_start();
                $_SESSION['error'] = "Usuário ou senha invalido";
                return false;
            }
        }
    }
?>
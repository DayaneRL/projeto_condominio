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
                $_SESSION['error'] = "Usuário ou senha não preenchidos";
                return false;
            }

            if(isset($usuario[0]['email'])){
                if(($usuario[0]['email'] == $email) && ($usuario[0]['senha'] == $senha)){
                    session_unset();
                    $_SESSION['user_id'] = $usuario[0]['id'];
                    header("Location: /projeto_condominio/app/views");
                    exit;
                }else{
                    
                    $_SESSION['error'] = "Usuário ou senha invalido";
                    return false;
                }
            }else{
                
                $_SESSION['error'] = "Usuário ou senha invalido";
                return false;
            }
        }
    }
?>
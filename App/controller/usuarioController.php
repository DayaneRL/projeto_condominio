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
                header("Location: /projeto_condominio/?error=Usuário ou senha não preenchidos");
                exit;
            }

            if(isset($usuario[0]['email'])){
                if($usuario[0]['email'] == $email){
                    header("Location: /projeto_condominio/app/views");
                    exit;
                }else{
                    header("Location: /projeto_condominio/?error=Usuário ou senha invalido");
                    exit;
                }
            }else{
                header("Location: /projeto_condominio/?error=Não encontrado no banco");
                exit;
            }
        }
    }
?>
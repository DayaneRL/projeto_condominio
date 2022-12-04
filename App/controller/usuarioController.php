<?php

    namespace App\controller;

    class usuarioController{
        public function login(){
            $u = new \App\model\Usuario;

            $u->setEmail($_POST['username']);
            $u->setSenha($_POST['pass']);
            
            $sql = "SELECT * FROM usuario WHERE email=:email;";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->bindValue(':email', $u->getEmail());
            $tmp->execute();
            
            // ADICIONA O RESULTADO DA CONSULTA EM UM ARRAY
            $usuario = $tmp->fetch(\PDO::FETCH_ASSOC);

            // VALIDA SE OS CAMPOS FORAM PREENCHIDOS
            if($u->getEmail() == null || $u->getSenha() == null){
                $_SESSION['error'] = "Usuário ou senha não preenchidos";
                return false;
            }

            // SE HOUVE RETORNO DO BANCO ? (VALIDA CAMPOS ? ENTRAR : RETORNA ERRO) : RETORNA ERRO
            if(isset($usuario['email'])){
                if(($usuario['email'] == $u->getEmail()) && 
                (hash('sha256', ($u->getSenha(). $u->getSalt())) == $usuario['senha'])
            ){
                    session_unset();
                    $_SESSION['user_id'] = $usuario['id'];
                    $_SESSION['user_id_casa'] = $usuario['id_casa'];
                    $_SESSION['tipo'] = $usuario['tipo'];
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

        public function store(){            
            $u = new \App\model\Usuario;

            $u->setNome($_POST['nome']);
            $u->setIdCasa($_POST['numero']);
            $u->setEmail($_POST['email']);
            $u->setSenha($_POST['senha']);

            if($u->getSenha() != $_POST['confirmar-senha']){
                $_SESSION['message'] = "Senhas devem ser identicas!!!";
                return false;
            }
            
            try{
                $sql = "INSERT INTO usuario (nome, id_casa, tipo, email, senha) VALUES (?,?,?,?,?)";
                $tmp = \App\model\Conexao::getConexao()->prepare($sql);
                $tmp->bindValue(1, $u->getNome());
                $tmp->bindValue(2, $u->getIdCasa());
                $tmp->bindValue(3, 'Usuario');
                $tmp->bindValue(4, $u->getEmail());
                $tmp->bindValue(5, hash('sha256', ($u->getSenha(). $u->getSalt())));
                $tmp->execute();

                $_SESSION['message'] = null;
                header("Location: /projeto_condominio/app/views/usuarios");
            } catch(\PDOException $error){
                $_SESSION['message'] = "Erro no cadastro!!!";
                return false;
            }
        }

        public function show(){
            $sql = "SELECT id, nome, email FROM usuario WHERE tipo != 'Admin'";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->execute();

            if($tmp->rowCount() > 0){
                $result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            }
            return[];
        }

        public function delete(){
            $sql = "DELETE FROM usuario WHERE id = ?";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->bindValue(1, $_POST['userIdR']);
            $tmp->execute();

            header("Location: /projeto_condominio/app/views/usuarios");
        }

        public function edit(){
            $sql = "select * from usuario where id = ?";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->bindValue(1, $_POST['userIdU']);
            $tmp->execute();

            if($tmp->rowCount() > 0){
                $result = $tmp->fetch(\PDO::FETCH_ASSOC);
                return $result;
            }
            return[];
        }

        public function update(){
            echo 'DEU CERTO :)';
            // $u = new \App\model\Usuario;

            // $sql = "update cliente set CPF_Cliente=:cpf_cliente, Nome_Cliente=:nome where ID_Cliente=:id;";
        }

        public function getAvailableHouse(){
            $sql = "SELECT id_casa FROM casa WHERE id_casa NOT IN (SELECT id_casa FROM usuario)";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->execute();

            if($tmp->rowCount() > 0){
                $result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            }
            return[];
        }
    }
?>
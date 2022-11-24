<?php
    include 'conexao.php';

    $email = $_GET['username'];

    try{
        $conexao = new PDO($dns,$user,$pass);
        
        $query = "SELECT * FROM usuario WHERE email='$email';";

        $stmt = $conexao->prepare($query);
        $stmt->execute();
        
        //Salva o resultado em um array
        $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($email == null){
            header("Location: /projeto_condominio/?error=Usuário ou senha não preenchidos");
            exit;
        }

        if(isset($usuario[0]['email'])){
            if($usuario[0]['email'] == $email){
                header("Location: /projeto_condominio/pages");
                exit;
            }else{
                header("Location: /projeto_condominio/?error=Usuário ou senha invalido");
                exit;
            }
        }else{
            header("Location: /projeto_condominio/?error=Não existe");
            exit;
        }

    } catch(PDOException $error){
        echo "Error: ".$error->getMessage();
    }

?>
<?php

    namespace App\controller;

    class casaController{
        public function cadastrar(){
            if (isset($_POST['numero']) && isset($_POST['status_agua']) && isset($_POST['status_energia']) ) {
                $id_casa = $_POST['numero'];
                $status_agua = $_POST['status_agua'];
                $status_energia = $_POST['status_energia'];

                $sql = "INSERT INTO casa (id_casa, status_agua, status_energia)
                    VALUES ($id_casa, $status_agua, $status_energia)";

                $tmp = \App\model\Conexao::getConexao()->prepare($sql);
                $tmp->execute();
            }else{
                $_SESSION['message'] = 'Preencha todos os campos';
            }
        }

        public function show(){
            $sql = "SELECT id_casa FROM casa";
            $tmp = \App\model\Conexao::getConexao()->prepare($sql);
            $tmp->execute();

            if($tmp->rowCount() > 0){
                $result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            }
            return[];
        }

        public function delete(){

        }
    }
?>
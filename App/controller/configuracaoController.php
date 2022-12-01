<?php
	namespace App\controller;
	
class configuracaoController{

    public function read(){
        $sql = "SELECT * FROM casa order by id_casa";
        $tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];
    }	

    public function update($id_casa, $status_energia, $status_agua){
		$sql = "UPDATE casa SET status_energia=$status_energia, status_agua=$status_agua WHERE id_casa = $id_casa";
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();
	}

}

?>
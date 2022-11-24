<?php
	namespace App\controller;
	
class relatorioController{

	public function read(\App\model\Relatorio $r){
		$sql = "select a.id_casa, a.quant_consumo as consumo_agua, b.quant_consumo as consumo_energia 
        from agua a 
        inner join energia b on a.id_casa = b.id_casa
        where a.id_casa=?";
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
        $tmp->bindValue(1, $r->getNumeroCasa());
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	
	
	public function relatorioGeral(){
		$sql = "select a.id_casa, a.quant_consumo as consumo_agua, b.quant_consumo as consumo_energia 
        from agua a 
        inner join energia b on a.id_casa = b.id_casa";
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	

    public function update(\App\model\Relatorio $r){
		$sql = "update usuario set nome=?, idade=? where id =?";
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		// $tmp->bindValue(1, $p->getNome());
		// $tmp->bindValue(2, $p->getIdade());
		// $tmp->bindValue(3, $p->getId());
		$tmp->execute();
	}

}

?>
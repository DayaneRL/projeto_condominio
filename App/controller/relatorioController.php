<?php
	namespace App\controller;
	
class relatorioController{
	
	public function relatorioAguaMensal($id=null){
		if($id){//id_casa
			$sql = "SELECT a.id_casa, a.valor as consumo, MONTH(a.data) as MES
			FROM agua_media a where id_casa = $id
			GROUP BY a.ID_casa, YEAR(a.data), MONTH(a.data)
			ORDER BY MES";
		}else{//geral
			$sql = "SELECT a.id_casa, a.valor as consumo, MONTH(a.data) as MES
				FROM agua_media a
				GROUP BY a.ID_casa, YEAR(a.data), MONTH(a.data)
				ORDER BY MES";
		}
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	

	public function relatorioEnergiaMensal($id=null){
		if($id){
			$sql = "SELECT a.id_casa, a.valor as consumo, MONTH(a.data) as MES
					FROM energia_media a where id_casa = $id
					GROUP BY a.ID_casa, YEAR(a.data), MONTH(a.data)
					ORDER BY MES";
		}else{
			$sql = "SELECT a.id_casa, a.valor as consumo, MONTH(a.data) as MES
					FROM energia_media a
					GROUP BY a.ID_casa, YEAR(a.data), MONTH(a.data)
					ORDER BY MES";
		}
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	

	public function relatorioAguaAnual($id=null){
		if($id){
			$sql = "SELECT a.id_casa, SUM(a.valor) as consumo, YEAR(a.data) AS ANO
				FROM agua_media a where id_casa = $id
				GROUP BY a.ID_casa, YEAR(a.data)
				order by ANO";
		}else{
			$sql = "SELECT a.id_casa, SUM(a.valor) as consumo, YEAR(a.data) AS ANO
				FROM agua_media a
				GROUP BY a.ID_casa, YEAR(a.data)
				order by ANO";
		}
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	
	
	public function relatorioEnergiaAnual($id=null){
		if($id){
			$sql = "SELECT a.id_casa, SUM(a.valor) as consumo, YEAR(a.data) AS ANO
				FROM energia_media a where id_casa = $id
				GROUP BY a.ID_casa, YEAR(a.data)
				order by ANO";
		}else{
			$sql = "SELECT a.id_casa, SUM(a.valor) as consumo, YEAR(a.data) AS ANO
				FROM energia_media a
				GROUP BY a.ID_casa, YEAR(a.data)
				order by ANO";
		}
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}	

	public function relatorioEnergiaSemanal($id=null){
		if($id){
			$sql = "SELECT a.id_casa, sum(a.valor) as consumo, YEAR(a.data) as ano,
			DATE_ADD(a.data, INTERVAL(1-DAYOFWEEK(a.data)) DAY) as semana_inicial,
			DATE_ADD(a.data, INTERVAL(7-DAYOFWEEK(a.data)) DAY) as semana_fim
			FROM energia_media a where id_casa = $id
			GROUP BY a.ID_casa, WEEK(a.data)
			ORDER BY WEEK(a.data)";
		}else{
			$sql = "SELECT a.id_casa, sum(a.valor) as consumo, YEAR(a.data) as ano,
			DATE_ADD(a.data, INTERVAL(1-DAYOFWEEK(a.data)) DAY) as semana_inicial,
			DATE_ADD(a.data, INTERVAL(7-DAYOFWEEK(a.data)) DAY) as semana_fim
			FROM energia_media a 
			GROUP BY a.ID_casa, WEEK(a.data)
			ORDER BY WEEK(a.data)";
		}
		$tmp = \App\model\Conexao::getConexao()->prepare($sql);
		$tmp->execute();

		if($tmp->rowCount() > 0){
			$result = $tmp->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}
		return[];	
	}
	
	public function relatorioAguaSemanal($id=null){
		if($id){
			$sql = "SELECT a.id_casa, sum(a.valor) as consumo, YEAR(a.data) as ano,
			DATE_ADD(a.data, INTERVAL(1-DAYOFWEEK(a.data)) DAY) as semana_inicial,
			DATE_ADD(a.data, INTERVAL(7-DAYOFWEEK(a.data)) DAY) as semana_fim
			FROM agua_media a where id_casa = $id
			GROUP BY a.ID_casa, WEEK(a.data)
			ORDER BY WEEK(a.data)";
		}else{
			$sql = "SELECT a.id_casa, sum(a.valor) as consumo, YEAR(a.data) as ano,
			DATE_ADD(a.data, INTERVAL(1-DAYOFWEEK(a.data)) DAY) as semana_inicial,
			DATE_ADD(a.data, INTERVAL(7-DAYOFWEEK(a.data)) DAY) as semana_fim
			FROM agua_media a 
			GROUP BY a.ID_casa, WEEK(a.data)
			ORDER BY WEEK(a.data)";
		}
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
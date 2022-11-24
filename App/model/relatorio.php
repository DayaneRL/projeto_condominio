<?php

	namespace App\model;
	class Relatorio{
		protected $id;
		private $numero_casa;
		private $valor_agua;
		private $consumo_agua;
		private $valor_energia;
		private $consumo_energia;

		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}

		public function getNumeroCasa(){
			return $this->numero_casa;
		}
		public function setNumeroCasa($numero){
			$this->numero_casa = $numero;
		}

		public function getValorAgua(){
			return $this->valor_agua;
		}
		public function setValorAgua($valor){
			$this->valor_agua = $valor;
		}

		public function getConsumoAgua(){
			return $this->consumo_agua;
		}
		public function setConsumoAgua($consumo){
			$this->consumo_agua = $consumo;
		}
		
        public function getValorEnergia(){
			return $this->valor_energia;
		}
		public function setValorEnergia($valor){
			$this->valor_energia = $valor;
		}

        public function getConsumoEnergia(){
			return $this->consumo_energia;
		}
		public function setConsumoEnergia($consumo){
			$this->consumo_energia = $consumo;
		}
	}

	
?>
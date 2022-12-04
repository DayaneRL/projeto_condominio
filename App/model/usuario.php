<?php
    namespace App\model;
	class Usuario{
		protected $id;
		private $nome;
		private $id_casa;
		private $tipo;
		private $email;
		private $senha;
		private $salt= "UKDH9H2965pYRlU";

        public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}

		public function getSalt(){
			return $this->salt;
		}

        public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}

        public function getIdCasa(){
            return $this->id_casa;
        }
        public function setIdCasa($id_casa){
            $this->id_casa = $id_casa;
        }

        public function getTipo(){
			return $this->tipo;
		}
		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

        public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

        public function getSenha(){
			return $this->senha;
		}
		public function setSenha($senha){
			$this->senha = $senha;
		}
    }

?>
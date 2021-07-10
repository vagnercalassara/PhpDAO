<?php 

	class Usuario 
	{

		private $id_usuario;
		private $tipo_usuario;
		private $email_usuario;
		private $senha_usuario;
		private $status_usuario;

		public function getId_Usuario(){
			return $this->id_usuario;
		}
		public function setId_Usuario($value){
			return $this->id_usuario = $value;
		}
		public function getTipo_Usuario(){
			return $this->tipo_usuario;
		}
		public function setTipo_Usuario($value){
			return $this->tipo_usuario = $value;
		}
		public function getEmail_Usuario(){
			return $this->email_usuario;
		}
		public function setEmail_Usuario($value){
			return $this->email_usuario = $value;
		}
		public function getSenha_Usuario(){
			return $this->senha_usuario;
		}
		public function setSenha_Usuario($value){
			return $this->senha_usuario = $value;
		}
		public function getStatus_Usuario(){
			return $this->status_usuario;
		}
		public function setStatus_Usuario($value){
			return $this->status_usuario = $value;
		}	

		public function setData($data)
		{
			$this->setTipo_Usuario($data['tipo_usuario']);
			$this->setId_Usuario($data['id_usario']);
			$this->setEmail_Usuario($data['email_usuario']);
			$this->setSenha_Usuario($data['senha_usuario']);
			$this->setStatus_Usuario($data['status_usuario']);		
		}

		// Inserção do usuário no banco..
		public function Insert()
		{
			$Sql = new SQL();

			$resultado = $Sql->select("call sp_usuario_insert(:TIPO_USUARIO,:EMAIL_USUARIO,:SENHA_USUARIO,:STATUS_USUARIO)",
							array(
									":TIPO_USUARIO"=>$this->getTipo_Usuario(),
									":EMAIL_USUARIO"=>$this->getEmail_Usuario(),
									":SENHA_USUARIO"=>$this->getSenha_Usuario(),
									":STATUS_USUARIO"=>$this->getStatus_Usuario()
								));

			// Verificação se existe informação..
			if (isset($resultado[0])) {				
				$this->setData($resultado[0]);				
			}
		}

		public function Update()
		{
			$Sql = new SQL();

			$Sql->query("UPDATE TB_USUARIO SET EMAIL_USUARIO =:EMAIL_USUARIO, SENHA_USUARIO = :SENHA_USUARIO WHERE ID_USARIO = :ID_USARIO", array(
						"EMAIL_USUARIO"=>$this->getEmail_Usuario(),
						"SENHA_USUARIO"=>$this->getSenha_Usuario(),
						"ID_USARIO"=>$this->getId_Usuario()
					));
		}

		public function delete()
		{
			$Sql = new SQL();

			$Sql->query("DELETE FROM TB_USUARIO WHERE ID_USARIO = :ID_USARIO", array(
						"ID_USARIO"=>$this->getId_Usuario()
						));
		}


		//Lista o usuário pelo id...
		public function loadById($id){
			
			// Classe responsavel por fazer os comando ao banco..
			$SQL = new SQL();

			// Resultado do select...
			$resultado = $SQL->select("SELECT * FROM TB_USUARIO WHERE ID_USARIO = :ID_USARIO", array(":ID_USARIO"=>$id));

			// Verificação se existe informação..
			if (isset($resultado[0]))
			{
				$this->setData($resultado[0]);							
			}
		}

		// Lista de todos usuários cadastrados...
		public function getList(){

			// Classe responsavel por fazer os comando no banco...
			$Sql = new SQL();

			// Retorno do select
			return $Sql->select("SELECT * FROM TB_USUARIO ORDER BY ID_USARIO");
		}

		// lista usuario pelo login..
		public function search($login)
		{
			// Classe responsave por fazer os comando no banco...
			$Sql = new SQL();

			// retorno do select...
			return $Sql->select("SELECT * FROM TB_USUARIO WHERE EMAIL_USUARIO LIKE :SEARCH", array(
				":SEARCH"=>"%".$login."%"
				));
		}

		public function login($login,$senha)
		{

			$Sql = new SQL();

			$resultado = $Sql->select("SELECT * FROM TB_USUARIO WHERE EMAIL_USUARIO =:EMAIL_USUARIO AND SENHA_USUARIO =:SENHA_USUARIO",
										array(
										":EMAIL_USUARIO"=>$login,
										":SENHA_USUARIO"=>$senha
									 ));

			if (count($resultado) > 0)
			{				
				$this->setData($resultado[0]);
			}
			else 
			{
				throw new Exception("Login ou senha inválidos.");				
			}
		}


		// Construtor responsavel por gerar o json...
		public function __toString(){
			return json_encode(array(
				"ID_USUARIO"=>$this->getId_Usuario(),
				"TIPO_USUARIO"=>$this->getTipo_Usuario(),
				"EMAIL_USUARIO"=>$this->getEmail_Usuario(),
				"SENHA_USUARIO"=>$this->getSenha_Usuario(),
				"STATUS_USUARIO"=>$this->getStatus_Usuario(),
				"DATA_GERACAO"=>date("d/m/Y H:i:s" )
			));
		}
	}
 ?>
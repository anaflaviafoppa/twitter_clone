<?php

	class db {
		//host

		private $host = 'localhost';

		//usuario
		private $usuario = 'root'; 

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'twitter_clone';

		public function conecta_mysql (){

			//criar a conexao
			//mysqli_connect(local do banco de dados, usuario de acesso, senha, banco de dados);

			$con = mysqli_connect($this->host,$this->usuario,$this->senha,$this->database);
			//ajustar o charset de comunicacao entre a aplicação e o banco de dados
			mysqli_set_charset($con, 'utf8');

			//verificar se houve erro de conexao no banco de dados

			if(mysqli_connect_errno()){
				echo 'Erro ao tentar se conectar com o BD MySQL: '.mysqli_connect_error();
			}

			return $con;
		}
	}

?>
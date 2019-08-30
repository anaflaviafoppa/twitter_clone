<?php

	require_once('db.class.php');

	$usuario = $_POST['usuario']; //não fica exposto na url usando o POST
	
	$email =  $_POST['email'];

	//criptografar a informação:
	
	$senha = md5($_POST['senha']);

	$objDb = new db();
	$link = $objDb->conecta_mysql();


	$usuario_existe = false;
	$email_existe = false;

	//verificar se o usuário já existe

	$sql = "select * from usuarios WHERE usuario = '$usuario'";
	//consulta no banco de dados:
	if($resultado_id = mysqli_query($link,$sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['usuario'])){
			$usuario_existe = true;
		} 

	} else {
		echo 'Erro ao tentar localizar o registro do usuário';
	}



	//verificar se o e-mail já existe


	$sql = "select * from usuarios WHERE email = '$email'";
	//consulta no banco de dados:
	if($resultado_id = mysqli_query($link,$sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 

	} else {
		echo 'Erro ao tentar localizar o registro do email';
	}

	if($email_existe || $usuario_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get.="erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get.="erro_email=1&";
		}


		//redirecionamento da página - ? é um delimetador
		header('Location: inscrevase.php?'.$retorno_get);
		//INTERROMPER O SCRIPT para não cadastrar no database
		die();
	}

	$sql = "insert into usuarios(usuario, email, senha) values('$usuario','$email','$senha')";

	//executar a query
	if(mysqli_query($link,$sql)){
		echo 'Usuario registrado com sucesso';
	} else{
		echo 'Erro ao registrar o usuario!';
	}


?>
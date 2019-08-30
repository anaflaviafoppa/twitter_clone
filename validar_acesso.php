

<?php

	//bloquear o acesso caso o processo de logar não seja efetuado. - primeira instrução do script

	session_start();

    require_once('db.class.php');

    $usuario = $_POST['usuario'];
    //voltar com a senha criptografada
    $senha = md5($_POST['senha']);

    //consulta no banco de dados, escrever na área do Mysql do SQL

    $sql = "SELECT id,usuario,email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){

    	//valida SE o processo de consulta está correto e não se existe ou não no banco de dados

        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['usuario'])){

        //recupera os dados do database:
            $_SESSION['id_usuario'] = $dados_usuario['id'];
        	$_SESSION['usuario'] = $dados_usuario['usuario'];
        	$_SESSION['email'] = $dados_usuario['email'];
        	header('Location: home.php');
        	
        } else{
        	header('Location: index.php?erro=1');
        }

    }else{
        
        echo "Erro na execução da consulta, favor entrar em contato com o admin do site";

    }

    //update true/false

	//insert true/false

	//select false/resource

	//delete true/false



?>
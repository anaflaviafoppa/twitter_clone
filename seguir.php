<?php



//quando trabalha-se com variáveis de session, usar session_start no inicio do projeto

session_start();

	//força a pagina ao erro caso não haver login 

if(!isset($_SESSION['usuario'])){
	header('Location:index.php?erro=1');
}


require_once('db.class.php');


$id_usuario = $_SESSION['id_usuario'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];



//caso o texto_tweet for diferente de vazio e id_usuario for diferente de vazio, faça:

/*if($id_usuario != '' && $seguir_id_usuario != ''){
	$objDb = new db();
	$link = $objDb->conecta_mysql();*/


if($id_usuario == '' || $seguir_id_usuario == ''){
        die();
    }


    $objDb = new db();
	$link = $objDb->conecta_mysql();

	//para colocar os dados do tweet no database tweet:

	$sql = "INSERT INTO usuarios_seguidores (id_usuario, seguindo_id_usuario) VALUES ($id_usuario, $seguir_id_usuario)";

	mysqli_query($link, $sql);







?>
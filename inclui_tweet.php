<?php



//quando trabalha-se com variáveis de session, usar session_start no inicio do projeto

session_start();

	//força a pagina ao erro caso não haver login 

if(!isset($_SESSION['usuario'])){
	header('Location:index.php?erro=1');
}


require_once('db.class.php');

$texto_tweet = $_POST['texto_tweet'];

$id_usuario = $_SESSION['id_usuario'];


//caso o texto_tweet for diferente de vazio e id_usuario for diferente de vazio, faça:
if($texto_tweet != '' && $id_usuario != ''){
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//para colocar os dados do tweet no database tweet:

	$sql = "INSERT INTO tweet(id_usuario,tweet)values($id_usuario,'$texto_tweet')";

	mysqli_query($link, $sql);


}




?>
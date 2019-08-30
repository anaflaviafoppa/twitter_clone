<?php

//MOSTRAR OS TWEETS

//quando trabalha-se com variáveis de session, usar session_start no inicio do projeto

session_start();

	//força a pagina ao erro caso não haver login 

if(!isset($_SESSION['usuario'])){
	header('Location:index.php?erro=1');
}

require_once('db.class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

	//para puxar os dados do tweet no database tweet:

$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) WHERE id_usuario = $id_usuario OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario=$id_usuario) ORDER BY data_inclusao DESC";

	//DESC =ordenação decrescente.

$resultado_id = mysqli_query($link, $sql);

if($resultado_id){

	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		echo '<a href="#" class="list-group-item">';
			echo '<h4 class="list-group-item-heading"> '.$registro['usuario'].' <small> - '.$registro['data_inclusao_formatada'].' </small></h4>';
			echo '<p class="list-group-item-text">'.$registro['tweet'].' </p>';
		echo '</a>';

	}

} else{
	echo 'erro na consulta de tweets no banco de dados!';
}



?>
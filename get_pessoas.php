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
$nome_pessoa = $_POST['nome_pessoa'];

$objDb = new db();
$link = $objDb->conecta_mysql();

	//puxar todos os usuarios iguais no digitado da caixa de seleção e diferente do prórprio digitado.

$sql = " SELECT u.*,us.* FROM usuarios AS u LEFT JOIN usuarios_seguidores AS us ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) WHERE usuario like '%$nome_pessoa%' AND id <> $id_usuario";
 



	//like '%...%' = corresponde à uma cadeia de caracteres, por exemplo, se o usuario é "Fernanda" e procurar "Nanda" acharemos esse usuário .

$resultado_id = mysqli_query($link, $sql);

if($resultado_id){

	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		
		echo '<a href="#" class="list-group-item">';

                echo '<strong>' . $registro['usuario'] . '</strong> <small> - ' . $registro['email'] . ' </small>';

                echo '<p class="list-group-item-text pull-right">';

                $esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

                //teste para verificar se o usuário segue o usuario do login para ocultar os botões

                $btn_seguir_display = 'block';
                $btn_deixar_seguir_display = 'block';

                if($esta_seguindo_usuario_sn == 'N'){
                    $btn_deixar_seguir_display = 'none';
                }else{
                    $btn_seguir_display = 'none';
                }

     

                    echo '<button type="button" id="btn_seguir_' . $registro['id'] . '" style="display: ' . $btn_seguir_display . '" class="btn btn-default btn_seguir" data-id_usuario="' . $registro['id'] . '">Seguir</button>';

                    echo '<button type="button" id="btn_deseguir_' . $registro['id'] . '" style="display: ' . $btn_deixar_seguir_display . '" class="btn btn-primary btn_deseguir" data-id_usuario="' . $registro['id'] . '">Deixar de Seguir</button>';
				//data- é um recurso java

			echo '</p>';

			echo '<div class="clearfix"></div>';
		echo '</a>';

	}

} else{
	echo 'erro na consulta de usuários no banco de dados!';
}



?>
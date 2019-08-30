

<?php

	

    require_once('db.class.php');


    //consulta no banco de dados, escrever na área do Mysql do SQL

    $sql = "SELECT * FROM usuarios";

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){

    	//valida SE o processo de consulta está correto e não se existe ou não no banco de dados

        $dados_usuario = array();
        while($linha =mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            $dados_usuario[]=$linha;

        }

        //ouuu MYSQLI_NUM

        foreach ($dados_usuario as $usuario) {
            var_dump($usuario);
            echo '<br><br>';
            # code...
        }
        

    }else{
        
        echo "Erro na execução da consulta, favor entrar em contato com o admin do site";

    }

    //update true/false

	//insert true/false

	//select false/resource

	//delete true/false



?>
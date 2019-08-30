<?php

	session_start();

	//limpar os dados

	unset($_SESSION['usuario']);
	unset($_SESSION['email']);


	echo 'Esperamos você de volta';



?>
<?php
	//Iniciando a sessão
	session_start();
	//destruindo a sessão
	session_destroy();
	
	Header("Location: home.php"); 
?>
<?php
	$host = "localhost";
	$user = "root";
	$password = "123456";
	$dbname = "suamoda";

	mysql_connect($host, $user, $password) or die("Erro ao tentar se conectar!");

	mysql_select_db($dbname)or die("Erro ao selecionar o banco!");
?>
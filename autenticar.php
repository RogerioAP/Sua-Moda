<?php 
	include_once 'connect.php';
	
	//Recebendo os dados do formulário
	$email = addslashes($_POST["email"]);
	$senha = addslashes($_POST["senha"]);
	//$senha = md5(addslashes($_POST["senha"]));
	
	if(isset($_GET['usuario']))
	{
		$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
	}
	else if(isset($_GET['admin']))
	{
		$cpf = addslashes($_POST["cpf"]);
		$sql = "SELECT * FROM administrador WHERE cpf = '$cpf' AND email = '$email' AND senha = '$senha'";
	}
	$rs = mysql_query($sql);
	
	if(mysql_num_rows($rs) == 1)
	{
		$user = mysql_fetch_array($rs);
		
		//conferindo o login e senha para segurança
		if($email == $user['email'])
		{
			//se entrou, entao o login é igual
			if($senha == $user['senha'])
			{
				//se entrou, então a senha também é igual
				$logado = "1";
				$cpf_user = $user['cpf'];
				
				//criando a sessão
				session_start();
				$_SESSION["cpf_user"] = $cpf_user;;
				$_SESSION["logado"] = $logado;
				
				header("Location: home.php");
			}
			else
			{
				if(isset($_GET['usuario'])) { header("Location:login.php?error"); } else { header("Location:login_admin.php?error"); }
			}
		}
		else
		{
			if(isset($_GET['usuario'])) { header("Location:login.php?error"); } else { header("Location:login_admin.php?error"); }
		}
	}
	else
	{
		if(isset($_GET['usuario'])) { header("Location:login.php?error"); } else { header("Location:login_admin.php?error"); }
	}
	
?>

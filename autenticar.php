<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sistema de Login - Autenticando</title>
	</head>

	<body>
		<?php 
			include("connect.php");
			
			//Recebendo os dados do formulário
			$email = addslashes($_POST["email"]);
			$senha = addslashes($_POST["senha"]);
			//$senha = md5(addslashes($_POST["senha"]));
			
			$sql = "SELECT * FROM sis_login WHERE email = '$email' AND senha = '$senha'";
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
						$id_user = $user['idusuario'];
						
						//criando a sessão
						session_start();
						$_SESSION["id_user"] = $id_user;
						$_SESSION["logado"] = $logado;
						
						//depois que criarmos a sessão, vamos redirecionar para a página privada
						$tipo = $user['tipo'];
						if($tipo=='u'){header("Location: home.php");}
						else {header("Location: admin.php");}
					}
					else
					{
						header("Location:login.php?error");				
					}
				}
				else
				{
					header("Location:login.php?error");			
				}
			}
			else
			{
				header("Location:login.php?error");
			}
			
		?>
	</body>
</html>

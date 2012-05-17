<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
        <div><!--Principal-->
            <div class="cabecalho"><!--Cabeçalho-->
				<a href="home.php" class="image_title"><div class="image_title"></div></a>
				<div class="pes"><!--Espaco "Pessoal"-->
					<?php
						//Iniciando a sessão
						session_start();
						include("connect.php");
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM sis_login WHERE idusuario = ".$_SESSION['id_user'];
							
							$rs = mysql_query($sql);
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem págs específicas
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								
								echo "<table border='0' style='float:right'>
										<tr>
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
										</tr>
										<tr>
											<td><a href='user.php' style='color:black;'>$nome</a></td>
											<td><a href='logout.php' style='color:red;'>Sair</a></td>
										</tr>
									  </table>";
							}
						}
						else
						{
							echo "<div><a href='cadastrar.php'>Cadastrar</a></div><br><br>";
							echo "<div><a href='login.php'>Login</a></div>";
						}
					?>
				</div>
            </div>
            <?php include_once 'designer.inc'; menu();?>  <!--***MENU***-->
            <div class="content"><!--Conteúdo-->
				<?php
					$est_ses = session_id(); /*pega o estado da conexão se foi iniciada ou não*/
					if(empty($est_ses))
					{
						session_start();
					}
					include("connect.php");
					if(isset($_SESSION['logado'])) /*se existir usuário logado dá ERRO (afinal como logar em outra conta já estando logado)*/
					{
						echo "<br><center>Existe um usuário ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						echo "<form method='post' action='autenticar.php'>
							<br><center>Entrar como Administrador</center>
							<table border='0'>
								<tr>
									<td class='tex'>Nome</td>
									<td class='cai'><input type='text' id='txt' name='nome' placeholder='Digite o nome'></td>
								</tr>
								<tr>
									<td class='tex'>Email</td>
									<td class='cai'><input type='text' id='txt' name='email' placeholder='Digite o email'></td>
								</tr>
								<tr>
									<td class='tex'>Senha</td>
									<td class='cai'><input type='password' id='txt' name='senha' placeholder='Digite a senha'></td>
								</tr>
								<tr>
								</tr>
								<tr>
									<td colspan='3'><button>Entrar</button></td>
								</tr>
							</table>
						</form>";
					}
					if(isset($_GET["error"]))
					{
						echo "<center>
							Usuário ou senha inválidos. Tente novamente.<br>Não tem uma conta? <a href='cadastrar.php'>Registre-se!</a></center></br>";
					}
				?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sess�o
				session_start();
				include_once 'connect.php';
				
				//verifica se esta logado
				if(isset($_SESSION['logado']))
				{
					$cpf = $_SESSION['cpf_user'];
						
					//verifica e clicou para alterar estilo do site
					if(isset($_GET['estilo']))
					{
						$estilo = $_GET['estilo'];
						$sql = '';
						$sql = "update usuario set estilo='$estilo' where cpf='$cpf'";
						$rs = mysql_query($sql) or die (mysql_error());
					}
					else //se nao tiver clicado apenas busca o estilo o usuario no banco de dados
					{
						$sql = "select * from usuario where CPF='$cpf'";
						$rs = mysql_query($sql) or die (mysql_error());
						$user = mysql_fetch_array($rs);
						
						$estilo = $user["Estilo"];
					}
					
					//muda a aparencia do site
					if($estilo == 'nerd')
					{
						echo "<link href='nerd.css' rel='StyleSheet' type='text/css'>";
					}
					else if($estilo == 'rock')
					{
						echo "<link href='rock.css' rel='StyleSheet' type='text/css'>";
					}
					else  if($estilo == 'hello')//hello
					{
						echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
					}
					else //hello
					{
						echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
					}
				}
				else //hello
				{
					echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
				}
			?>
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
        <div class="div-borda"><!--Principal-->
            <div class="cabecalho"><!--Cabe�alho-->
				<div class="image_title">
					<?php
						include_once 'connect.php';
						if(isset($_SESSION['logado']))
						{
							/*Icones para mudar estilo do site*/
							echo "<a href='home.php'><img src='picture/hello.png'></a><br>
							<a href='home.php?estilo=rock'><img src='picture/guitarra.png'></a><br>
							<a href='home.php?estilo=nerd'><img src='picture/android_rosa.png'></a>";
						}
					?>
				</div>
				<div class="pes"><!--Espaco "Pessoal"-->
					<?php
						include("connect.php");
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM sis_login WHERE idusuario = ".$_SESSION['id_user'];
							
							$rs = mysql_query($sql);
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem p�gs espec�ficas
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
            
			<!--***MENU***-->
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>
			
            <div class="content"><!--Conte�do-->
				<?php
					$est_ses = session_id(); /*pega o estado da conex�o se foi iniciada ou n�o*/
					if(empty($est_ses))
					{
						session_start();
					}
					include("connect.php");
					if(isset($_SESSION['logado'])) /*se existir usu�rio logado d� ERRO (afinal como logar em outra conta j� estando logado)*/
					{
						echo "<br><center>Existe um usu�rio ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						echo "<form method='post' action='autenticar.php?admin'>
							<br><center>Entrar como Administrador</center>
							<table border='0'>
								<tr>
									<td class='tex'>CPF</td>
									<td class='cai'><input type='text' id='txt' name='cpf' placeholder='Digite o CPF'></td>
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
							Dados inv�lidos. Tente novamente.<br>N�o tem uma conta? <a href='cadastrar.php'>Registre-se!</a></center></br>";
					}
				?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
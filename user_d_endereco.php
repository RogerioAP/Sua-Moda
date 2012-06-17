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
						//atualiza no banco de dados o estilo do site
						$estilo = $_GET['estilo'];
						$sql = '';
						$sql = "update usuario set estilo='$estilo' where cpf='$cpf'";
						$rs = mysql_query($sql) or die (mysql_error());
					}
					else
					{
						//se nao tiver clicado apenas busca o estilo do usuario no banco de dados
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
						/*if(isset($_SESSION['logado']))*/
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
							$cpf = $_SESSION['cpf_user'];
							$sql = "SELECT * FROM usuario WHERE cpf = '$cpf';";
							
							$rs = mysql_query($sql) or die(mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem p�gs espec�ficas
								$nome = $user["Nome"]; /*nome completo*/
								$foto = $user["Foto"];
								
								echo "<table border='0' style='float:right'>
										<tr>
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
										</tr>
										<tr>
											<td><a href='user_d_pessoais.php' style='color:black;'>$nome</a></td>
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
					if(isset($_SESSION['logado']))
					{
						echo "<center><a href='user_d_pessoais.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados Pessoais</div></a>
							<a href='user_d_endereco.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados de Endere�o</div></a>
							<a href='user_d_identificacao.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados de Identifica��o</div></a>
							<a href='user_password.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Senha</div></a></center><br>";
											
						if(isset($_POST['atualizar'])) //clicou no bot�o
						{
							$endereco = $_POST["endereco"];
							$numero = $_POST["numero"];						
							$bairro = $_POST["bairro"];						
							$cidade = $_POST["cidade"];
							$senha = $_POST['senha'];
							
							if(!empty($endereco) && !empty($numero) && !empty($bairro) && !empty($cidade) && !empty($senha)) //verificando campos em branco
							{
								$cpf = $user['CPF'];
								//verificar se a senha atual do usu�rio est� correta
								include_once "classe.php";
								$obj = new Classe;
								$sql = "SELECT cpf, senha FROM usuario WHERE cpf='$cpf' AND senha='$senha'";
								$resultado = mysql_query($sql) or die (mysql_error());
								
								if(mysql_num_rows($resultado)) //se estiver certo
								{
									$sql = "UPDATE usuario SET rua='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade' WHERE cpf='$cpf'";
									$sd = mysql_query($sql) or die (mysql_error());
									echo "<br><center style='color:green;'>Dados de endere�o atualizados!</center>";
								}
								else
								{
									echo "<br><center style='color:red;'>Senha inv�lida!</center>";
								}
								//$resultado = $obj->senha($user['idusuario'], $senha_atual);
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos n�o podem ser nulos!</center>";
							}
						}
						
						$endereco = $user["Rua"];
						$numero = $user["Numero"];						
						$bairro = $user["Bairro"];						
						$cidade = $user["Cidade"];
						
						echo "<form method='post' action='user_d_endereco.php'>
							<br><center>ATUALIZAR&nbsp&nbsp&nbspDADOS&nbsp&nbsp&nbspDE&nbsp&nbsp&nbspENDERE�O&nbsp?</center>
							<table border=0>
								<tr>
									<td class='tex'>* Endere�o
									<br>* N�mero
									<br>* Bairro
									<br>* Cidade
									<br><br>Digite sua senha</td>
									<td class='cai'>
									<input type='text' id='txt' name='endereco' value='$endereco'><br>
									<input type='text' id='txt' name='numero' value='$numero'><br>
									<input type='text' id='txt' name='bairro' value='$bairro'><br>
									<input type='text' id='txt' name='cidade' value='$cidade'>
									<br><br><input type='password' id='txt' name='senha' placeholder='Digite sua senha'></td>
								</tr>
								<tr>
									<td colspan='3'><button name='atualizar'>Atualizar</button></td>
								</tr>
								<tr></tr>
							</table>
						</form>";
					}
					else
					{
						echo "<br><center>� necess�rio est� cadastrado!<br>
							<a href='home.php'>P�gina Inicial</a></center><br>";
					}
				?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
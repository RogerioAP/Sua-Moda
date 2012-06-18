<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sessão
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
	
		<!--Principal-->
        <div class="div-borda">
		
			<!--Cabeçalho-->
            <div class="cabecalho">
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
				
				<!--Espaco "Pessoal"-->
				<div class="pes">
					<?php
						include("connect.php");
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM sis_login WHERE idusuario = ".$_SESSION['id_user'];
							
							$rs = mysql_query($sql);
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								
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
			
			<!--Conteúdo-->
            <div class="content">
				<?php
					$est_ses = session_id(); /*pega o estado da conexão se foi iniciada ou não*/
					if(empty($est_ses))
					{
						session_start();
					}
					
					include_once 'connect.php';
					
					/*se existir usuário logado dá ERRO (afinal como logar em outra conta já estando logado)*/
					if(isset($_SESSION['logado']))
					{
						echo "<br><center>Existe um usuário ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						/*Exibe os campos email, senha e botao para entrar*/
						echo "<form method='post' action='autenticar.php?usuario'>
							<br><center>Entrar</center>
							<table border='0'>
								<tr>
									<td class='tex'>Email
									<br>Senha</td>
									<td class='cai'><input type='text' id='txt' name='email' placeholder='Digite o email'>
									<input type='password' id='txt' name='senha' placeholder='Digite a senha'></td>
									<td rowspan='2'><a href='login_admin.php'><img src='picture/restrito-2.png' style='height:110px;width:120px;'></a></td>
								</tr>
								<tr>
									<td colspan='3'><button>Entrar</button></td>
								</tr>
								<tr></tr>
							</table>
						</form>";
					}
					
					/*apos volta da para verificadora se tiver erro exibe a mensagem abaixo*/
					if(isset($_GET["error"]))
					{
						echo "<center>
							Dados inválidos. Tente novamente.<br>Não tem uma conta? <a href='cadastrar.php'>Registre-se!</a></center></br>";
					}
				?>
            </div>
			
			<!--Rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
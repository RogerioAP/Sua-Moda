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
						$caminho_imagem = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png"; /*imagem que vai ser utilizada como padrão caso o cliente não escolha nenhuma*/
						//Iniciando a sessão
						if(isset($_SESSION['logado']))
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";
							
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								global $user;
								$user = mysql_fetch_array($rs);
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
            
			<!--Menu-->
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>						
			
			<!--Conteúdo-->
            <div class="content">
				<?php
					//verifica se clicou no botao Autorizar Compra
					if(isset($_POST['autorizar']))
					{
						//verifica se digitou alguma coisa
						if(isset($_POST['senha']))
						{
							//verifica se escolheu alguma forma de pagamento
							if(isset($_POST['opcao']))
							{
								$opcao = $_POST['opcao'];
								$password = $user['Senha'];
								
								//verifica se a senha digitada eh igual a do usuario ativo no momento
								if($password == $_POST['senha'])
								{
									//escolheu a opcao VISA
									if($opcao == '1')
									{
										echo "<br><center style='color:red;'>Em construção!</center>";
									}
									//escolheu a opcao MASTER CARD
									else if ($opcao == '2')
									{
										echo "<br><center style='color:red;'>Em construção!</center>";
									}
									//escolheu a opcao BOLETO
									else if ($opcao == '3')
									{
										//abre o boleto para imprimir
										//header('Location: boleto.php');
										echo "<script language='javascript'>window.open('boleto.php', '_blank');</script>";
									}
								}
								else
								{
									echo "<br><center style='color:red;'>Senha inválida!</center>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Selecione uma forma de pagamento!</center>";
							}
						}
						else
						{
							echo "<br><center style='color:red;'>Digite sua senha no campo abaixo!</center>";
						}
					}
					
					function abrir_guia()
					{
						
					}
					
					//verifica se esta logado para aparecer as formulas de pagamento e um campo para confirma a senha
					if(isset($_SESSION['logado']))
					{						
						//exibe as formas de pagamento
						echo "<br><center>Selecione uma forma de pagamento:<br>
							<form method='post' action='venda.php'>
								<table border=0>
									<tr>
										<td style='text-align:right;padding-right:20px;'><input type='radio' value='1' name='opcao'></td>
										<td><input type='radio' name='opcao' value='2'></td>
										<td style='text-align:left;padding-left:20px;'><input type='radio' value='3' name='opcao'></td>
									</tr>
									<tr>
										<td style='text-align:right;'><img src='picture/visa.gif' style='width:60px; height:38px;'></td>
										<td><img src='picture/master_card.gif' style='width:60px; height:38px;'></td>
										<td style='text-align:left;'><img src='picture/boleto.gif' name='forma' style='width:60px; height:38px;'></td>
									</tr>
								</table>
								</center>
								
								<br><center>Segurança</center>
								<table border='0'>
									<tr>
										<td class='tex'>Digite sua Senha</td>
										<td class='cai'><input type='password' id='txt' name='senha' placeholder='Digite a senha'></td>
									</tr>
									<tr>
										<td colspan='3'><button name='autorizar'>Autorizar Compra</button></td>
									</tr>
								</table>
							</form>";
					}
					else
					{
						//nao esta logado
						echo "<br><center>É necessário está logado!<br>
								<a href='login.php'>Entrar</a></center>";
					}
				?>
            </div>
			
			<!--Rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
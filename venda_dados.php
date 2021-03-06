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
						/*include_once 'connect.php';
						if(isset($_SESSION['logado']))
						{
							/*Icones para mudar estilo do site*
							echo "<a href='venda_dados.php'><img src='picture/hello.png'></a><br>
							<a href='venda_dados.php?estilo=rock'><img src='picture/guitarra.png'></a><br>
							<a href='venda_dados.php?estilo=nerd'><img src='picture/android_rosa.png'></a>";
						}*/
					?>
				</div>
				
				<div class="pes"><!--Espaco "Pessoal"-->
					<?php
						$caminho_imagem = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png"; /*imagem que vai ser utilizada como padr�o caso o cliente n�o escolha nenhuma*/
						//Iniciando a sess�o
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
								//if($user["tipo"]=='a'){$linha=$nome;} else {$linha="<a href='user_d_pessoais.php' style='color:black;'>$nome</a>";}//desativar link no nome
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
            
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>						
			
			<!--Conte�do-->
            <div class="content">
				<?php
					if(isset($_SESSION['logado']))
					{
						if(isset($_POST['id_produto']))
						{
							//passa para a sessao o id do produto
							$_SESSION['id_produto'] = $_POST['id_produto'];
							
							$email = $user['Email'];
							$telefone = $user['Telefone'];
							$endereco = $user['Rua'];
							$numero = $user['Numero'];
							$bairro = $user['Bairro'];
							$cidade = $user['Cidade'];
							
							echo "<br><center>Voc� confirma os dados para a compra?</center>
								<table border='0'>
									<tr>
										<td class='tex'>Nome</td>
										<td class='cai'><input type='text' id='txt' name='email' value='$nome' disabled></td>
									</tr>
										<td class='tex'>Email</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$email' disabled></td>
									</tr>
										<td class='tex'>Telefone</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$telefone' disabled></td>
									</tr>
										<td class='tex'>Rua</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$endereco' disabled></td>
									</tr>
										<td class='tex'>N�mero</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$numero' disabled></td>
									</tr>
										<td class='tex'>Bairro</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$bairro' disabled></td>
									</tr>
										<td class='tex'>Cidade</td>
										<td class='cai'><input type='text' id='txt' name='senha' value='$cidade' disabled></td>
									</tr>
									<tr>
										<td colspan='3'><button onclick='window.location=\"user_d_endereco.php\"'>Atualizar</button><button onclick='window.location=\"venda.php\"'>Avan�ar</button></td>
									</tr>
									<tr></tr>
								</table>
							</form>";
						}
					}
					else
					{
						echo "<br><center>� necess�rio est� logado!<br>
								<a href='login.php'>Entrar</a></center>";
					}
				?>
            </div>
			
			<!--Rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
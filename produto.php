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
        <div class="div-borda"><!--Principal-->
            <div class="cabecalho"><!--Cabeçalho-->
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
							$cpf = $_SESSION['cpf_user'];
							$sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";
							
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem págs específicas
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
			
            <div class="content"><!--Conteúdo-->
				<?php
					include_once 'connect.php';
					$id_produto = $_GET["produto"];
					$sql = "SELECT * FROM produto WHERE idProduto = $id_produto;";
					
					$rs = '';
					$rs = mysql_query($sql) or die (mysql_error());						
					
					if(mysql_num_rows($rs))
					{
						$user = mysql_fetch_array($rs);
						
						$nome = $user['Nome'];
						$descricao = $user['Descricao'];
						$preco = $user['Preco'];
						
						$sql2 = "select * from imagens where idProduto=$id_produto;";
						$rs2 = '';
						$rs2 = mysql_query($sql2) or die (mysql_error());
						if(mysql_num_rows($rs2))
						{
							$user2 = mysql_fetch_array($rs2);
							$imagem = $user2["imagem1"];
						}
						
						
						echo "<div><img src='$imagem' style='width:300px; height:250px;'><br>
								<b>$nome</b><br>
								$descricao<br>
								R$ $preco<br>
								<form method='post' action='venda.php'>
									<button value='$preco' name='produto' onclick='window.location=\"venda.php\";'>Comprar</button><br><br>
								</form>";
						
						/*Exibir o link para voltar para a página anterior*/
						if(isset($_GET['categoria']))
						{
							if($_GET['categoria']=='acessorios')
							{
								echo "<a href='categoria.php?cat=a'><< Voltar a acessórios</a><br></div>";
							}
							else if($_GET['categoria']=='gadgets')
							{
								echo "<a href='categoria.php?cat=g'><< Voltar a gadgets</a><br></div>";
							}
							else if($_GET['categoria']=='vestuario')
							{
								echo "<a href='categoria.php?cat=v'><< Voltar a vestuário</a><br></div>";
							}
						}
						else
						{
							echo "<a href='home.php'><< Voltar a Página Inicial</a><br></div>";
						}
					}
				?>
            </div>
			
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
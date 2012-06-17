<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sessão
				session_start();
				include_once 'connect.php';
				
				if(isset($_SESSION['logado']))
				{
					$cpf = $_SESSION['cpf_user'];
					$sql = "select * from usuario where CPF='$cpf'";
					$rs = mysql_query($sql) or die (mysql_error());
					$user = mysql_fetch_array($rs);
					
					$estilo = $user["Estilo"];
					
					if($estilo == 'nerd')
					{
						echo "<link href='nerd.css' rel='StyleSheet' type='text/css'>";
					}
					else if($estilo == 'rock')
					{
						echo "<link href='rock.css' rel='StyleSheet' type='text/css'>";
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
	
		<!--Div Principal-->
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
						include_once "connect.php";
						if(isset($_SESSION['logado']))
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";
							
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem pags espec�ficas
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
			
			<!--Conteúdo-->
            <div class="content">
				<?php					
					include_once 'connect.php';
				
					$categoria = '';
					if(isset($_GET["cat"])) {$categoria = $_GET['cat'];} //pega qual categoria é para abrir
					
					$sql = '';
					
					//verifica qual tipo de produto eh para listar
					if($categoria == 'a')
					{
						echo "<div style='clear:both;'>Acessorios</div>";
						$sql = "SELECT * FROM produto where categoria = 'acessorios' limit 9;";
					}
					else if($categoria == 'g')
					{
						echo "<div style='clear:both;'>Gadgets</div>";
						$sql = "SELECT * FROM produto where categoria = 'gadgets' limit 9;";
					}
					else
					{
						echo "<div style='clear:both;'>Vestuario</div>";
						$sql = "SELECT * FROM produto where categoria = 'vestuario' limit 9;";
					}
					
					//passa o resultado da busca para variavel
					$rs = mysql_query($sql);
					
					//contador para saber quando eh para trocar de linha
					$cont = 0;
					
					//exibe produtos					
					echo "<div>";
					echo "<table border='0'>";
					while($linha = mysql_fetch_assoc($rs))
					{
						$id_produto = $linha['idProduto'];
						$preco = $linha['Preco'];
						$nome = $linha['Nome'];
						$categoria = $linha['Categoria'];
						
						$sql2 = "select * from imagens where idProduto=$id_produto;";
						$rs2 = '';
						$rs2 = mysql_query($sql2) or die (mysql_error());
						if(mysql_num_rows($rs2))
						{
							$user2 = mysql_fetch_array($rs2);
							$imagem = $user2["imagem1"];
						}
						
						// a primeira vez inicia a div e tr
						if($cont==0)
						{
							echo "<tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>$preco</a></td>";
						}
						else if($cont%3==0)
						{
							echo "</tr> <tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>$preco</a></td>";
						}
						else
						{
							echo "<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>$preco</a></td>";
						}
						
						//contador incrementando
						$cont++;
						//contador para saber quando eh para trocar de linha
					}
					echo "</table>";
					echo "</div>";
				?>
            </div>
			
			<!--**RODAPÉ**-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
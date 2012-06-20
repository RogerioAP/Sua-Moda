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
					
					//muda a aparencia do site de acordo com o icone clicado
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
			<link href="css/default.css" rel="stylesheet" type="text/css" />
	
			<!--2 arquivos javascript para o slideshow
			<script src="javascript/jquery-1.2.6.pack.js" type="text/javascript"></script>
			<script src="javascript/jquery.flow.1.1.min.js" type="text/javascript"></script> -->
			
			<!-- Plugins para o slide show -->
			<script type="text/javascript" src="javascript/coin-slider/jquery-1.4.2.js"></script>
			<script type="text/javascript" src="javascript/coin-slider/coin-slider.min.js"></script>
			<link rel="stylesheet" href="javascript/coin-slider/coin-slider-styles.css" type="text/css" />
			
			<script type="text/javascript">
				$(document).ready(function() {
					$('#coin-slider').coinslider({ width: 800, delay: 5000, height: 400, hoverPause: true, effect: 'straight' });
				});
			</script>
            
			<title>Sua Moda</title>
    </head>
    
    <body class="bodyW">

		
		<!--Div que recebe tudo-->
		<div id="todo">
            <div class="cabecalho">
				<div class="image_title">
					<div id="titulo">
						<?php
						include_once 'connect.php';
						if(isset($_SESSION['logado']))
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = '';
							$sql = "SELECT * FROM usuario WHERE CPF = '$cpf';";
							
							$rs = '';
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem p�gs espec�ficas
								$nome = $user["Nome"]; /*nome completo*/
								$foto = $user["Foto"];
								
								echo "<table border='0' style=\"float:right; margin-right: 150px;\">
										<tr>
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
											<td style=\"margin-right: 100px; font-size: 13px;\"><a href='user_d_pessoais.php' style='color:black;'>$nome</a>
											<br /><a href='logout.php' style='color:blue; font-size: 13px;'>Sair</a></td>
										</tr>
									  </table>";
							}
						}
						else
						{
							echo "<strong style=\"margin-left: 480px; font-size: 13px;\">&Eacute; visitante? </strong> <a style=\"font-size: 13px;\" href='cadastrar.php'>Registre-se</a> <br />";
							echo "<strong style=\"margin-left: 430px; font-size: 13px;\"> &Eacute; cadastrado? Fa&ccedil;a seu </strong> <a style=\"font-size: 13px;\" href='login.php'>Login</a>";
						}
						?>
					</div>
				</div>
            </div>
			
			<!--***MENU***-->
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>
			
			<!--Div do slideshow-->
			<div id='coin-slider'>
				<?php
						$sql = '';
						$sql = 'select imagens.idproduto, imagens.imagem1 from imagens order by rand() limit 3;'; //busca 3 ultimos produtos adicionados no BD
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$imagens[] = $linha['imagem1'];
							$prod_id[] = $linha['idproduto'];
						}
					?>
					
				<a href="produto.php?produto=<?php echo $prod_id[0]; ?>">
					<img style="image-resolution: auto" src=<?php echo $imagens[0]; ?> alt="photo" />
				</a>
				<a href="produto.php?produto=<?php echo $prod_id[1] ?>">
					<img src=<?php echo $imagens[1]; ?> alt="photo" />
				</a>
				<a href="produto.php?produto=<?php echo $prod_id[2] ?>">
					<img src=<?php echo $imagens[2]; ?> alt="photo" />
				</a>
			</div>
			
			
			
			

			<!--Conte�do-->
            <div class="content">				
				<div style="width:100%;"><br>
					Novidades!!
					<?php
						//acessorios -> busca no BD imagens e seus nomes e precos para exibir alguns
						$sql = '';
						
						//select que busca tambem uma imagem do produto
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='acessorios' and produto.idproduto=imagens.idproduto order by rand() limit 3;";
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$acessorios[] = $linha['imagem1'];
							$aces_nome[] = $linha['Nome'];
							$aces_pre[] = $linha['Preco'];
							$aces_id[] = $linha['idproduto'];
						}
						
						//vestuario -> busca no BD imagens e seus nomes e precos para exibir alguns
						$sql = '';
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='vestuario' and produto.idproduto=imagens.idproduto order by rand() limit 3;";
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$vestuario[] = $linha['imagem1'];
							$vest_nome[] = $linha['Nome'];
							$vest_pre[] = $linha['Preco'];
							$vest_id[] = $linha['idproduto'];
						}
						
						//gadgets -> busca no BD imagens e seus nomes e precos para exibir alguns
						$sql = '';
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='gadgets' and produto.idproduto=imagens.idproduto order by rand() limit 3;";
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$gadgets[] = $linha['imagem1'];
							$gad_nome[] = $linha['Nome'];
							$gad_pre[] = $linha['Preco'];
							$gad_id[] = $linha['idproduto'];
						}
						
					?>
					
					<!--Tabela que armazena os produtos depois do destaque-->
					<table border="0">
						<tr>
							<td width='266px'><a href="produto.php?produto=<?php echo $aces_id[0]; ?>"><img src=<?php echo $acessorios[0]; ?> ><br><?php echo $aces_nome[0]; ?><br><?php echo "R$ ".$aces_pre[0]; ?></a></td>
							<td width='266px'><a href="produto.php?produto=<?php echo $aces_id[1]; ?>"><img src=<?php echo $acessorios[1]; ?> ><br><?php echo $aces_nome[1]; ?><br><?php echo "R$ ".$aces_pre[1]; ?></a></td>
							<td width='266px'><a href="produto.php?produto=<?php echo $aces_id[2]; ?>"><img src=<?php echo $acessorios[2]; ?> ><br><?php echo $aces_nome[2]; ?><br><?php echo "R$ ".$aces_pre[2]; ?></a></td>
						</tr>
						<tr>
							<td width='268px'><a href="produto.php?produto=<?php echo $vest_id[0]; ?>"><img src=<?php echo $vestuario[0]; ?> ><br><?php echo $vest_nome[0]; ?><br><?php echo "R$ ".$vest_pre[0]; ?></a></td>
							<td width='268px'><a href="produto.php?produto=<?php echo $vest_id[1]; ?>"><img src=<?php echo $vestuario[1]; ?> ><br><?php echo $vest_nome[1]; ?><br><?php echo "R$ ".$vest_pre[1]; ?></a></td>
							<td width='268px'><a href="produto.php?produto=<?php echo $vest_id[2]; ?>"><img src=<?php echo $vestuario[2]; ?> ><br><?php echo $vest_nome[2]; ?><br><?php echo "R$ ".$vest_pre[2]; ?></a></td>
						</tr>
						<tr>
							<td width='266px'><a href="produto.php?produto=<?php echo $gad_id[0]; ?>"><img src=<?php echo $gadgets[0]; ?> ><br><?php echo $gad_nome[0]; ?><br><?php echo "R$ ".$gad_pre[0]; ?></a></td>
							<td width='266px'><a href="produto.php?produto=<?php echo $gad_id[1]; ?>"><img src=<?php echo $gadgets[1]; ?> ><br><?php echo $gad_nome[1]; ?><br><?php echo "R$ ".$gad_pre[1]; ?></a></td>
							<td width='266px'><a href="produto.php?produto=<?php echo $gad_id[2]; ?>"><img src=<?php echo $gadgets[2]; ?> ><br><?php echo $gad_nome[2]; ?><br><?php echo "R$ ".$gad_pre[2]; ?></a></td>
						</tr>
					</table>
				</div>
            </div>
			
			<!--Rodap�-->
			<?php include_once 'designer.inc'; rodape(); ?>
			
        </div>
    </body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			
			<?php
				if(isset($_GET['estilo']))
				{
					$estilo = $_GET['estilo'];
					
					if($estilo == 'nerd')
					{
						echo "<link href='nerd.css' rel='StyleSheet' type='text/css'>";
					}
					else if($estilo == 'rock')
					{
						echo "<link href='rock.css' rel='StyleSheet' type='text/css'>";
					}
					else
					{
						echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
					}
				}
				else
				{
					echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
				}
			?>
			<link href="css/default.css" rel="stylesheet" type="text/css" />
	
			<!--2 arquivos javascript para o slideshow-->
			<script src="javascript/jquery-1.2.6.pack.js" type="text/javascript"></script>
			<script src="javascript/jquery.flow.1.1.min.js" type="text/javascript"></script>
            
			<title>Sua Moda</title>
			
			<!--Javascript que define as imagens do slideshow-->
			<script type="text/javascript">
			$(function() {
				$("div#controller").jFlow({
					slides: "#slides",
					width: "800px",
					height: "313px"
				});
			});
			</script>
    </head>
    <body class="bodyW">
		
		<!--Div que recebe tudo e que tem a borda degradê-->
		<div class="div-borda">
		
			<!--Cabeçalho-->
            <div class="cabecalho">
				<div class="image_title">
					<?php
						//Iniciando a sessão
						session_start();
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
						include_once 'connect.php';
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM suamoda WHERE idusuario = ".$_SESSION['id_user'];
							
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
			
			<!--Div do slideshow-->
			<div id="wrap" style="margin-top:-45px;padding:10px 0px 0px 300px;"><!--style="padding:10px 0px 0px 300px;">-->
				<div id="controller" class="hidden">
					<span class="jFlowControl">No 1</span>
					<span class="jFlowControl">No 2</span>
					<span class="jFlowControl">No 3</span>
				</div>
				
				<div id="prevNext">
					<img src="picture/prev.png" alt="Previous Tab" class="jFlowPrev" />
					<img src="picture/next.png" alt="Next Tab" class="jFlowNext" />
				</div>
							
				<?php
					$sql = '';
					$sql = 'select imagens.idproduto, imagens.imagem1 from imagens order by idproduto desc limit 3;'; //busca 3 ultimos produtos adicionados no BD
					$rs = '';
					$rs = mysql_query($sql) or die (mysql_error());					
					
					while($linha = mysql_fetch_assoc($rs))
					{
						$imagens[] = $linha['imagem1'];
						$prod_id[] = $linha['idproduto'];
					}
				?>
				
				<div id="slides" align='center'>
					<div><a href="produto.php?produto=<?php echo $prod_id[0]; ?>"><img src=<?php echo $imagens[0]; ?> alt="photo" /></a><p>This is photo number one. Neato!</p></div>
					<div><a href="produto.php?produto=<?php echo $prod_id[1] ?>"><img src=<?php echo $imagens[1]; ?> alt="photo" /></a><p>This is photo number two. Neato!</p></div>
					<div><a href="produto.php?produto=<?php echo $prod_id[2] ?>"><img src=<?php echo $imagens[2]; ?> alt="photo" /></a><p>This is photo number three. Neato!</p></div>
				</div>
			</div>

			<!--Conteúdo-->
            <div class="content">				
				<div style="width:100%;">
					Novidades meninas, olhem!
					
					<?php
						//acessorios
						$sql = '';
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='acessorios' and produto.idproduto=imagens.idproduto order by produto.idproduto desc limit 3;";
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$acessorios[] = $linha['imagem1'];
							$aces_nome[] = $linha['Nome'];
							$aces_pre[] = $linha['Preco'];
							$aces_id[] = $linha['idproduto'];
						}
						//vestuario
						$sql = '';
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='vestuario' and produto.idproduto=imagens.idproduto order by produto.idproduto desc limit 3;";
						$rs = '';
						$rs = mysql_query($sql) or die (mysql_error());					
						
						while($linha = mysql_fetch_assoc($rs))
						{
							$vestuario[] = $linha['imagem1'];
							$vest_nome[] = $linha['Nome'];
							$vest_pre[] = $linha['Preco'];
							$vest_id[] = $linha['idproduto'];
						}
						//gadgets
						$sql = '';
						$sql = "select produto.idproduto, produto.Nome, produto.Preco, imagens.imagem1 from produto,
						imagens where produto.categoria='gadgets' and produto.idproduto=imagens.idproduto order by produto.idproduto desc limit 3;";
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
					
					<table border="0">
						<tr>
							<td><a href="produto.php?produto=<?php echo $aces_id[0]; ?>"><img src=<?php echo $acessorios[0]; ?> ><br><?php echo $aces_nome[0]; ?><br><?php echo "R$ ".$aces_pre[0]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $aces_id[1]; ?>"><img src=<?php echo $acessorios[1]; ?> ><br><?php echo $aces_nome[1]; ?><br><?php echo "R$ ".$aces_pre[1]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $aces_id[2]; ?>"><img src=<?php echo $acessorios[2]; ?> ><br><?php echo $aces_nome[2]; ?><br><?php echo "R$ ".$aces_pre[2]; ?></a></td>
						</tr>
						<tr>
							<td><a href="produto.php?produto=<?php echo $vest_id[0]; ?>"><img src=<?php echo $vestuario[0]; ?> ><br><?php echo $vest_nome[0]; ?><br><?php echo "R$ ".$vest_pre[0]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $vest_id[1]; ?>"><img src=<?php echo $vestuario[1]; ?> ><br><?php echo $vest_nome[1]; ?><br><?php echo "R$ ".$vest_pre[1]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $vest_id[2]; ?>"><img src=<?php echo $vestuario[2]; ?> ><br><?php echo $vest_nome[2]; ?><br><?php echo "R$ ".$vest_pre[2]; ?></a></td>
						</tr>
							<td><a href="produto.php?produto=<?php echo $gad_id[0]; ?>"><img src=<?php echo $gadgets[0]; ?> ><br><?php echo $gad_nome[0]; ?><br><?php echo "R$ ".$gad_pre[0]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $gad_id[1]; ?>"><img src=<?php echo $gadgets[1]; ?> ><br><?php echo $gad_nome[1]; ?><br><?php echo "R$ ".$gad_pre[1]; ?></a></td>
							<td><a href="produto.php?produto=<?php echo $gad_id[2]; ?>"><img src=<?php echo $gadgets[2]; ?> ><br><?php echo $gad_nome[2]; ?><br><?php echo "R$ ".$gad_pre[2]; ?></a></td>
						</tr>
					</table>
				</div>
            </div>
			
			<!--Rodapé-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
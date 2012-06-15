<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
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
            <?php include_once 'designer.inc'; menu();?>
			
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
				
				<div id="slides">
					<div><a href="#"><img src="picture/1.jpg" alt="photo" /></a><p>This is photo number one. Neato!</p></div>
					<div><a href="#"><img src="picture/2.jpg" alt="photo" /></a><p>This is photo number two. Neato!</p></div>
					<div><a href="#"><img src="picture/3.jpg" alt="photo" /></a><p>This is photo number three. Neato!</p></div>
				</div>
			</div>

			<!--Conteúdo-->
            <div class="content">				
				<div style="width:100%;">
					Novidades meninas, olhem!<hr>
					
					<table border="0">
						<tr>
							<td><a href="#"><img src="produtos/sapatos_bolsa.jpg"><br>Sapatos e Bolsa<br>R$ 34,90</a></td>
							<td><a href="#"><img src="produtos/relogio.jpeg"><br>Relógio Mondaine<br>R$ 24,90</a></td>
							<td><a href="#"><img src="produtos/sapatos.jpg"><br>Sapatos Chanel<br>R$ 29,90</a></td>
						</tr>
						<tr>
							<td><a href="#"><img src="produtos/sapatos_bolsa.jpg"><br>Sapatos e Bolsa<br>R$ 34,90</a></td>
							<td><a href="#"><img src="produtos/relogio.jpeg"><br>Relógio Mondaine<br>R$ 24,90</a></td>
							<td><a href="#"><img src="produtos/sapatos.jpg"><br>Sapatos Chanel<br>R$ 29,90</a></td>
						</tr>
							<td><a href="#"><img src="produtos/sapatos_bolsa.jpg"><br>Sapatos e Bolsa<br>R$ 34,90</a></td>
							<td><a href="#"><img src="produtos/relogio.jpeg"><br>Relógio Mondaine<br>R$ 24,90</a></td>
							<td><a href="#"><img src="produtos/sapatos.jpg"><br>Sapatos Chanel<br>R$ 29,90</a></td>
						</tr>
					</table>
				</div>
            </div>
			
			<!--Rodapé-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
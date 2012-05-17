<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
        <div><!--Principal-->
            <div class="cabecalho"><!--Cabeçalho-->
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
            <?php include_once 'designer.inc'; menu();?>  <!--***MENU***-->
            <div class="content"><!--Conteúdo-->
				<div><!--COLOCAR CONDICOES PHP PARA PRODUTOS CUSTOMIZADOS PARA CLIENTE-->
					<div>Construindo...
					</div>
					<div><!--DESTAQUES-->
						Destaques<hr/>
						<!--<img src="picture/virtual.jpg">-->
						<!--KKKKKKKKKK-->
						<script src='javascript/jquery.js' type='text/javascript'></script>
						<script src='javascript/s3Slider.js' type='text/javascript'></script>
						<script type="text/javascript">
						$(document).ready(function()
						{
							$('#slider').s3Slider({
							timeOut: 3000 /*Representa em milesimos de segundo o tempo de troca de imagem (neste caso temos 3 segundos)*/
						});
						});
						</script>
						<div id="slider">
							<ul id="sliderContent">
								<li class="sliderImage">
									<a href="#"><img src="produtos/blusas.jpg" border="0"/>
									<span class="top">Blusas</span></a>
								</li>
								<li class="sliderImage">
									<a href="#"><img src="produtos/adesivo_celular.jpg" border="0"/>
									<span class="top">Adesivo p/ Celular</span></a>
								</li>
								<li class="sliderImage">
									<a href="#"><img src="produtos/sapatos_bolsa.jpg" border="0"/>
									<span class="top">Sapato e Bolsa</span></a>
								</li>
								<li class="sliderImage">
									<a href="#"><img src="produtos/sapatos.jpg" border="0"/>
									<span class="top">Sapatinhos</span></a>
								</li>
								<li class="sliderImage">
									<a href="#"><img src="produtos/adesivo_notebook.jpg" border="0"/>
									<span class="top">Adesivo p/ Notebook</span></a>
								</li>
								<div class="clear sliderImage"></div>	
							</ul>
						</div>
					</div>
					<!--KKKKKKKKKK-->
					<!--<img src="produtos/1.jpg">
					<img src="produtos/2.jpg">
					<img src="produtos/3.jpg">
					<img src="produtos/4.jpg">-->
				</div>
				<div style="width:100%;">
					Novidades meninas, olhem!<hr>
					<table border="1">
						<tr>
							<td><a href="#"><img src="produtos/sapatos_bolsa.jpg">Sapatos e Bolsa<br>R$ 34,90</a></td>
							<td><a href="#"><img src="produtos/relogio.jpeg">Relógio Mondaine<br>R$ 24,90</a></td>
							<td><a href="#"><img src="produtos/sapatos.jpg">Sapatos Chanel<br>R$ 29,90</a></td>
						</tr>
						<tr>
							<td><a href="#"><img src="produtos/blusas.jpg">Blusas<br>R$ 14,90</a></td>
							<td><a href="#"><img src="produtos/bolsa.jpg">Bolsa<br>R$ 34,90</a></td>
							<td><a href="#"><img src="produtos/blusas2.jpg">Blusas<br>R$ 9,90</a></td>
						</tr>	
							<td><a href="#"><img src="produtos/adesivo_celular.jpg">Adesivo Hello Kid p/ Celular<br>R$ 2,90</a></td>
							<td><a href="#"><img src="produtos/sapatos.jpg">Sapatinhos<br>R$ 19,90</a></td>
						</tr>
					</table>
				</div>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
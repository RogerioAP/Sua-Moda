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
			
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
        <div class="div-borda"><!--Principal-->
            <div class="cabecalho"><!--Cabeçalho-->
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
						$caminho_imagem = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png"; /*imagem que vai ser utilizada como padrão caso o cliente não escolha nenhuma*/
						//Iniciando a sessão
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM sis_login WHERE idusuario = ".$_SESSION['id_user'];
							
							$rs = mysql_query($sql);
							if(mysql_num_rows($rs))
							{
								global $user;
								$user = mysql_fetch_array($rs);
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								if($user["tipo"]=='a'){$linha=$nome;} else {$linha="<a href='user_d_pessoais.php' style='color:black;'>$nome</a>";}//desativar link no nome
								echo "<table border='0' style='float:right'>
										<tr>
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
										</tr>
										<tr>
											<td>$linha</td>
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
            <?php
				if($user["tipo"]=='a')
				{
					include_once 'designer.inc'; menu_admin();
				}
				else
				{
					/*MENU*/
					echo "<div class='NavbarMenu'>
							<ul id='nav'>
								<?php include_once 'designer.inc'; menu();?>
							</ul>
						</div>";
				}
			?>
			
			<!--Conteúdo-->
            <div class="content">
				<br><center>Selecione a forma de pagamento:<br>
				<a href='#'><img src='picture/visa.gif' style='width:60px; height:38px;'></a>
				<a href='#'><img src='picture/master_card.gif' style='padding-left:50px; width:60px; height:38px;'></a>
				<a href='boleto.php'><img src='picture/boleto.gif' style='padding-left:50px; width:60px; height:38px;'></a>
				</center>
            </div>
			
			<!--Rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
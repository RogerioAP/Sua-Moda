<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
        <div><!--Principal-->
            <div class="cabecalho"><!--Cabe�alho-->
				<div class="image_title"></div>
				<div class="pes"><!--Espaco "Pessoal"-->
					<?php
						//Iniciando a sess�o
						session_start();
						include_once 'connect.php';
						if(isset($_SESSION['logado']))
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = "SELECT * FROM administrador WHERE cpf = '$cpf'";
							
							$rs = mysql_query($sql) or die(mysql_error());
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
											<td>$nome</td>
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
					<?php include_once 'designer.inc'; menu_admin();?>
				</ul>
			</div>
			
			<!--Conte�do-->
            <div class="content">
			<?php			
				if(isset($_SESSION["logado"]))
				{	//sub-menu
					echo "<center><a href='admin_site.php'><div style='width:265px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Logo</div></a>
							<a href='admin_site.php?rodape'><div style='width:265px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Rodap�</div></a>
							<a href='admin_site.php?imagem'><div style='width:270px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Imagem-Padr�o</div></a></center><br>";
					if(isset($_POST["atualizar_logo"]))/*atualizar logo*/
					{
						//testa pra saber se a imagem foi carregada
						if($_FILES['logo']['error']==0)
						{
							$foto = $_FILES['logo'];
							// Tamanho m�ximo do arquivo em bytes
							$tamanho = 200000;
							
							// Verifica se o tamanho da imagem � maior que o tamanho permitido
							if($foto["size"] > $tamanho)
							{
								echo "<center style='color:red;'><br>A imagem deve ter no m�ximo ".$tamanho." bytes</center><br>";
							}
							else
							{
								$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
								//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
								$extensao = strtolower(end(explode('.', $_FILES['logo']['name'])));						
								if (array_search($extensao, $_UP['extensoes']) === false)
								{
								   echo "<center style='color:red;'><br>Isso n�o � uma imagem!</center><br>";
								}
								else
								{
									// Pega as dimens�es da imagem
									$dimensoes = getimagesize($foto["tmp_name"]);
									
									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
									//echo "<br>".$ext[1];
									// Gera um nome �nico para a imagem
									//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
						 
									// Caminho de onde ficar� a imagem
									$caminho_imagem = "";
									$caminho_imagem = "picture/titulo.png";// . $ext[1];
						 
									// Faz o upload da imagem para seu respectivo caminho
									move_uploaded_file($foto["tmp_name"], $caminho_imagem);
									echo "<center style='color:green;'><br>Imagem da logomarca atualizada!</center>";
								}
								//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
								// Insere os dados no banco
						////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
							}
						}
					}
					else if(isset($_POST["atualizar_rodape"]))/*atualizar rodape*/
					{
						//testa pra saber se a imagem foi carregada
						if($_FILES['rodape']['error']==0)
						{
							$foto = $_FILES['rodape'];
							// Tamanho m�ximo do arquivo em bytes
							$tamanho = 200000; //200 000 bytes equivale 200KB
							
							// Verifica se o tamanho da imagem � maior que o tamanho permitido
							if($foto["size"] > $tamanho)
							{
								echo "<center style='color:red;'><br>A imagem deve ter no m�ximo ".$tamanho." bytes</center><br>";
							}
							else
							{
								$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
								//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
								$extensao = strtolower(end(explode('.', $_FILES['rodape']['name'])));						
								if (array_search($extensao, $_UP['extensoes']) === false)
								{
								   echo "<center style='color:red;'><br>Isso n�o � uma imagem!</center><br>";
								}
								else
								{
									// Pega as dimens�es da imagem
									$dimensoes = getimagesize($foto["tmp_name"]);
									
									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
									//echo "<br>".$ext[1];
									// Gera um nome �nico para a imagem
									//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
						 
									// Caminho de onde ficar� a imagem
									$caminho_imagem = "";
									$caminho_imagem = "picture/rodape.png";// . $ext[1];
						 
									// Faz o upload da imagem para seu respectivo caminho
									move_uploaded_file($foto["tmp_name"], $caminho_imagem);
									echo "<center style='color:green;'><br>Imagem do rodap� atualizada!</center>";
								}
								//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
								// Insere os dados no banco
						////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
							}
						}
					}
					else if(isset($_POST["atualizar_foto"]))/*atualizar rodape*/
					{
						//testa pra saber se a imagem foi carregada
						if($_FILES['rodape']['error']==0)
						{
							$foto = $_FILES['rodape'];
							// Tamanho m�ximo do arquivo em bytes
							$tamanho = 100000; //200 000 bytes equivale 200KB
							
							// Verifica se o tamanho da imagem � maior que o tamanho permitido
							if($foto["size"] > $tamanho)
							{
								echo "<center style='color:red;'><br>A imagem deve ter no m�ximo ".$tamanho." bytes</center><br>";
							}
							else
							{
								$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
								//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
								$extensao = strtolower(end(explode('.', $_FILES['rodape']['name'])));						
								if (array_search($extensao, $_UP['extensoes']) === false)
								{
								   echo "<center style='color:red;'><br>Isso n�o � uma imagem!</center><br>";
								}
								else
								{
									// Pega as dimens�es da imagem
									$dimensoes = getimagesize($foto["tmp_name"]);
									
									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
									//echo "<br>".$ext[1];
									// Gera um nome �nico para a imagem
									//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
						 
									// Caminho de onde ficar� a imagem
									$caminho_imagem = "";
									$caminho_imagem = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png";// . $ext[1];
						 
									// Faz o upload da imagem para seu respectivo caminho
									move_uploaded_file($foto["tmp_name"], $caminho_imagem);
									echo "<center style='color:green;'><br>Foto padr�o atualizada!</center>";
								}
								//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
								// Insere os dados no banco
						////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
							}
						}
					}
					
					/*rodape*/
					if(isset($_GET['rodape']))
					{
						echo "<form method='post' action='admin_site.php?rodape' enctype='multipart/form-data'>
								<br><center>Atualizar imagem do <u>rodap�</u>? (padr�o � 800 x 140)
								<br><input type='file' name='rodape'></center><br>";
						echo "<center><img src='picture/rodape.png' style='width:100%;'>";
						echo "<br><button name='atualizar_rodape'>Atualizar</button></center><br></form>";
					}
					/*foto padr�o*/
					else if(isset($_GET['imagem']))
					{
						echo "<form method='post' action='admin_site.php?imagem' enctype='multipart/form-data'>
								<br><center>Atualizar <u>foto padr�o</u>? (padr�o � 100 x 100)
								<br><input type='file' name='rodape'></center><br>";
						echo "<center><img src='fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png'>";
						echo "<br><button name='atualizar_foto'>Atualizar</button></center><br></form>";
					}
					/*logomarca*/
					else
					{
						echo "<form method='post' action='admin_site.php' enctype='multipart/form-data'>
								<br><center>Atualizar imagem da <u>logomarca</u>? (padr�o � 501 x 98)
								<br><input type='file' name='logo'></center><br>";						
						echo "<center><img src='picture/titulo.png' style='width:100%;'>";
						echo "<br><button name='atualizar_logo'>Atualizar</button></center><br></form>";
					}
				}
				else
				{
					echo "<br><center>� necess�rio ser ADMINISTRADOR!<br>
						<a href='home.php'>P�gina Inicial</a></center><br>";
				}
			?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
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
				<div class="image_title"></div>
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
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								if($user["tipo"]=='a'){$linha=$nome;} else {$linha="<a href='user.php' style='color:black;'>$nome</a>";}//desativar link no nome
								
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
					include_once 'designer.inc'; menu_nulo();
				}
			?>  <!--***MENU***-->
            <div class="content"><!--Conteúdo-->
			<?php			
				if($user["tipo"]=='a')
				{
					if(isset($_POST["atualizar_logo"]))/*atualizar logo*/
					{
						//testa pra saber se a imagem foi carregada
						if($_FILES['logo']['error']==0)
						{
							$foto = $_FILES['logo'];
							// Tamanho máximo do arquivo em bytes
							$tamanho = 100000;
							
							// Verifica se o tamanho da imagem é maior que o tamanho permitido
							if($foto["size"] > $tamanho)
							{
								echo "<center>A imagem deve ter no máximo ".$tamanho." bytes</center><br>";
							}
							else
							{
								$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
								//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
								$extensao = strtolower(end(explode('.', $_FILES['logo']['name'])));						
								if (array_search($extensao, $_UP['extensoes']) === false)
								{
								   echo "<center>Isso não é uma imagem!</center><br>";
								}
								else
								{
									// Pega as dimensões da imagem
									$dimensoes = getimagesize($foto["tmp_name"]);
									
									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
									//echo "<br>".$ext[1];
									// Gera um nome único para a imagem
									//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
						 
									// Caminho de onde ficará a imagem
									$caminho_imagem = "";
									$caminho_imagem = "picture/titulo" . $ext[1];
						 
									// Faz o upload da imagem para seu respectivo caminho
									move_uploaded_file($foto["tmp_name"], $caminho_imagem);
								}
								//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
								// Insere os dados no banco
						////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
							}
						}
					}
					else if(isset($_POST["atualizar_rodape"]))/*atualizar rodape*/
					{
					}
					
					/*logomarca*/
					echo "<br><center>Atualizar imagem da <u>logomarca</u>? (501x98)<input type='file' name='logo'></center><br>";						
					echo "<center><img src='picture/titulo.png'>";
					echo "<br><button name='atualizar_logo'>Atualizar</button></center><hr style='height:10px;background-color:black'>";
					/*rodape*/
					echo "<center>Atualizar imagem do <u>rodapé</u>? (800x140)<input type='file' name='rodape'></center><br>";
					echo "<center><img src='picture/rodape.png'>";
					echo "<br><button name='atualizar_rodape'>Atualizar</button></center><hr style='height:10px;background-color:black'><br>";
				}
				else
				{
					echo "<br><center>É necessário ser ADMINISTRADOR!<br>
						<a href='home.php'>Página Inicial</a></center><br>";
				}
			?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
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
			
			<!--Conteúdo-->
            <div class="content">
				<?php			
					if(isset($_SESSION["logado"]))
					{
						$email = $user["Email"];
						$senha = $user['Senha'];
						
						//pega a imagem do banco de dados
						$foto = $user["Foto"];						
						$caminho_imagem = $foto;
						
						/*clicou para atualuzar dados*/
						if (isset($_POST['atualizar']))
						{
							$nome = $_POST['nome'];
							$email = $_POST['email'];
							$password = $_POST['password'];

							/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
							if (array_search($extensao, $_UP['extensoes']) === false) {
							echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";						
							}else{echo "certo!";}*/
							
							// testa pra ver se os dados foram preenchidos e se as senhas sao iguais
							if(!empty($nome) && !empty($email) && !empty($password)) //(!empty($foto["name"]))
							{
								if($senha == $password)
								{
									//testa pra saber se a imagem foi carregada
									if($_FILES['foto']['error']==0)
									{
										$foto = $_FILES['foto'];
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
											$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
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
												$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
									 
												// Caminho de onde ficará a imagem
												$caminho_imagem = "";
												$caminho_imagem = "fotos/" . $nome_imagem;
									 
												// Faz o upload da imagem para seu respectivo caminho
												move_uploaded_file($foto["tmp_name"], $caminho_imagem);
											}
										}
									}
									$sql = '';
									$sql = "UPDATE administrador SET nome='$nome', email='$email', foto='$caminho_imagem' where cpf='$cpf';";
									//echo "UPDATE administrador SET nome='$nome', email='$email', foto='$caminho_imagem' where cpf='$cpf';";
									mysql_query($sql) or die(mysql_error);
									echo "<br><center style='color:green;'>Atualizado com sucesso!</center><br>";
								}
								else
								{
									echo "<br><center style='color:red;'>Senha inválida!</center><br>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center><br>";
							}
						}
						echo "<form method='post' action='admin.php' enctype='multipart/form-data'>
								<br><center>ATUALIZAR&nbsp&nbsp&nbspDADOS&nbsp?</center>
								<table border='0'>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='15' value='$nome'></td><!--Limmite de 10 dígitos neste campo-->
									</tr>
									<tr>
										<td>* Email</td>
										<td><input type='text' id='txt' name='email' value='$email'></td>
									</tr>
									<tr>
										<td>Senha</td>
										<td><input type='password' id='txt' name='password'></td>
									</tr>
									<tr>
										<td>Desejar escolher uma foto?</td>
										<td><img src='$foto' width='55px' height='60px'><br>
										<input type='file' name='foto'></td>
									</tr>
									<tr>
										<td colspan='2'><br><button name='atualizar'>Atualizar</button></td>
									</tr>
								</table>
							</form>";
					}
					else
					{
						echo "<center>É necessário ser ADMINISTRADOR!<br>
							<a href='home.php'>Página Inicial</a></center><br>";
					}
				?>
			</div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
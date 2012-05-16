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
								global $user;
								$user = mysql_fetch_array($rs);
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
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
			<?php
				if($user["tipo"]=='a')
				{
					include_once 'designer.inc'; menu_admin();
				}
				else
				{
					include_once 'designer.inc'; menu_nulo();
				}
			?>
            <div class="content"><!--Conteúdo-->
				Construindo...Algum problema na hora de atualizar
				<?php			
					if($user["tipo"]=='a')
					{
						$idusuario = $user["idusuario"];
						$sobrenome = $user["sobrenome"];			
						$cpf = $user["cpf"];
						$telefone = $user["telefone"];
						$endereco = $user["endereco"];
						$numero = $user["numero"];
						$bairro = $user["bairro"];
						$cidade = $user["cidade"];
						$email = $user["email"];
						$foto = $user["foto"];
						$usuario = "a";
						
						$caminho_imagem = $foto;
						if (isset($_POST['atualizar']))/*clicou em atualuzar dados*/
						{
							$password = $_POST['password'];
							$password2 = $_POST['password2'];
							// Faz a verificação da extensão do arquivo
							// Array com as extensões permitidas

							/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
							if (array_search($extensao, $_UP['extensoes']) === false) {
							echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";						
							}else{echo "certo!";}*/
							
							// testa pra ver se os dados foram preenchidos
							if(!empty($nome) && !empty($sobrenome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($numero) && !empty($bairro)
								&& !empty($cidade) && !empty($email) && !empty($password) && !empty($password2) && $password==$password2) //(!empty($foto["name"]))
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
										//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
										// Insere os dados no banco
								////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
									}
								}
								include_once "classe.php";
								$obj = new Classe; /* usando a função INSERIR do arquivo classe.php */
								//echo "UPDATE sis_login SET nome='$nome', sobrenome='$sobrenome', cpf='$cpf', telefone='$telefone', endereco='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade', email='$email', senha='$password', foto='$foto', tipo='$usuario' where idusuario='$idusuario';";
								$obj->editar($idusuario, $nome, $sobrenome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $password, $caminho_imagem, $usuario);
								echo "<br><center style='color:green;'>Cadastrado com sucesso!</center><br>";
							}
							else
							{//echo "<br><center style='color:red;'>Construindo! Aguarde...</center>";
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center><br>";
							}
						}
						echo "<form method='post' action='admin.php' enctype='multipart/form-data'>
								<br><center>ATUALIZAR&nbsp&nbsp&nbspDADOS&nbsp?</center>
								<table border='0'>
									<tr>
										<td colspan='2'><u>Dados de Contato</u></td>
									</tr>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' value='$nome'></td><!--Limmite de 10 dígitos neste campo-->
									</tr>
									<tr>
										<td>* Sobrenome</td>
										<td><input type='text' id='txt' name='sobrenome' value='$sobrenome'></td>
									</tr>
									<tr>
										<td>* CPF</td>
										<td><input type='text' id='txt' name='cpf' value='$cpf'></td>
									</tr>
									<tr>
										<td>* Telefone</td>
										<td><input type='text' id='txt' name='telefone' value='$telefone'></td>
									</tr>
									<tr>
										<td colspan='2'><br><u>Dados de Endereço</u></td>
									</tr>
									<tr>
										<td>* Endereço</td>
										<td><input type='text' id='txt' name='endereco' value='$endereco'></td>
									</tr>
									<tr>
										<td>* Número</td>
										<td><input type='text' id='txt' name='numero' value='$numero'></td>
									</tr>
									<tr>
										<td>* Bairro</td>
										<td><input type='text' id='txt' name='bairro' value='$bairro'></td>
									</tr>
									<tr>
										<td>* Cidade</td>
										<td><input type='text' id='txt' name='cidade' value='$cidade'></td>
									</tr>
									<tr>
										<td colspan='2'><br><u>Dados de Identificação</u></td>
									</tr>
									<tr>
										<td>* Email</td>
										<td><input type='text' id='txt' name='email' value='$email'></td>
									</tr>
									<tr>
										<td>* Senha</td>
										<td><input type='password' id='txt' name='password'></td>
									</tr>
									<tr>
										<td>* Confirmação da Senha</td>
										<td><input type='password' id='txt' name='password2'></td>
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
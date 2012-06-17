<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sessão
				session_start();
				include_once 'connect.php';
				
				//verifica se esta logado
				if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
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
					
					//muda a aparencia do site
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
			
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
	
		<!--Principal-->
        <div class="div-borda">
		
			<!--Cabeçalho-->
            <div class="cabecalho">
				<div class="image_title">
					<?php
						include_once 'connect.php';
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
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
						include_once 'connect.php';
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = '';
							$sql = "SELECT * FROM usuario WHERE CPF = '$cpf';";
							
							$rs = '';
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem págs específicas
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
						else if(isset($_SESSION['logado']) && $_SESSION['logado'] == 2)
						{
							$cpf = $_SESSION['cpf_user'];
							$sql = '';
							$sql = "SELECT * FROM administrador WHERE CPF = '$cpf';";
							
							$rs = '';
							$rs = mysql_query($sql) or die (mysql_error());
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								//if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem págs específicas
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
					<?php
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 2)
						{
							//administrador
							include_once 'designer.inc'; menu_admin();
						}
						else
						{
							//usuario
							include_once 'designer.inc'; menu();
						}
					?>
				</ul>
			</div>
			
            <div class="content"><!--Conteúdo-->
				<?php //////////////************CADASTRANDO INCLUSIVE IMAGEM NO BD*********////////////
					 
					$caminho_imagem = 'fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png';
					// Se o usuário clicou no botão cadastrar efetua as ações
					if (isset($_POST['cadastrar']))
					{
						//testa se eh o usuario que esta logado
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
						{
							// Recupera os dados dos campos
							$nome = $_POST['nome'];
							$sobrenome = $_POST['sobrenome'];
							$cpf = $_POST['cpf'];
							$telefone = $_POST['telefone'];
							$endereco = $_POST['endereco'];
							$numero = $_POST['numero'];
							$bairro = $_POST['bairro'];
							$cidade = $_POST['cidade'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$password2 = $_POST['password2'];
							if($user["tipo"]=='a'){$usuario = 'a';}else{$usuario = 'u';}//para cadastro usuário ou admin
							
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
									}
								}
								
								/*include_once 'classe.php';
								$obj = new Classe; /*usando a função INSERIR do arquivo classe.php *
								$obj->inserir($nome, $sobrenome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $password, $caminho_imagem);*/
								echo "<br><center style='color:green;'>Cadastrado com sucesso!</center><br>";
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center><br>";
							}
						}
						else
						{
							//administrador esta logado
							$nome = $_POST['nome'];
							$cpf = $_POST['cpf'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$password2 = $_POST['password2'];

							/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
							if (array_search($extensao, $_UP['extensoes']) === false) {
							echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";						
							}else{echo "certo!";}*/
							
							// testa pra ver se os dados foram preenchidos
							if(!empty($nome) && !empty($cpf) && !empty($email) && !empty($password) && !empty($password2)) //(!empty($foto["name"]))
							{
								if($password==$password2)
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
									//echo "insert into administrador values('$cpf', '$nome', '$password', '$email', '$foto');";
									$sql = "insert into administrador values('$cpf', '$nome', '$password', '$email', '$foto');";
									mysql_query($sql) or die(mysql_error());
									
									/*include_once 'classe.php';
									$obj = new Classe; /*usando a função INSERIR do arquivo classe.php *
									$obj->inserir($nome, $sobrenome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $password, $caminho_imagem);*/
									echo "<br><center style='color:green;'>Cadastrado com sucesso!</center><br>";
								}
								else
								{
									echo "<br><center style='color:red;'>Senhas não são iguais!</center><br>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center><br>";
							}
						}
					}
					/*$est_ses = session_id();
					if(empty($est_ses))
					{
						//inicia a sessao
						session_start();
					}*/
					include_once 'connect.php';					
					
					//testa se existe um usuario logado
					if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
					{
						echo "<br><center>Existe um usuário ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						//testa se existe um administrador logado
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 2)
						{
							echo "<form method='post' action='cadastrar.php' enctype='multipart/form-data'>
								<br><center>CADASTRAMENTO&nbsp&nbsp&nbspDE&nbsp&nbsp&nbspADMINISTRADOR</center>
								<table border='0'>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o nome'></td><!--Limmite de 10 dígitos neste campo-->
									</tr>
									<tr>
										<td>* CPF</td>
										<td><input type='text' id='txt' name='cpf' placeholder='Digite o CPF'></td>
									</tr>
									<tr>
										<td>* Email</td>
										<td><input type='text' id='txt' name='email' placeholder='Digite o email'></td>
									</tr>
									<tr>
										<td>* Senha</td>
										<td><input type='password' id='txt' name='password' placeholder='Digite a senha'></td>
									</tr>
									<tr>
										<td>* Confirmação da Senha</td>
										<td><input type='password' id='txt' name='password2' placeholder='Digite a senha novamente'></td>
									</tr>
									<tr>
										<td>Desejar escolher uma foto?</td>
										<td><img src='$caminho_imagem' width='55px' height='60px'><br>
										<input type='file' name='foto'></td>
									</tr>
									<tr>
										<td colspan='2'><br><button name='cadastrar'>Cadastrar</button></td>
									</tr>
								</table>
							</form>";
						}
						else
						{
							//caso nao tenha nenhuma pessoa logada
							echo "<form method='post' action='cadastrar.php' enctype='multipart/form-data'>
								<br><center>CADASTRAMENTO</center>
								<table border='0'>
									<tr>
										<td colspan='2'><u>Dados de Contato</u></td>
									</tr>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o 1° nome'></td><!--Limmite de 10 dígitos neste campo-->
									</tr>
									<tr>
										<td>* Sobrenome</td>
										<td><input type='text' id='txt' name='sobrenome' placeholder='Digite o sobrenome'></td>
									</tr>
									<tr>
										<td>* CPF</td>
										<td><input type='text' id='txt' name='cpf' placeholder='Digite o CPF'></td>
									</tr>
									<tr>
										<td>* Telefone</td>
										<td><input type='text' id='txt' name='telefone' placeholder='Digite o telefone'></td>
									</tr>
									<tr>
										<td colspan='2'><br><u>Dados de Endereço</u></td>
									</tr>
									<tr>
										<td>* Endereço</td>
										<td><input type='text' id='txt' name='endereco' placeholder='Digite o endereço'></td>
									</tr>
									<tr>
										<td>* Número</td>
										<td><input type='text' id='txt' name='numero' placeholder='Digite o número'></td>
									</tr>
									<tr>
										<td>* Bairro</td>
										<td><input type='text' id='txt' name='bairro' placeholder='Digite o bairro'></td>
									</tr>
									<tr>
										<td>* Cidade</td>
										<td><input type='text' id='txt' name='cidade' placeholder='Digite a cidade'></td>
									</tr>
									<tr>
										<td colspan='2'><br><u>Dados de Identificação</u></td>
									</tr>
									<tr>
										<td>* Email</td>
										<td><input type='text' id='txt' name='email' placeholder='Digite o email'></td>
									</tr>
									<tr>
										<td>* Senha</td>
										<td><input type='password' id='txt' name='password' placeholder='Digite a senha'></td>
									</tr>
									<tr>
										<td>* Confirmação da Senha</td>
										<td><input type='password' id='txt' name='password2' placeholder='Digite a senha novamente'></td>
									</tr>
									<tr>
										<td>Desejar escolher uma foto?</td>
										<td><img src='$caminho_imagem' width='55px' height='60px'><br>
										<input type='file' name='foto'></td>
									</tr>
									<tr>
										<td colspan='2'><br><button name='cadastrar'>Cadastrar</button></td>
									</tr>
								</table>
							</form>";
						}
					}
				?>
            </div>
			
			<!--rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
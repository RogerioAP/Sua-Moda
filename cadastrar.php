<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sess�o
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
		
			<!--Cabe�alho-->
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
					<?php
						//dependendo da pessoa que esta logada exibe um menu diferente
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
			<br />
			<!--Conte�do-->
            <div class="content">
				<?php
					 
					$caminho_imagem = 'fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png';
					
					// Se o usu�rio clicou no bot�o cadastrar efetua as a��es
					if (isset($_POST['cadastrar']))
					{
						//administrador esta logado
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 2)
						{
							$nome = $_POST['nome'];
							$cpf = $_POST['cpf'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$password2 = $_POST['password2'];

							/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
							if (array_search($extensao, $_UP['extensoes']) === false) {
							echo "Por favor, envie arquivos com as seguintes extens�es: jpg, png ou gif";						
							}else{echo "certo!";}*/
							
							// testa pra ver se os dados foram preenchidos
							if(!empty($nome) && !empty($cpf) && !empty($email) && !empty($password) && !empty($password2)) //(!empty($foto["name"]))
							{
								if($password==$password2)
								{
									if(strlen($cpf) == 14)
									{
										//testa pra saber se a imagem foi carregada
										if($_FILES['foto']['error']==0)
										{
											$foto = $_FILES['foto'];
											// Tamanho m�ximo do arquivo em bytes
											$tamanho = 100000;
											
											// Verifica se o tamanho da imagem � maior que o tamanho permitido
											if($foto["size"] > $tamanho)
											{
												echo "<center>A imagem deve ter no m&aacute;ximo ".$tamanho." bytes</center><br>";
											}
											else
											{
												$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
												//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
												$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
												if (array_search($extensao, $_UP['extensoes']) === false)
												{
												   echo "<center>Isso n&atilde;o &eacute; uma imagem!</center><br>";
												}
												else
												{
													// Pega as dimens�es da imagem
													$dimensoes = getimagesize($foto["tmp_name"]);
													
													preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
													//echo "<br>".$ext[1];
													// Gera um nome �nico para a imagem
													$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
										 
													// Caminho de onde ficar� a imagem
													$caminho_imagem = "";
													$caminho_imagem = "fotos/" . $nome_imagem;
										 
													// Faz o upload da imagem para seu respectivo caminho
													move_uploaded_file($foto["tmp_name"], $caminho_imagem);
												}
											}
										}
										$sql = '';
										$sql = "insert into administrador values('$cpf', '$nome', '$password', '$email', '$caminho_imagem');";
										//echo "insert into administrador values('$cpf', '$nome', '$password', '$email', '$caminho_imagem');";
										mysql_query($sql) or die(mysql_error());
										
										echo "<br><center style='color:green;'>Administrador cadastrado com sucesso!</center><br>";
									}
									else
									{
										echo "<br><center style='color:red;'>O CPF n�o est� em formato v�lido!</center><br>";
									}
								}
								else
								{
									echo "<br><center style='color:red;'>Senhas n�o s�o iguais!</center><br>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * n�o podem ficar em branco!</center><br>";
							}
						}
						else
						{
							//usuario esta logado
							$nome = $_POST['nome'];
							$sobrenome = $_POST['sobrenome'];
							$cpf = $_POST['cpf'];//echo mask($cpf,'###.###.###-##');
							$telefone = $_POST['telefone'];
							$endereco = $_POST['endereco'];
							$numero = $_POST['numero'];
							$bairro = $_POST['bairro'];
							$cidade = $_POST['cidade'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$password2 = $_POST['password2'];

							/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
							if (array_search($extensao, $_UP['extensoes']) === false) {
							echo "Por favor, envie arquivos com as seguintes extens�es: jpg, png ou gif";						
							}else{echo "certo!";}*/
							
							// testa pra ver se os dados foram preenchidos e senhas estao iguais
							if(!empty($nome) && !empty($sobrenome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($numero) && !empty($bairro)
								&& !empty($cidade) && !empty($email) && !empty($password) && !empty($password2) && $password==$password2) //(!empty($foto["name"]))
							{
								if(strlen($cpf) == 14)
								{
									//testa pra saber se a imagem foi carregada
									if($_FILES['foto']['error']==0)
									{
										$foto = $_FILES['foto'];
										// Tamanho m�ximo do arquivo em bytes
										$tamanho = 100000;
										
										// Verifica se o tamanho da imagem � maior que o tamanho permitido
										if($foto["size"] > $tamanho)
										{
											echo "<center>A imagem deve ter no m�ximo ".$tamanho." bytes</center><br>";
										}
										else
										{
											$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
											//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
											$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
											if (array_search($extensao, $_UP['extensoes']) === false)
											{
											   echo "<center>Isso n�o � uma imagem!</center><br>";
											}
											else
											{
												// Pega as dimens�es da imagem
												$dimensoes = getimagesize($foto["tmp_name"]);
												
												preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
												//echo "<br>".$ext[1];
												// Gera um nome �nico para a imagem
												$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
									 
												// Caminho de onde ficar� a imagem
												$caminho_imagem = "";
												$caminho_imagem = "fotos/" . $nome_imagem;
									 
												// Faz o upload da imagem para seu respectivo caminho
												move_uploaded_file($foto["tmp_name"], $caminho_imagem);
											}
										}
									}
									/*$sql = '';
									$sql = "insert into usuario values('$cpf', '$nome', '$sobrenome', '$password', '$email', '$telefone', '$endereco', '$numero', '$bairro', '$cidade', '$caminho_imagem', 'hello');";
									mysql_query($sql) or die(mysql_error());
									echo "<br><center style='color:green;'>Usu�rio cadastrado com sucesso!</center><br>";*/
								}
								else
								{
									echo "<br><center style='color:red;'>O CPF n�o est� em formato v�lido!</center><br>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * n�o podem ficar em branco!</center><br>";
							}
						}
					}
					
					include_once 'connect.php';					
					
					//testa se existe um usuario logado
					if(isset($_SESSION['logado']) && $_SESSION['logado'] == 1)
					{
						echo "<br><center>Existe um usu�rio ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						//testa se existe um administrador logado
						if(isset($_SESSION['logado']) && $_SESSION['logado'] == 2)
						{
							echo "<form id=\"formtabela\" method='post' action='cadastrar.php' enctype='multipart/form-data'>
								<br><center>CADASTRAMENTO&nbsp&nbsp&nbspDE&nbsp&nbsp&nbspADMINISTRADOR</center>
								<table cellspacing=\"5\">
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o nome'></td><!--Limmite de 10 d�gitos neste campo-->
									</tr>
									<tr>
										<td>* CPF</td>
										<td><input type='text' id='txt' maxlength='14' name='cpf' onKeyUp=\"moeda(this);\" placeholder='Ex: 000.000.000-00'></td>
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
										<td>* Confirma��o da Senha</td>
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
								<table id=\"tabcadastro\" border='0'>
									<tr>
										<td colspan='2'>Dados de Contato</td>
									</tr>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite seu primeiro nome'></td><!--Limmite de 10 d�gitos neste campo-->
									</tr>
									<tr>
										<td>* Sobrenome</td>
										<td><input type='text' id='txt' name='sobrenome' placeholder='Digite seu sobrenome'></td>
									</tr>
									<tr>
										<td>* CPF</td>
										<td><input type='text' id='txt' name='cpf' maxlength='14' onKeyUp=\"moeda(this);\" placeholder='Ex: 000.000.000-00'></td>
									</tr>
									<tr>
										<td>* Telefone</td>
										<td><input type='text' id='txt' name='telefone' placeholder='Digite seu telefone'></td>
									</tr>
									<tr>
										<td colspan='2'><br>Dados de Endere&ccedil;o</td>
									</tr>
									<tr>
										<td>* Endere&ccedil;o</td>
										<td><input type='text' id='txt' name='endereco' placeholder='Digite o endere&ccedil;o'></td>
									</tr>
									<tr>
										<td>* N&uacute;mero</td>
										<td><input type='text' id='txt' name='numero' placeholder='Digite seu n&uacute;mero'></td>
									</tr>
									<tr>
										<td>* Bairro</td>
										<td><input type='text' id='txt' name='bairro' placeholder='Digite seu bairro'></td>
									</tr>
									<tr>
										<td>* Cidade</td>
										<td><input type='text' id='txt' name='cidade' placeholder='Digite sua cidade'></td>
									</tr>
									<tr>
										<td colspan='2'><br>Dados de Identifica&ccedil;&atilde;o</td>
									</tr>
									<tr>
										<td>* E-mail</td>
										<td><input type='text' id='txt' name='email' placeholder='Digite seu e-mail'></td>
									</tr>
									<tr>
										<td>* Senha</td>
										<td><input type='password' id='txt' name='password' placeholder='Digite sua senha'></td>
									</tr>
									<tr>
										<td>* Confirma&ccedil;&atilde;o da Senha</td>
										<td><input type='password' id='txt' name='password2' placeholder='Digite sua senha novamente'></td>
									</tr>
									<tr>
										<td>Deseja escolher uma foto?</td>
										<td><img src='$caminho_imagem' width='45px' height='45px'><br>
										<input type='file' name='foto'></td>
									</tr>
									<tr>
										<td colspan='2'><br><button name='cadastrar'>Cadastrar</button></td>
									</tr>
								</table>
							</form>";
						}
					}
					
					//funcao que define o formato do cpf
					function mask($val, $mask)
					{
						 $maskared = '';
						 $k = 0;
						 for($i = 0; $i<=strlen($mask)-1; $i++)
						 {
							 if($mask[$i] == '#')
							 {
								 if(isset($val[$k]))
								 $maskared .= $val[$k++];
							 }
							 else
							 {
								 if(isset($mask[$i]))
								 $maskared .= $mask[$i];
							 }
						 }
						 return $maskared;
					}
				?>
            </div>
			
			<!--rodape-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>

<!--Javascript de mascara para valor em R$ -->
<script language='javascript'>
        function moeda(z){  
                v = z.value;
                v=v.replace(/\D/g,"")  //permite digitar apenas n�meros
        v=v.replace(/[0-9]{12}/,"inv�lido")   //limita pra m�ximo 999.999.999,99
        v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos �ltimos 8 digitos
        v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos �ltimos 5 digitos
        v=v.replace(/(\d{1})(\d{1,2})$/,"$1-$2")        //coloca virgula antes dos �ltimos 2 digitos
                z.value = v;
        }
</script>
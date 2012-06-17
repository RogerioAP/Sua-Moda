<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sess�o
				session_start();
				include_once 'connect.php';
				
				//verifica se esta logado
				if(isset($_SESSION['logado']))
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
					<?php
						include_once 'connect.php';
						if(isset($_SESSION['logado']))
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
						$caminho_imagem = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png"; /*imagem que vai ser utilizada como padr�o caso o cliente n�o escolha nenhuma*/
						//Iniciando a sess�o
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
			
			<!--***MENU***-->
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>
			
            <div class="content"><!--Conte�do-->
				<?php //////////////************CADASTRANDO INCLUSIVE IMAGEM NO BD*********////////////
					// Conex�o com o banco de dados
					//$conn = @mysql_connect("localhost", "root", '') or die ("Problemas na conex�o com o banco de dados.");
					//$db = @mysql_select_db("site", $conn) or die ("Problemas na conex�o com a tabela de dados.");
					 
					// Se o usu�rio clicou no bot�o cadastrar efetua as a��es
					if (isset($_POST['cadastrar']))
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
						if($user["tipo"]=='a'){$usuario = 'a';}else{$usuario = 'u';}//para cadastro usu�rio ou admin
						
						// Faz a verifica��o da extens�o do arquivo
						// Array com as extens�es permitidas

						/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
						if (array_search($extensao, $_UP['extensoes']) === false) {
						echo "Por favor, envie arquivos com as seguintes extens�es: jpg, png ou gif";						
						}else{echo "certo!";}*/
						
						// testa pra ver se os dados foram preenchidos
						if(!empty($nome) && !empty($sobrenome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($numero) && !empty($bairro)
							&& !empty($cidade) && !empty($email) && !empty($password) && !empty($password2) && $password==$password2) //(!empty($foto["name"]))
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
									//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
									// Insere os dados no banco
							////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
								}
							}
							include_once "classe.php";
							$obj = new Classe; /* usando a fun��o INSERIR do arquivo classe.php */
							$obj->inserir($nome, $sobrenome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $password, $caminho_imagem);
							echo "<br><center style='color:green;'>Cadastrado com sucesso!</center><br>";
						}
						else
						{
							echo "<br><center style='color:red;'>Os campos com * n�o podem ficar em branco!</center><br>";
						}
					}
					$est_ses = session_id();
					if(empty($est_ses))
					{
						//inicia a sessao
						session_start();
					}
					include_once("connect.php");
					
					$texto = "CADASTRAMENTO";
					$tipo = "";
					if(isset($_SESSION['logado'])){$tipo = $user["tipo"];if($tipo=='a'){$texto='ADICIONAR&nbsp&nbsp&nbsp&nbspADMINISTRADOR';}}/*pega o tipo de usu�rio logado*/
					if(isset($_SESSION['logado']) && $tipo == 'u') /*se existir usu�rio logado d� ERRO (afinal como logar em outra conta j� estando logado)*/
					{
						echo "<br><center>Existe um usu�rio ativo no momento, <a href='logout.php'>clique aqui</a> para sair e entrar em outra conta.</center><br>";
					}
					else
					{
						echo "<form method='post' action='cadastrar.php' enctype='multipart/form-data'>
							<br><center>$texto</center>
							<table border='0'>
								<tr>
									<td colspan='2'><u>Dados de Contato</u></td>
								</tr>
								<tr>
									<td>* Nome</td>
									<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o 1� nome'></td><!--Limmite de 10 d�gitos neste campo-->
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
									<td colspan='2'><br><u>Dados de Endere�o</u></td>
								</tr>
								<tr>
									<td>* Endere�o</td>
									<td><input type='text' id='txt' name='endereco' placeholder='Digite o endere�o'></td>
								</tr>
								<tr>
									<td>* N�mero</td>
									<td><input type='text' id='txt' name='numero' placeholder='Digite o n�mero'></td>
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
									<td colspan='2'><br><u>Dados de Identifica��o</u></td>
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
				?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
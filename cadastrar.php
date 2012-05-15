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
						$imagem_padrao = "fotos/803fbd58f1ed97adb518c3b2f6cc6d7a.png"; /*imagem que vai ser utilizada como padrão caso o cliente não escolha nenhuma*/
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
								$nome1 = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								$nome = "";
								for($cont=0; $nome1[$cont]!=' '; $cont++) /*pegar apenas 1° nome*/
								{
									$nome = $nome.$nome1[$cont]; /* $nome e o 1° nome*/
								}
								echo "<table border='0' style='float:right'>
										<tr>
											<td colspan='2'><img src='$foto' width='80px'></td>
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
				<?php //////////////************CADASTRANDO INCLUSIVE IMAGEM NO BD*********////////////
					// Conexão com o banco de dados
					$conn = @mysql_connect("localhost", "root", '') or die ("Problemas na conexão com o banco de dados.");
					$db = @mysql_select_db("site", $conn) or die ("Problemas na conexão com a tabela de dados.");
					 
					// Se o usuário clicou no botão cadastrar efetua as ações
					if (isset($_POST['cadastrar']))
					{
						// Recupera os dados dos campos
						$nome = $_POST['nome'] ." ". $_POST['sobrenome'];
						$cpf = $_POST['cpf'];
						$telefone = $_POST['telefone'];
						$endereco = $_POST['endereco'];
						$numero = $_POST['numero'];
						$bairro = $_POST['bairro'];
						$cidade = $_POST['cidade'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
						$usuario = 'u';
						
						// Faz a verificação da extensão do arquivo
						// Array com as extensões permitidas

						/*$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));						
						if (array_search($extensao, $_UP['extensoes']) === false) {
						echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";						
						}else{echo "certo!";}*/
						
						// testa pra ver se os dados foram preenchidos
						if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($numero) && !empty($bairro)
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
										$caminho_imagem = "fotos/" . $nome_imagem;
							 
										// Faz o upload da imagem para seu respectivo caminho
										move_uploaded_file($foto["tmp_name"], $caminho_imagem);
									}
									//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
									// Insere os dados no banco
							////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
								}
							}
							else
							{
								$caminho_imagem = "fotos/" . $imagem_padrao;
							}
							include "classe.php";
							$obj = new Classe; /* usando a função INSERIR do arquivo classe.php */
							$obj->inserir($nome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $password, $caminho_imagem, $usuario);
							echo "<br><center style='color:green;'>Cadastrado com sucesso!</center><br>";
						}
						else
						{//echo "<br><center style='color:red;'>Construindo! Aguarde...</center>";
							echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center><br>";
						}
					}
				?>
				<form method="post" action="cadastrar.php" enctype="multipart/form-data">
					<br><center>CADASTRAMENTO</center>
					<table border="0">
						<tr>
							<td colspan="2"><u>Dados de Contato</u></td>
						</tr>
						<tr>
							<td>* Nome</td>
							<td><input type="text" id="txt" name="nome" maxlength="10" placeholder="Digite o 1° nome"></td><!--Limmite de 10 dígitos neste campo-->
						</tr>
						<tr>
							<td>* Sobrenome</td>
							<td><input type="text" id="txt" name="sobrenome" placeholder="Digite o sobrenome"></td>
						</tr>
						<tr>
							<td>* CPF</td>
							<td><input type="text" id="txt" name="cpf" placeholder="Digite o CPF"></td>
						</tr>
						<tr>
							<td>* Telefone</td>
							<td><input type="text" id="txt" name="telefone" placeholder="Digite o telefone"></td>
						</tr>
						<tr>
							<td colspan="2"><br><u>Dados de Endereço</u></td>
						</tr>
						<tr>
							<td>* Endereço</td>
							<td><input type="text" id="txt" name="endereco" placeholder="Digite o endereço"></td>
						</tr>
						<tr>
							<td>* Número</td>
							<td><input type="text" id="txt" name="numero" placeholder="Digite o número"></td>
						</tr>
						<tr>
							<td>* Bairro</td>
							<td><input type="text" id="txt" name="bairro" placeholder="Digite o bairro"></td>
						</tr>
						<tr>
							<td>* Cidade</td>
							<td><input type="text" id="txt" name="cidade" placeholder="Digite a cidade"></td>
						</tr>
						<tr>
							<td colspan="2"><br><u>Dados de Identificação</u></td>
						</tr>
						<tr>
							<td>* Email</td>
							<td><input type="text" id="txt" name="email" placeholder="Digite o email"></td>
						</tr>
						<tr>
							<td>* Senha</td>
							<td><input type="password" id="txt" name="password" placeholder="Digite a senha"></td>
						</tr>
						<tr>
							<td>* Confirmação da Senha</td>
							<td><input type="password" id="txt" name="password2" placeholder="Digite a senha novamente"></td>
						</tr>
						<tr>
							<td>Desejar escolher uma foto?</td>
							<td><img src="<?php echo $imagem_padrao ?>"><br>
							<input type="file" name="foto"></td>
						</tr>
						<tr>
							<td colspan="2"><br><button name="cadastrar">Cadastrar</button></td>
						</tr>
					</table>
				</form>				
				<!--$_FILES['foto']['error']!=0){echo "<br>Erro";}
				testando se foi feito upload-->
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
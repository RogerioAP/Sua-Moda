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
					if($user["tipo"]=='a')/*verificar se quem esá logado é uma admin*/
					{//echo "falta só preparar o BD";
						echo "<center><a href='admin_produtos.php?listar'><div style='width:390px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Listar</div></a>
								<a href='admin_produtos.php?adicionar'><div style='width:390px;height:30px;padding-top:5px;background-color:#f8f8ff;float:right;color:red;'>Adicionar</div></a></center><br>";
						
						if (isset($_POST['adicionar_produto']))/*clicou em adicionar produto*/
						{
							$caminho_imagem = "";
							$caminho_imagem = "produtos/759f0b44b6c2bd4f5a169f862e8f4923.gif";/*imagem para produto sem imagem*/
							
							$nome = $_POST['nome'];
							$descricao = $_POST['descricao'];
							$preco = $_POST['preco'];
							$categoria = $_POST['categoria'];
							if($_POST['descricao'] == ''){$descricao = 'Sem dados extra';}
							
							if($categoria=='Acessórios'){$categoria='';$categoria='aces';} //adapta opções p/ não dá problema no BD por caracteres especiais
							if($categoria=='Vestuário'){$categoria='';$categoria='vest';}
							if($categoria=='Gadgets'){$categoria='';$categoria='gadg';}// echo $categoria;
							
							if(!empty($nome) && !empty($preco) && !empty($categoria)) //(!empty($foto["name"]))
							{
								//testa pra saber se a imagem foi carregada
								if($_FILES['imagem']['error']==0)
								{
									$foto = $_FILES['imagem'];
									// Tamanho máximo do arquivo em bytes
									$tamanho = 100000;
									
									// Verifica se o tamanho da imagem é maior que o tamanho permitido
									if($foto["size"] > $tamanho)
									{
										echo "<center>A imagem deve ter no máximo ".$tamanho." bytes</center>";
									}
									else
									{
										$_UP['extensoes'] = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
										//if($ext[1] != "jpg" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "jpg" && $ext[1] != "jpeg")
										$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));						
										if (array_search($extensao, $_UP['extensoes']) === false)
										{
										   echo "<center>Isso não é uma imagem!</center>";
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
											$caminho_imagem = "produtos/" . $nome_imagem;
								 
											// Faz o upload da imagem para seu respectivo caminho
											move_uploaded_file($foto["tmp_name"], $caminho_imagem);
										}
										//echo "INSERT INTO usuarios VALUES (null, \"$nome\", \"$email\", \"$nome_imagem\");";
										// Insere os dados no banco
								////////$sql = mysql_query("INSERT INTO sis_login VALUES (null, \"$nome\", \"$email\", \"$password\", \"$caminho_imagem\");");//\"rog\", \"ema\", \"nom\")");//(null, '".$nome."', '".$email."', '".$nome_imagem."')");
									}
								}
								include_once 'classe.php';
								$obj = new Classe; /* usando a função INSERIR do arquivo classe.php */
								//echo "UPDATE sis_login SET nome='$nome', sobrenome='$sobrenome', cpf='$cpf', telefone='$telefone', endereco='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade', email='$email', senha='$password', foto='$foto', tipo='$usuario' where idusuario='$idusuario';";
								$obj->inserir_produto($nome, $descricao, $preco, $categoria, $caminho_imagem);
								echo "<br><center style='color:green;'>Produto adicionado com sucesso!</center>";
							}
							else
							{//echo "<br><center style='color:red;'>Construindo! Aguarde...</center>";
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center>";
							}
						}
						
						if(isset($_GET['listar']))
						{echo "Falta implementar funções no EDITAR e EXCLUIR";
							include_once("connect.php");
							$sql = "SELECT * FROM produtos;";
							$rs = mysql_query($sql);
							echo "<br><center>PRODUTOS</center><br>
							<table border=0>
							<tr style='text-align:center;'>
								<td>NOME</td>
								<td>DESCRIÇÃO</td>
								<td>PREÇO</td>
								<td>CATEGORIA</td>
								<td>IMAGEM</td>
								<td colspan=2>OPÇÕES</td>
							</tr>";
							$cont =  0;
							
							while($linha = mysql_fetch_assoc($rs))
							{
								if($cont%2!=0){ echo "<tr style='background-color:#ffff99;text-align:center;'>";}
								else { echo "<tr style='background-color:#ffffff;text-align:center;'>";}
								$nome = $linha["nome"];
								$descricao = $linha["descricao"];
								$preco = $linha["preco"];
								$categoria = $linha["categoria"];
								$imagem = $linha["imagem"];
								
								echo "<td>$nome</td>";
								echo "<td>$descricao</td>";
								echo "<td>R$ $preco</td>";
								
								if($categoria=='aces'){$categoria='Acessórios';} //adapta opções p/ não dá problema no BD por caracteres especiais
								else if($categoria=='vest'){$categoria='Vestuário';}
								else if($categoria=='gadg'){$categoria='Gadgets';}// echo $categoria;
								
								echo "<td>$categoria</td>";
								echo "<td><img src='$imagem' style='width:100px;height:90px;'></td>";
								echo "<td><button>Editar</button></td>";
								echo "<td><button>Excluir</button></td>";
								echo "</tr>";
								$cont++;
							}
							echo "</table>";
						}
						else //adicionar produtos nesse else
						{
							echo "<form method='post' action='admin_produtos.php' enctype='multipart/form-data'>
								<br><center>ADICIONAR&nbsp&nbsp&nbsp&nbspPRODUTO</center>
								<table border='0'>
									<tr>
										<td class='tex'>* Nome</td>
										<td class='cai'><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o nome'></td><!--Limmite de 10 dígitos neste campo-->
									</tr>
									<tr>
										<td class='tex'>Descrição</td>
										<td class='cai'><input type='text' id='txt' name='descricao' placeholder='Digite a descrição'></td>
									</tr>
									<tr>
										<td class='tex'>* Preço R$</td>
										<td class='cai'><input type='text' id='txt' name='preco' placeholder='Digite o preço'></td>
									</tr>
									<tr>
										<td class='tex'>* Categoria</td>
										<td class='cai'>
											<select name='categoria'>
												<option>Acessórios</option>
												<option>Vestuário</option>
												<option>Gadgets</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class='tex'>Imagem</td>
										<td class='cai'><input type='file' name='imagem'></td>
									</tr>
									<tr>
										<td colspan='2'><br><button name='adicionar_produto'>Cadastrar</button></td>
									</tr>
								</table>
							</form>";
						}
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
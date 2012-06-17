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
					if(isset($_SESSION["logado"])) /*verificar se quem esá logado é uma admin*/
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
							
							if($categoria=='Acessórios'){$categoria='';$categoria='acessorios';} //adapta opções p/ não dá problema no BD por caracteres especiais
							if($categoria=='Vestuário'){$categoria='';$categoria='vestuario';}
							if($categoria=='Gadgets'){$categoria='';$categoria='gadgets';}// echo $categoria;
							
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
								$sql = '';
								$sql = "INSERT INTO produto values(null, '$nome', '$descricao', '$categoria', '$preco')";
								mysql_query($sql) or die(mysql_error());
								$sql = '';
								$sql = "INSERT INTO imagens values(null, '$caminho_imagem', '', '')";
								mysql_query($sql) or die(mysql_error());
								
								echo "<br><center style='color:green;'>Produto adicionado com sucesso!</center>";
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos com * não podem ficar em branco!</center>";
							}
						}
						
						//lista os produtos cadastrados
						if(isset($_GET['listar']))
						{
							include_once 'connect.php';
							$sql = "select produto.idproduto, produto.Nome, produto.Descricao, produto.Categoria, produto.Preco, imagens.imagem1 from produto,
									imagens where produto.idproduto=imagens.idproduto order by produto.idproduto desc;";
							$rs = mysql_query($sql);
							echo "<br><center>PRODUTOS</center><br>
							<table border=0>
							<tr style='text-align:center;'>
								<td style='background-color:#e8e8e8;'>NOME</td>
								<td style='background-color:#e8e8e8;'>DESCRIÇÃO</td>
								<td style='background-color:#e8e8e8;'>PREÇO</td>
								<td style='background-color:#e8e8e8;'>CATEGORIA</td>
								<td style='background-color:#e8e8e8;'>IMAGEM</td>
								<td  style='background-color:#e8e8e8;' colspan=2>OPÇÕES</td>
							</tr>";
							$cont =  0;
							
							while($linha = mysql_fetch_assoc($rs))
							{
								//para variar entre duas cores
								if($cont%2==0){ echo "<tr style='background-color:#ffff99;text-align:center;'>";}
								else { echo "<tr style='background-color:#ffffff;text-align:center;'>";}
								
								//pega dados de compras
								$nome = $linha["Nome"];
								$descricao = $linha["Descricao"];
								$preco = $linha["Preco"];
								$categoria = $linha["Categoria"];
								$imagem = $linha["imagem1"];
								
								echo "<td>$nome</td>";
								echo "<td>$descricao</td>";
								echo "<td>R$ $preco</td>";
								
								//adapta opções p/ não dá problema no BD por caracteres especiais
								if($categoria=='aces'){$categoria='Acessórios';}
								else if($categoria=='vest'){$categoria='Vestuário';}
								else if($categoria=='gadg'){$categoria='Gadgets';}
								
								echo "<td>$categoria</td>";
								echo "<td><img src='$imagem' style='width:100px;height:90px;'></td>";
								echo "<td><button onclick='window.location=\"#\"'>Editar</button></td>";
								echo "<td><button onclick='window.location=\"#\"'>Excluir</button></td>";
								echo "</tr>";
								$cont++;
							}
							echo "</table>";
						}
						else //adicionar produtos nesse else
						{
							
							echo "<form method='post' action='admin_produtos.php' enctype='multipart/form-data' name='form1'>
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
										<td class='cai'><input type='text' id='txt' name='preco' onKeyUp=\"moeda(this);\" placeholder='Digite o preço'></td>
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
										<td class='tex'>Deseja inserir imagem&nbsp?</td>
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

<!--Javascript de mascara para valor em R$ -->
<script language='javascript'>
        function moeda(z){  
                v = z.value;
                v=v.replace(/\D/g,"")  //permite digitar apenas números
        v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
        v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
        v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
        v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")        //coloca virgula antes dos últimos 2 digitos
                z.value = v;
        }
</script>
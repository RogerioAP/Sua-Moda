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
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
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
			Construindo...
				<table border='1'>
					<tr>
						<?php
							if(isset($_GET['dp']))
							{
								echo "<td rowspan='4' class='dados-user'>
								<table border='0'>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o 1° nome'></td>
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
										<td colspan='2'><button name='salvarDP'>Salvar</button></td>
									</tr>
								</table>
								</td>";
							}
							else if(isset($_GET['de']))
							{
								echo "<td rowspan='4' class='dados-user'>
								<table border='1'>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o 1° nome'></td>
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
										<td colspan='2'><button name='salvarDP'>Salvar</button></td>
									</tr>
								</table>
								</td>";
							}
							else if(isset($_GET['di']))
							{
								echo "<td rowspan='4' class='dados-user'>
								<table border='1'>
									<tr>
										<td>* Nome</td>
										<td><input type='text' id='txt' name='nome' maxlength='10' placeholder='Digite o 1° nome'></td>
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
										<td colspan='2'><button name='salvarDP'>Salvar</button></td>
									</tr>
								</table>
								</td>";
							}
							else if(isset($_GET['s']))
							{
								echo "<td rowspan='4' class='dados-user'>Construindo 'senha'...</td>";
							}
							else {echo "<td rowspan='4' class='dados-user'>Construindo 'dados pessoais'...</td>";}
						?>
						<td class='itens-user'><a href="user.php?dp">Dados Pessoais</a></td>
					</tr>
					<tr>
						<td class='itens-user'><a href="user.php?de">Dados de Endereço</a></td>
					</tr>
					<tr>
						<td class='itens-user'><a href="user.php?di">Dados de Identificação</a></td>
					</tr>
					<tr>
						<td class='itens-user'><a href="user.php?s">Senha</a></td>
					</tr>
				</table>
				<!--
					//$origem = $_SERVER["HTTP_REFERER"];  para pegar a origem da visita
					if(isset($_SESSION["logado"]))  /*se existir um usuário logado*
					{
						echo "<center>
								<br>Deseja alterar seus dados?
								<form method='post' action='#' enctype='multpart/form-data'>
									<table border=0>
										<tr>
											<td>Nome</td>
											<td><input type='text' id='txt' name='nome' placeholder='Digite o 1° nome'></td>
										</tr>
										<tr>
											<td>Sobrenome</td>
											<td><input type='text' id='txt' name='sobrenome' placeholder='Digite o sobrenome'></td>
										</tr>
										<tr>
											<td>Foto</td>
											<td><input type='file' id='txt' name='email'></td>
										</tr>
										<tr>
											<td colspan='2'><button name='alterar'>Alterar</button></td>
										</tr>
									</table>
								<form>
							  </center>";
					}
					else
					{
						echo "<br><center>Não existe usuário ativo no momento! Faça o <a href='login.php'>login</a> ou <a href='cadastrar.php'>registre-se</a>.</center><br>";
					}-->
				
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
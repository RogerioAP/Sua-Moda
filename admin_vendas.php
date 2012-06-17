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
					include_once 'connect.php';
					$sql = "SELECT * FROM compra;";
					$rs = mysql_query($sql);
					echo "<br><center style='clear:both;'>RELATÓRIO DE VENDAS</center><br>
					<table border=0>
					<tr>
						<td style='background-color:#e8e8e8;'>CLIENTE</td>
						<td style='background-color:#e8e8e8;'>PRODUTO</td>
						<td style='background-color:#e8e8e8;'>VALOR TOTAL R$</td>
						<td style='background-color:#e8e8e8;'>DATA</td>
					</tr>";
			
					while($linha = mysql_fetch_assoc($rs))
					{
						$sql2 = '';
						$cpf = $linha['CPF'];
						$sql2 = "select usuario.nome, usuario.sobrenome from usuario where cpf='$cpf';";
						$rs2 = '';
						$rs2 = mysql_query($sql2) or die(mysql_error());
						$user = '';
						$user = mysql_fetch_array($rs2);
						//nome do cliente
						$nome = $user["nome"];
						$sobrenome = $user['sobrenome'];
						$nome = $nome. " " . $sobrenome;
						
						$sql3 = '';
						$id = $linha['idProduto'];
						$sql3 = "select produto.nome from produto where idproduto='$id';";
						$rs3 = '';
						$rs3 = mysql_query($sql3) or die(mysql_error());
						$user = '';
						$user = mysql_fetch_array($rs3);
						//nome do produto
						$produto = $user["nome"];
						
						$valor = $linha["valor"];
						$data = $linha["data"];
						
						//exibe na tabela
						echo "<tr>";
						echo "<td>$nome</td>";
						echo "<td>$produto</td>";
						echo "<td>$valor</td>";
						echo "<td>$data</td>";
						echo "</tr>";
					}
					echo "</table>";
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
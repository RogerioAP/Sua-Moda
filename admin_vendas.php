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
				if($user["tipo"]=='a')
				{echo "falta só preparar o BD";
					include_once("connect.php");
					$sql = "SELECT * FROM sis_login;";
					$rs = mysql_query($sql);
					echo "<center>RELATÓRIO DE VENDAS</center>
					<table border=1>
					<tr>
						<td>CLIENTE</td>
						<td>VALOR TOTAL R$</td>
						<td>DATA</td>
					</tr>";
			
					while($linha = mysql_fetch_assoc($rs))
					{
						echo "<tr>";
						$nome = $linha["nome"];
						$email = $linha["email"];
						$senha = $linha["senha"];
						echo "<td>$nome</td>";
						echo "<td>$email</td>";
						echo "<td>$senha</td>";
						echo "</tr></table>";
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
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
            <div class="menu"><!--Menu-->
                <table>
                    <tr>
                        <td><a href="home.php" style="text-decoration: none; color: #ffffff;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ffffff'">Home</a></td>
                        <td><a href="produtos.php" style="text-decoration: none; color: #ffffff;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ffffff'">Produtos</a></td>
                        <td><a href="servicos.php" style="text-decoration: none; color: #ffffff;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ffffff'">Serviços</a></td>
                        <td><a href="quemsomos.php" style="text-decoration: none; color: #ffffff;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ffffff'">Quem somos</a></td>
                        <td><a href="contatos.php" style="text-decoration: none; color: #ffffff;" onmouseover="this.style.color='#000000'" onmouseout="this.style.color='#ffffff'">Contatos</a></td>
                    </tr>
                </table>
            </div>
            <div class="content"><!--Conteúdo-->
				<?php
					//$origem = $_SERVER["HTTP_REFERER"];  para pegar a origem da visita
					if(isset($_SESSION["logado"]))  /*se existir um usuário logado*/
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
					}
				?>
            </div>			
            <div class="rodape"><!--Rodapé-->
				<a href="http://www.facebook.com" target="_blank"><img src="picture/facebook.png"></a>
				<a href="http://www.twitter.com" target="_blank"><img src="picture/twitter.png"></a>
                <!--Sua Moda - 2012 - Resolução Miníma 1024x768 - Todos Direitos Reservados &#169-->
            </div>
        </div>
    </body>
</html>
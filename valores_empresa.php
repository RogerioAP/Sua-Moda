<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				//Iniciando a sessão
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
        <div class="div-borda"><!--Principal-->
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
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>
			
            <div class="content"><!--Conte�do-->
				<div><h3><br /><br /><center>Valores da empresa</center></h3><center>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo sollicitudin dui ac viverra. Donec vitae congue turpis. Nulla facilisi. Aenean bibendum viverra aliquam. Suspendisse dapibus lobortis elit ac aliquam. Aenean tincidunt, turpis non gravida tristique, est eros convallis erat, vel iaculis felis ante vitae orci. Morbi consectetur, ipsum vitae rhoncus gravida, dolor tortor porta lorem, nec hendrerit neque velit pharetra est. Proin in felis nec ante rhoncus accumsan. Phasellus venenatis auctor congue. Donec vitae magna ligula. Integer gravida, elit id dictum lacinia, ipsum massa aliquam nulla, sit amet viverra erat felis quis quam. Aenean malesuada iaculis nunc in gravida. Nulla non nunc vel leo egestas ullamcorper.</p>
				</center><br></div>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
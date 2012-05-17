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
								if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem págs específicas
								$nome = $user["nome"]; /*nome completo*/
								$foto = $user["foto"];
								
								echo "<table border='0' style='float:right'>
										<tr>
											<td colspan='2'><img src='$foto' width='55px' height='60px'></td>
										</tr>
										<tr>
											<td><a href='user_d_pessoais.php' style='color:black;'>$nome</a></td>
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
				<?php
					if($user["tipo"]=='u')/*clicou em adicionar produto*/
					{
						
						echo "<center><a href='user_d_pessoais.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados Pessoais</div></a>
							<a href='user_d_endereco.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados de Endereço</div></a>
							<a href='user_d_identificacao.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Dados de Identificação</div></a>
							<a href='user_password.php'><div style='width:200px;height:30px;padding-top:5px;background-color:#f8f8ff;float:left;color:red;'>Senha</div></a></center><br>";
					
						$senha_atual = $user["senha"];
						$senha_nova = $user["senha_nova"];
						$senha_nova = $user["senha_nova2"];
						
						if($senha_nova==$senha_nova2)
						{
							echo "<br><center>As novas senhas não estão iguais!<br>
									<a href='home.php'>Página Inicial</a></center><br>";
						}
						include_once "classe.php";
						$obj = new Classe;
						$resultado = $obj->senha();
						
						if(){}
						echo "<form method='post' action='autenticar.php?usuario'>
								<br><center>ATUALIZAR&nbsp&nbsp&nbspDADOS&nbsp&nbsp&nbspPESSOAIS&nbsp?</center>
								<table border=0>
									<tr>
										<td class='tex'>* Senha Atual<br>
										<br>* Senha Nova
										<br>* Senha Novamente</td>
										<td class='cai'>
										<input type='text' id='txt' name='senha' placeholder='Digite sua senha atual'><br><br>
										<input type='text' id='txt' name='senh_nova' placeholder='Digite a nova senha'><br>
										<input type='text' id='txt' name='senha_nova2' placeholder='Digite a senha novamente'></td>
									</tr>
									<tr>
										<td colspan='3'><button>Atualizar</button></td>
									</tr>
									<tr></tr>
								</table>
							</form>";						
					}
					else
					{
						echo "<br><center>É necessário está cadastrado!<br>
							<a href='home.php'>Página Inicial</a></center><br>";
					}
				?>
            </div>
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
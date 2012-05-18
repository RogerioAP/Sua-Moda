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
						include_once "connect.php";
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
						
						if(isset($_POST['atualizar'])) //clicou no botão
						{
							$senha_atual = $_POST['senha_atual'];
							$senha_nova = $_POST["senha_nova"];
							$senha_nova2 = $_POST["senha_nova2"];
							
							if(!empty($senha_atual) && !empty($senha_nova) && !empty($senha_nova2))
							{
								if($senha_nova==$senha_nova2) //novas senhas iguais/corretas
								{
									if($senha_atual!=$senha_nova) //testa pra saber se a nova senha igual a senha atual
									{
										$idusuario = $user['idusuario'];
										//verificar se a senha atual do usuário está correta
										include_once "classe.php";
										$obj = new Classe;
										$sql = "SELECT idusuario, senha FROM sis_login WHERE tipo='u' AND idusuario='$idusuario' AND senha='$senha_atual'";
										$resultado = mysql_query($sql) or die (mysql_error());
										
										if(mysql_num_rows($resultado)) //se estiver certo
										{
											$obj->atualizar_senha($senha_atual, $idusuario);
											//$sql = "UPDATE sis_login SET senha='$senha_atual' WHERE idusuario='$idusuario'";
											//$sd = mysql_query($sql);
											echo "<br><center style='color:green;'>Senha atualiada</center>";
										}
										else
										{
											echo "<br><center style='color:red;'>Senha inválida!</center>";
										}
										//$resultado = $obj->senha($user['idusuario'], $senha_atual);
									}
									else
									{
										echo "<br><center style='color:red;'>A nova senha está igual a senha atual!</center>";
									}
								}
								else
								{
									echo "<br><center style='color:red;'>Novas senhas não são iguais!</center>";
								}
							}
							else
							{
								echo "<br><center style='color:red;'>Os campos não podem ser nulos!</center>";
							}
						}
						//if(){}
						echo "<form method='post' action='user_password.php'>
								<br><center>ATUALIZAR&nbsp&nbsp&nbspDADOS&nbsp&nbsp&nbspPESSOAIS&nbsp?</center>
								<table border=0>
									<tr>
										<td class='tex'>* Senha Atual<br>
										<br>* Senha Nova
										<br>* Senha Novamente</td>
										<td class='cai'>
										<input type='text' id='txt' name='senha_atual' placeholder='Digite sua senha atual'><br><br>
										<input type='text' id='txt' name='senha_nova' placeholder='Digite a nova senha'><br>
										<input type='text' id='txt' name='senha_nova2' placeholder='Digite a senha novamente'></td>
									</tr>
									<tr>
										<td colspan='3'><button name='atualizar'>Atualizar</button></td>
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
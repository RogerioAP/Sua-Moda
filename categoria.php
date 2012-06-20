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
	
		<!--Div Principal-->
        <div class="div-borda">
		
			<!--Cabeçalho-->
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
			<br />
			<!--Conteúdo-->
            <div class="content">
				<?php					
					include_once 'connect.php';
				
					$categoria = '';
					if(isset($_GET["cat"])) {$categoria = $_GET['cat'];} //pega qual categoria é para abrir
					
					$sql = '';
					
					//verifica qual tipo de produto eh para listar
					if($categoria == 'a')
					{
						echo "<br /><br /><div style='clear:both;'><h3><center>Acess&oacute;rios</center></h3></div>";
						$sql = "SELECT * FROM produto where categoria = 'acessorios' limit 9;";
					}
					else if($categoria == 'g')
					{
						echo "<br /><br /><div style='clear:both;'><h3><center>Gadgets</center></h3></div>";
						$sql = "SELECT * FROM produto where categoria = 'gadgets' limit 9;";
					}
					else
					{
						echo "<br /><br /><div style='clear:both;'><h3><center>Vestu&aacute;rio</center></h3></div>";
						$sql = "SELECT * FROM produto where categoria = 'vestuario' limit 9;";
					}
					
					//passa o resultado da busca para variavel
					$rs = mysql_query($sql);
					
					//contador para saber quando eh para trocar de linha
					$cont = 0;
					
					//exibe produtos					
					echo "<div>";
					echo "<br />";
					echo "<table border='0'>";
					while($linha = mysql_fetch_assoc($rs))
					{
						$id_produto = $linha['idProduto'];
						$preco = $linha['Preco'];
						$nome = $linha['Nome'];
						$categoria = $linha['Categoria'];
						
						$sql2 = "select * from imagens where idProduto=$id_produto;";
						$rs2 = '';
						$rs2 = mysql_query($sql2) or die (mysql_error());
						if(mysql_num_rows($rs2))
						{
							$user2 = mysql_fetch_array($rs2);
							$imagem = $user2["imagem1"];
						}
						
						// a primeira vez inicia a div e tr
						if($cont==0)
						{
							echo "<tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>R$ $preco</a></td>";
						}
						else if($cont%3==0)
						{
							echo "</tr> <tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>R$ $preco</a></td>";
						}
						else
						{
							echo "<td><a href='produto.php?produto=$id_produto&&categoria=$categoria'>
									<img src='$imagem'><br>$nome<br>R$ $preco</a></td>";
						}
						
						//contador incrementando
						$cont++;
						//contador para saber quando eh para trocar de linha
					}
					echo "</table>";
					echo "</div>";
				?>
            </div>
			
			<!--**RODAPÉ**-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
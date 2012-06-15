<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
            <title>Sua Moda</title>
    </head>
    <body class="bodyW">
		<!--Div Principal-->
        <div>
			<!--Cabeçalho-->
            <div class="cabecalho">
				<a href="home.php" class="image_title"><div class="image_title"></div></a>
				<!--Espaco "Pessoal"-->
				<div class="pes">
					<?php
						//Iniciando a sessao
						session_start();
						include_once "connect.php";
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM sis_login WHERE idusuario = ".$_SESSION['id_user'];
							
							$rs = mysql_query($sql);
							if(mysql_num_rows($rs))
							{
								$user = mysql_fetch_array($rs);
								if($user["tipo"]=='a'){header('Location:admin.php');} //admin tem pags espec�ficas
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
			
			<!--***MENU***-->
            <?php include_once 'designer.inc'; menu();?>
			
			<!--Conteúdo-->
            <div class="content">
				<?php					
					include_once 'connect.php';
				
					if(isset($_GET["cat"])) {$categoria = $_GET['cat'];} //pega qual categoria é para abrir
					
					if($categoria == 'a')
					{
						echo "<center>Acessórios</center>";
						$sql = "SELECT * FROM produtos where categoria = 'acessorios';";
					}
					else if($categoria == 'v')
					{
						echo "<center>Vestuário</center>";
						$sql = "SELECT * FROM produtos categoria = 'vestuario';";
					}
					else if($categoria == 'g')
					{
						echo "<center>Gadgets</center>";
						$sql = "SELECT * FROM produtos categoria = 'gadgets';";
					}
					
					$rs = mysql_query($sql); //passa o resultado da busca para variavel
					
					$cont = 0;//contador para saber quando eh para trocar de linha
					
					//exibe produtos
					while($linha = mysql_fetch_assoc($rs))
					{
						$id_produto = $linha['idproduto'];
						$imagem = $linha['imagem'];
						$preco = $linha['preco'];
						$nome = $linha['nome'];
						
						// a primeira vez inicia a div e tr
						if($cont==0)
						{
							echo "<tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";
						}
						else if($cont%3==0)
						{
							//quando for o 4° produto da linha, ele é deslocado para uma pr�xima linha
							echo "</tr>
									<tr>
										<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";
						}
						else
						{
							//quando for adicionar produtos na linha normalmente
							echo "<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";
						}
						//contador incrementando
						$cont++;
						//contador para saber quando eh para trocar de linha
					}
					echo "</table>";
				?>
            </div>
			
			<!--**RODAPÉ**-->
			<?php include_once 'designer.inc'; rodape(); ?>
        </div>
    </body>
</html>
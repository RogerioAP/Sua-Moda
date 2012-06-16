<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            
			<?php
				if(isset($_GET['estilo']))
				{
					$estilo = $_GET['estilo'];
					
					if($estilo == 'nerd')
					{
						echo "<link href='nerd.css' rel='StyleSheet' type='text/css'>";
					}
					else if($estilo == 'rock')
					{
						echo "<link href='rock.css' rel='StyleSheet' type='text/css'>";
					}
					else
					{
						echo "<link href='jeito.css' rel='StyleSheet' type='text/css'>";
					}
				}
				else
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
					<?php
						//Iniciando a sessão
						session_start();
						include_once 'connect.php';
						/*if(isset($_SESSION['logado']))*/
						{
							/*Icones para mudar estilo do site*/
							echo "<a href='home.php'><img src='picture/hello.png'></a><br>
							<a href='home.php?estilo=rock'><img src='picture/guitarra.png'></a><br>
							<a href='home.php?estilo=nerd'><img src='picture/android_rosa.png'></a>";
						}
					?>
				</div>
				<!--Espaco "Pessoal"-->
				<div class="pes">
					<?php
						include_once "connect.php";
						if(isset($_SESSION['logado']))
						{
							$sql = "SELECT * FROM usuario WHERE idusuario = ".$_SESSION['id_user'];
							
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
			<div class='NavbarMenu'>
				<ul id='nav'>
					<?php include_once 'designer.inc'; menu();?>
				</ul>
			</div>
			
			<!--Conteúdo-->
            <div class="content">
				<?php					
					include_once 'connect.php';
				
					if(isset($_GET["cat"])) {$categoria = $_GET['cat'];} //pega qual categoria é para abrir
					
					if($categoria == 'a')
					{
						//echo "<center>Acessorios</center>";
						$sql = "SELECT * FROM produto where categoria = 'acessorios';";
					}
					else if($categoria == 'v')
					{
						echo "<center>Vestuario</center>";
						$sql = "SELECT * FROM produto where categoria = 'vestuario';";
					}
					else if($categoria == 'g')
					{
						echo "<center>Gadgets</center>";
						$sql = "SELECT * FROM produto where categoria = 'gadgets';";
					}
					
					$rs = mysql_query($sql); //passa o resultado da busca para variavel
					
					$cont = 0; //contador para saber quando eh para trocar de linha
					
					//exibe produtos
					//while($linha = mysql_fetch_assoc($rs))
					
					echo "<div>";
					echo "<table border='0'>";
					for($i=0; $i<=12; $i++)
					{
						$id_produto = '0'; //$linha['idproduto'];
						$imagem = 'produtos/sapatos_bolsa.jpg'; //$linha['imagem'];
						$preco = '29,90'; //$linha['preco'];
						$nome = 'Sapato'; //$linha['nome'];
						
						// a primeira vez inicia a div e tr
						if($cont==0)
						{
							/*echo "<tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";*/
							
							echo "<tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
									<img src='produtos/sapatos_bolsa.jpg'><br>Sapatos e Bolsa<br>R$ 34,90</a></td>";
						}
						else if($cont%3==0)
						{
							//quando for o 4° produto da linha, ele é deslocado para uma pr�xima linha
							/*echo "</tr>
									<tr>
										<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";*/
										
							echo "</tr> <tr>
									<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
									<img src='produtos/sapatos_bolsa.jpg'><br>Sapatos e Bolsa<br>R$ 34,90</a></td>";
						}
						else
						{
							//quando for adicionar produtos na linha normalmente
							/*echo "<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
											<div>												
												<img src='$imagem'>
												<br>$nome - R$ $preco
											</div>
										</a></td>";*/
							echo "<td><a href='produto.php?produto=$id_produto&&categoria=aces'>
									<img src='produtos/sapatos_bolsa.jpg'><br>Sapatos e Bolsa<br>R$ 34,90</a></td>";
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
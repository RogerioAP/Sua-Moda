<?php
	/*
	*
	*
	*/
	function rodape()
	{
		echo "			
            <div class='rodape'><!--Rodapé-->
				<a href='http://www.facebook.com' target='_blank'><img src='picture/facebook.png'></a>
				<a href='http://www.twitter.com' target='_blank'><img src='picture/twitter.png'></a>
                <!--Sua Moda - 2012 - Resolução Miníma 1024x768 - Todos Direitos Reservados &#169-->
            </div>";
	}
	
	function menu()
	{
		echo "<div class='menu'><!--Menu-->
                <table>
                    <tr>
                        <td><a href='home.php'>Home</a></td>
                        <td><a href='produtos.php'>Produtos</a></td>
                        <td><a href='servicos.php'>Serviços</a></td>
                        <td><a href='quemsomos.php'>Quem somos</a></td>
                        <td><a href='contatos.php'>Contatos</a></td>
                    </tr>
                </table>
            </div>";
	}
	
	function menu_admin()/*menu para admin*/
	{
		echo "<div class='menu'><!--Menu-->
			<table>
				<tr>
					<td><a href='admin.php'>Dados</a></td>
					<td><a href='admin_produtos.php'>Produtos</a></td>
					<td><a href='admin_vendas.php'>Vendas</a></td>
					<td><a href='cadastrar.php'>Novo Admin</a></td>
					<td><a href='admin_site.php'>Site</a></td>
				</tr>
			</table>
		</div>";
	}
	
	function menu_nulo()/*ficar uma barra caso tiver acessando diretamente*/
	{
		echo "<div class='menu'><!--Menu-->
			<table>
				<tr>
					<td><a href='#'></a></td>
					<td><a href='#'></a></td>
					<td><a href='#'></a></td>
					<td><a href='#'></a></td>
				</tr>
			</table>
		</div>";
	}
?>
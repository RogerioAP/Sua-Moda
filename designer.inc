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
		echo "
			<li><a href='home.php'>Home</a></li>
			<li><a href='#'>Produtos</a>
			<ul>
			<li><a href='categoria.php?cat=a'>Acessórios</a></li>
			<li><a href='categoria.php?cat=v'>Vestuário</a></li>
			<li><a href='categoria.php?cat=g'>Gadgets</a></li>
			</ul>
			</li>
			<li><a href='servicos.php'>Serviços</a></li>
			<li><a href='quemsomos.php'>Quem Somos</a></li>
			<li><a href='contatos.php'>Contato</a></li>";
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
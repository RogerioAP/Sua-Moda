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
			<li><a href='#'>Quem Somos</a>
			<ul>
			<li><a href='historia.php'>História</a></li>
			<li><a href='localizacao.php'>Localizacao </a></li>
			<li><a href='valores_empresa.php'>Valores da Empresa</a></li>
			</ul>
			</li>
			<li><a href='contatos.php'>Contato</a></li>";
	}
	
	/*menu para administrador*/
	function menu_admin()
	{
		echo "
			<li><a href='admin.php'>Dados</a></li>
			<li><a href='admin_produtos.php'>Produtos</a></li>
			<li><a href='admin_vendas.php'>Vendas</a></li>
			<li><a href='cadastrar.php'>Novo Admin</a></li>
			<li><a href='admin_site.php'>Site</a></li>";
	}
?>
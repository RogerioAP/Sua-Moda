<?php
	/*
	*
	*
	*/
	function rodape()
	{
		echo " <div class='rodape'><!--Rodap�-->";
		/*echo " <a href='http://www.facebook.com' target='_blank'><img src='picture/facebook.png'></a>
				<a href='http://www.twitter.com' target='_blank'><img src='picture/twitter.png'></a>
                <!---->"; */
		include_once 'connect.php';
		if(isset($_SESSION['logado']))
		{
			/*Icones para mudar estilo do site*/
			echo "<a href='home.php?estilo=hello'><img src='picture/hello.png'></a>
			<a href='home.php?estilo=rock'><img src='picture/guitarra.png'></a>
			<a href='home.php?estilo=nerd'><img src='picture/android.png'></a>";
		}
		echo "<br /><br /><br />&#169 Copyright 2012 Loja Virtual Sua Moda <br /> Desenvolvido por: Rog&eacute;rio Almeida, Mariana Canela e Felipe T&uacute;lio";
        echo "</div>";
	}
	
	function menu()
	{
		echo "
			<li><a href='home.php'>Home</a></li>
			<li><a href='#'>Produtos</a>
			<ul>
			<li><a href='categoria.php?cat=a'>Acess&oacute;rios</a></li>
			<li><a href='categoria.php?cat=v'>Vestu&aacute;rio</a></li>
			<li><a href='categoria.php?cat=g'>Gadgets</a></li>
			</ul>
			</li>
			<li><a href='servicos.php'>Servi&ccedil;os</a></li>
			<li><a href='#'>Quem Somos</a>
			<ul>
			<li><a href='historia.php'>Hist&oacute;ria</a></li>
			<li><a href='localizacao.php'>Localiza&ccedil;&atilde;o </a></li>
			<li><a href='valores_empresa.php'>Valores da empresa</a></li>
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
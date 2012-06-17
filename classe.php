<?php
	/**
	 * 
	 */
	class Classe {
		//construtor
		function __construct() {
			$this->conexao();
		}

		private function conexao()/*Conexão com o BD*/
		{
			$conexao = mysql_connect("localhost", "root", "")
				or die('Conexao com o Mysql falhou!');
			$bd = mysql_select_db("suamoda")
				or die('Conexao com o Banco de Dados falhou!');
		}
		
		function inserir($nome, $sobrenome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $senha, $foto)/*Somente para o botão Salvar*/
		{	//adicionar novo usuário/administrador
			$sql = "INSERT INTO usuario(cpf, nome, senha, email, sobrenome, telefone, cidade, foto, estilo) values('$cpf', '$nome', '$senha', '$email', '$sobrenome', '$telefone', '$cidade', '$foto', 'hello')";
			$this->execut($sql);
		}
		
		function inserir_produto($nome, $descricao, $preco, $categoria, $imagem)
		{	//Adicionar produtos
			$sql = "INSERT INTO produtos(nome, descricao, preco, categoria, imagem) values('$nome', '$descricao', '$preco', '$categoria', '$imagem')";
			$this->execut($sql);
		}
		
		function execut($sql)/*Executa as SQL's*/
		{
			return mysql_query($sql) or die(mysql_error());/*Retorna resultado ou erro*/
		}
		
		function senha($id_usuario, $senha) //para testar se a senha, administrador(id) existem com o respectivo CPF no BD
		{
			$sql = "SELECT id_usuario, senha WHERE tipo='a' AND idusuario='$id_usuario' AND senha='$senha'";
			return $this->execut($sql);
		}
		
		public function listar()/*Lista todos cadastrados - SEM UTILIDADE POR ENQUANTO*/
		{
			$sql = "SELECT * FROM sis_login;";
			return $this->execut($sql);
			$resultado = $this->execut($sql);
			
			echo "<table>";
			while($linha = mysql_fetch_assoc($resultado))
			{
				echo "<tr>";
				$id = $linha["idusuario"];
				$nome = $linha["nome"];
				$email = $linha["email"];
				echo "<td>$id</td>";
				echo "<td>$nome</td>";
				echo "<td>$email</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		//Atualizar dados pessoais do usuario
		function atualizar_dados_pessoais($cpf, $nome, $sobrenome, $telefone)
		{
			$sql = "update usuario set nome='$nome', sobrenome='$sobrenome', telefone='$telefone' where cpf='$cpf';";
			$this->execut($sql);
			//header("Location:admin.php?update|sis_login|set|nome='$nome',|sobrenome='$sobrenome',|cpf='$cpf',|telefone='$telefone',|endereco='$endereco',|numero='$numero',|bairro='$bairro',|cidade='$cidade',|email='$email',|senha='$senha',|foto='$foto',|tipo='$tipo'|where|idusuario='$idusuario';");
		}
		
		function excluir($id)/*Exclui usuário*/
		{
			$sql = "DELETE FROM sis_login WHERE id='$id'";
			$this->execut($sql);
		}
		//mysql_close($conexao);
	}
?>

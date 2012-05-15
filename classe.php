<?php
	/**
	 * 
	 */
	class Classe {
		
		function __construct() {
			$this->conexao();
		}

		private function conexao()/*Conexão com o BD*/
		{
			$conexao = mysql_connect("localhost", "root", "")
				or die('Conexao com o Mysql falhou!');
			$bd = mysql_select_db("site")
				or die('Conexao com o Banco de Dados falhou!');
		}
		function inserir($nome, $cpf, $telefone, $endereco, $numero, $bairro, $cidade, $email, $senha, $foto, $tipo)/*Somente para o botão Salvar*/
		{
			$sql = "INSERT INTO sis_login(nome, cpf, telefone, endereco, numero, bairro, cidade, email, senha, foto, tipo) values('$nome', '$cpf', '$telefone', '$endereco', '$numero', '$bairro', '$cidade', '$email', '$senha', '$foto', '$tipo')";
			$this->execut($sql);
		}
		function execut($sql)/*Executa as SQL's*/
		{
			return mysql_query($sql) or die(mysql_error());/*Retorna resultado ou erro*/
		}
		public function listar()/*Lista todos cadastrados*/
		{
			$sql = "SELECT * FROM sis_login;";
			return $this->execut($sql);
			/*$resultado = $this->execut($sql);
			
			echo "<table>";
			while($linha = mysql_fetch_assoc($resultado))
			{
				echo "<tr>";
				$id = $linha["idusuario"];
				$nome = $linha["nome"];
				$email = $linha["email"];
				$senha = $linha["senha"];
				echo "<td>$id</td>";
				echo "<td>$nome</td>";
				echo "<td>$email</td>";
				echo "<td>$senha</td>";
				echo "</tr>";
			}
			echo "</table>";*/
		}
		function editar($nom, $end, $tel, $id)/*Editar  pessoa*/
		{
			$sql = "UPDATE sis_login SET nome='$nom', endereco='$end', telefone='$tel' where id='$id';";
			$this->execut($sql);
		}
		function excluir($id)/*Exclui pessoa*/
		{
			$sql = "DELETE FROM sis_login WHERE id='$id'";
			$this->execut($sql);
		}
		//mysql_close($conexao);
	}
?>

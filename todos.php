<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link href="jeito.css" rel="StyleSheet" type="text/css">
            <title>Sua Moda</title>
    </head>
    <body>
		<?php
			include "classe.php";
			$obj = new Classe;
			$resultado = $obj->listar();
			echo "<table border=1>
					<tr>
						<td>ID</td>
						<td>NOME</td>
						<td>EMAIL</td>
						<td>SENHA</td>
					</tr>";
			
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
				echo "</tr></table>";
			}
		?>
    </body>
</html>
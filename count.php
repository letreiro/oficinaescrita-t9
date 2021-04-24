<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>Contador de Visitas</title>

</head>
<body>

<?php

	function get_num_visitas(){
		//conectar
		$link = mysql_connect('localhost', 'root', '');
		if (!$link) {
			die('Não foi possível conectar: ' . mysql_error());
		}
		
		mysql_select_db("contador");
		$query = "SELECT total " .
				 "FROM `visitas` " .
				 "ORDER BY total ASC LIMIT 1";
		$result = mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		if (mysql_num_rows($result) == 0) {
			echo "No rows found, nothing to print so am exiting";
			exit;
		}
		$row = mysql_fetch_array($result);
		mysql_close($link);
		return $row["total"];
		//fazer consulta
		//retornar total
	}

	function imprime_visitas($contador){
		return "<h1>" . $contador . "</h1>";
	}
	
	function contar_visita(){
		//conectar
		$link = mysql_connect('localhost', 'root', '');
		if (!$link) {
			die('Não foi possível conectar: ' . mysql_error());
		}
		
		mysql_select_db("contador");
		$query = "UPDATE `visitas` " .
				 "SET total = total + 1";
		$result = mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		mysql_close($link);
	}

	contar_visita();
	$contador = get_num_visitas();
	echo imprime_visitas($contador);

?>

 
</body>
</html>

<?php
	require("php_dbinfo.php");

	//Declare variables
	$estado = $_GET['estado'];
	$municipio = $_GET['municipio'];

	// Compare metods (Estado and Municipio or just Estado)
	if (($estado) && ($municipio)) {
		function parseToXML($htmlStr){
			$xmlStr=str_replace('<','&lt;',$htmlStr);
			$xmlStr=str_replace('>','&gt;',$xmlStr);
			$xmlStr=str_replace('"','&quot;',$xmlStr);
			$xmlStr=str_replace("'",'&#39;',$xmlStr);
			$xmlStr=str_replace("&",'&amp;',$xmlStr);
			return $xmlStr;
		}

		// Select all the rows in the markers table
		$query = "SELECT * FROM estaciones where estadoid ='".$estado."' AND municipioid ='".$municipio."'";
		$result = mysql_query($query);
		if (!$result) {
		  die('Invalid query: ' . mysql_error());
		}

		header("Content-type: text/xml");

		// Start XML file, echo parent node
		echo '<markers>';

		// Iterate through the rows, printing XML nodes for each
		while ($row = @mysql_fetch_assoc($result)){
		  // ADD TO XML DOCUMENT NODE
		  echo '<marker ';
		  echo 'nombre="' . parseToXML($row['nombre']) . '" ';
		  echo 'numero="' . parseToXML($row['numero']) . '" ';
		  echo 'lat="' . $row['latitud'] . '" ';
		  echo 'lng="' . $row['longitud'] . '" ';
		  echo 'activa="' . $row['activa'] . '" ';
		  echo '/>';
		}

		// End XML file
		echo '</markers>';
	}else{
		
	}
?>
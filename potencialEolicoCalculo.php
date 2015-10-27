<?php
	require("php_dbinfo.php");
	// GET Variables
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $estacion = $_GET['estacion'];

    // Declare Variables
    $arrayFechas[] = array();
    $arrayPp[] = array();
    $arrayTemt[] = array();
    $arrayDirv[] = array();
    $arrayVelv[] = array();
    $arrayRadg[] = array();
    $arrayHumr[] = array();
    $arrayHumh[] = array();
    $arrayEto[] = array();

    // Query Generate the 10 months evaluation arrays
    $query  = "SELECT * FROM estado".$estado. "diarios where numero=".$estacion." and fecha<= (NOW() - INTERVAL 7 month)";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
            $arrayVelv[] = $row['velv'];
        }
    }
    var_dump($arrayVelv);
?>
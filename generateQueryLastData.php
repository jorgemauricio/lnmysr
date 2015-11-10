<?php
	include_once('php_dbinfo.php');
	$query  = "SELECT * FROM total_estaciones ORDER BY estadoid";
    $result = mysql_query($query);
    $arrayNumero[] = array();
    $arrayEstadoId[] = array();
    $count = 1;
    echo "WITH";
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
            $arrayNumero[] = $row['numero'];
            $arrayEstadoId[] = $row['estadoid'];
        }
    }
    
    foreach ($arrayNumero as $value) {
    	echo " a".$count." as (SELECT TOP 1 * FROM estado".$arrayEstadoId[$count]." WHERE numero=".$arrayNumero[$count]." ORDER BY fecha), <br>";
    	$count = $count + 1;
    }
    $count = 1;
    foreach ($arrayNumero as $value) {
        echo "select * from a".$count." union all ";
        $count = $count + 1;
    }
?>


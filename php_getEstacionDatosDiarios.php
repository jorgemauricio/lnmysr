<?php
    include_once('php_dbinfo.php');
    
    // GET Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];

    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }

    // Select all the rows in the markers table
    $query  = "SELECT * FROM estaciones where estadoid ='".$estado."' AND  numero = '".$estacion."'";
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
      echo 'numero="' . parseToXML($row['numero']) . '" ';
      echo 'nombre="' . parseToXML($row['nombre']) . '" ';
      echo 'estado="' . $row['estadoid'] . '" ';
      echo 'municipio="' . $row['municipioid'] . '" ';
      echo 'lat="' . $row['latitud'] . '" ';
      echo 'lng="' . $row['longitud'] . '" ';
      echo 'activa="' . $row['activa'] . '" ';
      echo '/>';
    }

    // End XML file
    echo '</markers>';
?>
     
?>
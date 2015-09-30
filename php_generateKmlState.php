<?php
    include_once('php_dbinfo.php');
    
    //
    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }

    // Declare variables
    $lastValueValitation = 0;
    // GET Variables
    $estado = $_GET['estado'];
    $n_estado = $_GET['n_estado'];

    // Query to know the Estado
    $query = "select numero, nombre, latitud, longitud from estaciones_nuevas where estadoid ='".$estado."'";
    $result = mysql_query($query);
    header("Content-type: text/xml");
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        echo '<?xml version="1.0" encoding="utf-8"?>
            <kml xmlns="http://www.opengis.net/kml/2.2">
            <Document>
            <name>Baja California</name>';
        while ($row = mysql_fetch_array($result)) {
            echo '<Placemark>';
            echo '<name>'.$row['nombre'].', '.$n_estado.'</name>';
            echo '<description><![CDATA[<b>Latitud:</b>'.$row['latitud'].'<br/><b>Longitud:</b>'.$row['longitud'].'<br/><a href=\'/LNMySR/Estaciones/ConsultaDiarios15Min?Estado='.$estado.'&Estacion='.$row['numero'].'\'>m&aacute;s informaci&oacute;n</a>]]></description>';
            echo '<Point>';
            echo '<coordinates>'.$row['longitud'].','.$row['latitud'].'</coordinates>';
            echo '</Point>';
            echo '</Placemark>';
        }
        echo '</Document>
                    </kml>';
    }
?>
<?php
    include_once('php_dbinfo.php');
    // Get Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    
    // Query
    $query  = "SELECT extract(year from fecha) as anio from estado".$estado."diarios where numero=".$estacion." group by extract(year from fecha) order by extract(year from fecha) asc";
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }
    echo '<option value="0">Selecciona un Año</option>';
    while($row= mysql_fetch_array($result))
    {
        echo '<option value="';
        echo $row['anio'];
        echo '">';
        echo $row['anio'];
        echo '</option>';
    }
?>
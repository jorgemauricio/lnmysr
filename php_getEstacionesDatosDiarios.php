<?php
    include_once('php_dbinfo.php');
    
    $estado = $_GET['estado'];
    // Query
    $query  = "SELECT nombre, numero FROM estaciones where estadoid ='".$estado."' order by numero asc";
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }

    echo '<option value="0">Selecciona una Estación</option>';

    while($row= mysql_fetch_array($result))
    {
        echo '<option value="';
        echo $row['numero'];
        echo '">';
        echo $row['nombre'];
        echo '</option>';
    }
     
?>
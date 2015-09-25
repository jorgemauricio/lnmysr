<?php
    include_once('php_dbinfo.php');
    
    // Query
    $query  = "SELECT nombre, indice FROM estados where activo = 1 order by indice asc;";
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }

    while($row= mysql_fetch_array($result))
    {
        echo '<option value="';
        echo $row['indice'];
        echo '">';
        echo $row['nombre'];
        echo '</option>';
    }
     
?>
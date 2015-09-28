<?php
    include_once('php_dbinfo.php');
    
    $estado = $_GET['estado'];
    // Query
    $query  = "SELECT nombre, indice FROM municipios where idedo ='".$estado."' order by indice asc";
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }

    echo '<option value="0">Todos</option>';

    while($row= mysql_fetch_array($result))
    {
        echo '<option value="';
        echo $row['indice'];
        echo '">';
        echo $row['nombre'];
        echo '</option>';
    }
     
?>
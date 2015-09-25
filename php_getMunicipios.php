<?php
    include_once('php_dbinfo.php');
    
    $estado = $_POST['estado'];
    // Query
    $query  = "SELECT nombre, indice FROM municipios where idedo ='".$estado."' order by indice asc";
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
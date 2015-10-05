<?php
    include_once('php_dbinfo.php');
    
    $estado = $_GET['estado'];
    
    // Validacion de parametros de estado 
    if($estado == 99 || $estado == 0){
        
    }else{
        // Query
        $query  = "SELECT nombre, indice FROM municipios where idedo ='".$estado."' order by indice asc";
        $result = mysql_query($query);
        if(!$result){
            die('Invalid query: ' . mysql_error());
        }

        echo '<label for=\"tipoInformacion\">Municipio</label>';
        echo '<select class="form-control" id="municipio" name="municipio">';
        echo '<option value="0">Selecciona un Municipio</option>';

        while($row= mysql_fetch_array($result))
        {
            echo '<option value="';
            echo $row['indice'];
            echo '">';
            echo $row['nombre'];
            echo '</option>';
        }

        echo '</select>';
    }    
?>
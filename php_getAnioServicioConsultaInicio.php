<?php
    include_once('php_dbinfo.php');
    // Get Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $tipo = $_GET['tipo'];
    $query = "";
    // Query
    if ($tipo == "p_diario") {
        $query  = "SELECT extract(year from fecha) as anio from estado".$estado."diarios where numero=".$estacion." group by extract(year from fecha) order by extract(year from fecha) asc";
    }elseif ($tipo == "v_min") {
        $query  = "SELECT extract(year from fecha1) as anio from estado".$estado." where numero=".$estacion." group by extract(year from fecha1) order by extract(year from fecha1) asc";
    }

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
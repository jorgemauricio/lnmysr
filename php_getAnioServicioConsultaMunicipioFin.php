<?php
    include_once('php_dbinfo.php');
    // Get Variables
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $anioInicio = $_GET['anioInicio'];
    $tipo = $_GET['tipo'];
    $query = "";
    // Query
    if ($tipo == "p_diario") {
        $query  = "SELECT extract(year from estado".$estado."diarios.fecha) as anio from estado".$estado."diarios inner join estaciones on estado".$estado."diarios.numero=estaciones.numero where estaciones.municipioid=".$municipio." and extract(year from estado".$estado."diarios.fecha) >".$anioInicio." group by extract(year from estado".$estado."diarios.fecha) order by extract(year from estado".$estado."diarios.fecha) asc";
    }elseif ($tipo == "v_min") {
       $query  = "SELECT extract(year from estado".$estado.".fecha) as anio from estado".$estado." inner join estaciones on estado".$estado.".numero=estaciones.numero where estaciones.municipioid=".$municipio." and extract(year from estado".$estado.".fecha) >".$anioInicio." group by extract(year from estado".$estado.".fecha) order by extract(year from estado".$estado.".fecha) asc";
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

    if ($anioInicio == date('Y')) {
        echo '<option value="'.$anioInicio.'">'.$anioInicio.'</option>';
    }
?>
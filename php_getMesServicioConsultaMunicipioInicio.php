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
        $query  = "SELECT extract(month from estado".$estado."diarios.fecha) as mes from estado".$estado."diarios inner join estaciones on estado".$estado."diarios.numero=estaciones.numero where estaciones.municipioid=".$municipio." group by extract(month from estado".$estado."diarios.fecha) order by extract(month from estado".$estado."diarios.fecha) asc";
    }elseif ($tipo == "v_min") {
        $query  = "SELECT extract(month from estado".$estado.".fecha) as mes from estado".$estado." inner join estaciones on estado".$estado.".numero=estaciones.numero where estaciones.municipioid=".$municipio." group by extract(month from estado".$estado.".fecha) order by extract(month from estado".$estado.".fecha) asc";
    }
    
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }
    echo '<option value="0">Selecciona un Mes</option>';
    while($row= mysql_fetch_array($result))
    {
        echo '<option value="';
        echo $row['mes'];
        echo '">';
        echo numberToMonth($row['mes']);
        echo '</option>';
    }

    function numberToMonth($t){
        switch ($t) {
                case (1):
                    $mes = 'Enero';
                    break;
                case (2):
                    $mes = 'Febrero';
                    break;
                case (3):
                    $mes = 'Marzo';
                    break;
                case (4):
                    $mes = 'Abril';
                    break;
                case (5):
                    $mes = 'Mayo';
                    break;
                case (6):
                    $mes = 'Junio';
                    break;
                case (7):
                    $mes = 'Julio';
                    break;
                case (8):
                    $mes = 'Agosto';
                    break;
                case (9):
                    $mes = 'Septiembre';
                    break;
                case (10):
                    $mes = 'Octubre';
                    break;
                case (11):
                    $mes = 'Noviembre';
                    break;
                case (12):
                    $mes = 'Diciembre';
                    break;
                default:
                    $t = 'Información Inexistente';
                    break;
            }
        return $mes;    
    }
?>
<?php
    include_once('php_dbinfo.php');
    // Get Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $anio = $_GET['anio'];
    
    // Query
    $query  = "SELECT extract(month from fecha1) as mes from estado".$estado."diarios where numero=".$estacion." and extract(year from fecha1) =".$anio." group by extract(month from fecha1) order by extract(month from fecha1) asc";
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
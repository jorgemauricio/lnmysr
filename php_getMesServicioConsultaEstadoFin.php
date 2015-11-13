<?php
    include_once('php_dbinfo.php');
    // Get Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $anioFin = $_GET['anioFin'];
    $mesInicio = $_GET['mesInicio'];
    $tipo = $_GET['tipo'];
    $query = "";
    
    // Query
    if ($tipo == "p_diario") {
        $query  = "SELECT extract(month from fecha) as mes from estado".$estado."diarios where extract(year from fecha) =".$anioFin." group by extract(month from fecha) order by extract(month from fecha) asc";
    }elseif ($tipo == "v_min") {
        $query  = "SELECT extract(month from fecha1) as mes from estado".$estado." where extract(year from fecha1)=".$anioFin." and extract(month from fecha1) > ".$mesInicio." group by extract(month from fecha1) order by extract(month from fecha1) asc";
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

    if ($mesInicio == date('m')) {
        echo '<option value="'.$mesInicio.'">'.numberToMonth($mesInicio).'</option>';
    }else{
        echo '<option value="'.date('m').'">'.numberToMonth(date('m')).'</option>';
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
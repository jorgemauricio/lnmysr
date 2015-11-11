<?php
    include_once('php_dbinfo.php');
    
    // GET Variables

    $tipo = $_GET['tipo'];
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $anioInicio = $_GET['anioInicio'];
    $mesInicio = $_GET['mesInicio'];
    $anioFin = $_GET['anioFin'];
    $mesFin = $_GET['mesFin'];

    // Declare variables
    $lastValueValitation = 0;
    $pp = null;
    $counter = 0;
    $query = "";
   
    $dataCSV_V_Min = "Numero, Fecha, Temt, Dirv, Velv, Radg, Humr, Humh , Eto \n";
    $dataCSV_P_Diarios = "Numero, Fecha, Pp, T_Max, T_Min, T_Med, VV_Max, VV, DWW, DV, Rag_G, HR, ET, EP \n";
    
    // CSV File Name
    $fileLocation = "documentos/Servicio_Consulta/";
    $today = date("Y-m-d_H-i-s"); ;
    $fileNameCSV = "Servicio_Consulta". $today . "__" . $estado . "_" . $estacion . "_" . $anioInicio . "_" . $anioFin . "__" . rand();
    

    // Query 
    if ($tipo == "p_diario") {
        $query = "select * from estado".$estado."diarios where numero=".$estacion." and fecha between '".$anioInicio."-".$mesInicio."-01' and '".$anioFin."-".$mesFin."-01' order by fecha asc";
        $result = mysql_query($query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }else{
            while ($row = mysql_fetch_array($result)){
                 $dataCSV_P_Diarios.= $row['numero'].",".$row['fecha'].",".$row['prec'].",".$row['tmax'].",".$row['tmin'].",".$row['tmed'].",".$row['velvmax'].",".$row['velv'].",".TextoDV(number_format($row['dirvvmax'])).",".TextoDV(number_format($row['dirv'])).",".$row['radg'].",".$row['humr'].",".$row['et'].",".$row['ep'].","."\n";
             }
         }
        // Save the csv to directory
        $handle = fopen($fileLocation.$fileNameCSV.".csv",'w');
        fwrite($handle, $dataCSV_P_Diarios);
        fclose($handle);
        // Echo botón descarga de tabla de datos PM 
        echo '<div class="container">
                 <a target="_blank" href="'.$fileLocation.$fileNameCSV.'.csv" class="btn btn-success" role="button">Descarga</a>
            </div>';
    }elseif ($tipo == "v_min") {
        $query = "select * from estado".$estado." where numero=".$estacion." and fecha1 between '".$anioInicio."-".$mesInicio."-01' and '".$anioFin."-".$mesFin."-01' order by fecha1 asc";
        $result = mysql_query($query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }else{
            while ($row = mysql_fetch_array($result)){
                $dataCSV_V_Min.= $row['numero'].",".$row['fecha1'].",".$row['prec'].",".$row['temt'].",".TextoDV(number_format($row['dirv'])).",".$row['velv'].",".$row['radg'].",".$row['humr'].",".$row['humh'].",".$row['eto'].",". "\n";
             }
         }
        // Save the csv to directory
        $handle = fopen($fileLocation.$fileNameCSV.".csv",'w');
        fwrite($handle, $dataCSV_V_Min);
        fclose($handle);
        // Echo botón descarga de tabla de datos PM 
        echo '<div class="container">
                 <a target="_blank" href="'.$fileLocation.$fileNameCSV.'.csv" class="btn btn-success" role="button">Descarga</a>
            </div>';
    }

    // Save the csv to directory
    // Funciones
    function TextoDV($dv){
        switch ($dv) {
                case ($dv >= 0 && $dv <= 44):
                    $dv = $dv . ' N';
                    break;
                case ($dv >= 45 && $dv <= 89):
                    $dv =  $dv . ' NE';
                    break;
                case ($dv >= 90 && $dv <= 134):
                    $dv =  $dv . ' E';
                    break;
                case ($dv >= 135 && $dv <= 179):
                    $dv =  $dv . ' SE';
                    break;
                case ($dv >= 180 && $dv <= 224):
                    $dv =  $dv . ' S';
                    break;
                case ($dv >= 225 && $dv <= 269):
                    $dv =  $dv . ' SO';
                    break;
                case ($dv >= 270 && $dv <= 314):
                    $dv =  $dv . ' O';
                    break;
                case ($dv >= 315 && $dv <= 359):
                    $dv =  $dv . ' NO';
                    break;
                case ($dv == 360):
                    $dv =  $dv . ' N';
                    break;
                default:
                    $dv = '';
                    break;
            }
        return $dv;   
    }
?>
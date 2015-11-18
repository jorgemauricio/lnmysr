<?php
    include_once('php_dbinfo.php');
    
    // GET Variables

    $tipo = $_GET['tipo'];
    $estado = $_GET['estado'];
    $anioInicio = $_GET['anioInicio'];
    $mesInicio = $_GET['mesInicio'];
    $anioFin = $_GET['anioFin'];
    $mesFin = $_GET['mesFin'];
    $lastDay = 0;

    // Declare variables
    $lastValueValitation = 0;
    $pp = null;
    $counter = 0;
    $query = "";
   
    $dataCSV_V_Min = "Nombre, Numero, Fecha, Prec, Temt, Dirv, Velv, Radg, Humr, Humh , Eto \n";
    $dataCSV_P_Diarios = "Nombre, Numero, Fecha, Pp, T_Max, T_Min, T_Med, VV_Max, VV, DWW, DV, Rag_G, HR, ET, EP \n";
    
    // CSV File Name
    $fileLocation = "documentos/Servicio_Consulta/";
    $today = date("Y-m-d_H-i-s"); ;
    $fileNameCSV = "Servicio_Consulta__". $today . "__" . $estado . "_" . $anioInicio . "_" . $anioFin . "__" . rand();

    // Query 
    if ($tipo == "p_diario") {
        $query = "select * from estado".$estado."diarios inner join estaciones on estado".$estado."diarios.numero=estaciones.numero where estado".$estado."diarios.fecha between '".$anioInicio."-".$mesInicio."-01' and '".$anioFin."-".$mesFin."-".lastDayOfMonth($mesFin)."' order by estado".$estado."diarios.numero, estado".$estado."diarios.fecha asc";
        $result = mysql_query($query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }else{
            while ($row = mysql_fetch_array($result)){
                 $dataCSV_P_Diarios.= $row['nombre'].",".$row['numero'].",".$row['fecha'].",".$row['prec'].",".$row['tmax'].",".$row['tmin'].",".$row['tmed'].",".$row['velvmax'].",".$row['velv'].",".TextoDV($row['dirvvmax']).",".TextoDV($row['dirv']).",".$row['radg'].",".$row['humr'].",".$row['et'].",".$row['ep'].","."\n";
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
        $query = "select * from estado".$estado." inner join estaciones on estado".$estado.".numero=estaciones.numero where estado".$estado.".fecha1 between '".$anioInicio."-".$mesInicio."-01' and '".$anioFin."-".$mesFin."-".lastDayOfMonth($mesFin)."' order by estado".$estado.".numero, estado".$estado.".fecha1 asc";
        $result = mysql_query($query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }else{
            while ($row = mysql_fetch_array($result)){
                $dataCSV_V_Min.= $row['nombre'].",".$row['numero'].",".$row['fecha1'].",".$row['prec'].",".$row['temt'].",".TextoDV($row['dirv']).",".$row['velv'].",".$row['radg'].",".$row['humr'].",".$row['humh'].",".$row['eto'].",". "\n";
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

    
    // Funciones
    function lastDayOfMonth($month){
        switch ($month) {
            case 1:
                $lastDay = 31;
                break;
            case 2:
                $lastDay = 28;
                break;
            case 3:
                $lastDay = 31;
                break;
            case 4:
                $lastDay = 30;
                break;
            case 5:
                $lastDay = 31;
                break;
            case 6:
                $lastDay = 30;
                break;
            case 7:
                $lastDay = 31;
                break;
            case 8:
                $lastDay = 31;
                break;
            case 9:
                $lastDay = 30;
                break;
            case 10:
                $lastDay = 31;
                break;
            case 11:
                $lastDay = 30;
                break;
            case 12:
                $lastDay = 31;
                break;
            default:
                
                break;
        }
        return $lastDay;
    }

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
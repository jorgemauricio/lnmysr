<?php
    include_once('php_dbinfo.php');
    
    // Declare variables
    $lastValueValitation = 0;
    $pp = null;
    $counter = null;
    // GET Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $anio = $_GET['anio'];
    $mes = $_GET['mes'];
    $dataCSV = "Fecha, Pp, T. Máx, T. Mín, T. Med, VV Máx, VV, DWW, DV, Rag. G, HR, ET, EP \n";
    // CSV File Name
    $fileLocation = "documentos/downloadHistoricos/";
    $today = date("Y-m-d__H-i-s"); ;
    $fileNameCSV = "historicos_". $today . "__" . $estado . "_" . $estacion . "_" . $anio . "_" . $mes . "__" . rand() . ".csv";
    // echo historicos del mes
    echo '<div class="container">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Pp</th>
                                <th>T. Máx</th>
                                <th>T. Mín</th>
                                <th>T. Med</th>
                                <th>VV Máx</th>
                                <th>VV</th>
                                <th>DVV Máx</th>
                                <th>DV</th>
                                <th>Rag. G</th>
                                <th>HR</th>
                                <th>ET</th>
                                <th>EP</th>
                            </tr>
                        </thead>
                        <tbody>';
    // Query historicos diarios del mes seleccionado
    $query = "select * from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha1) =".$anio." and extract(month from fecha1) =".$mes." order by fecha1 asc";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
                        echo '<tr>
                                <td>'.trim($row['fecha'],"00:00").'</td>
                                <td>'.$row['prec'].'</td>
                                <td>'.$row['tmax'].'</td>
                                <td>'.$row['tmin'].'</td>
                                <td>'.$row['tmed'].'</td>
                                <td>'.$row['velvmax'].'</td>
                                <td>'.$row['velv'].'</td>
                                <td>'.TextoDV(number_format($row['dirvvmax'],2,'.','')).'</td>
                                <td>'.TextoDV(number_format($row['dirv'],2,'.','')).'</td>
                                <td>'.$row['radg'].'</td>
                                <td>'.$row['humr'].'</td>
                                <td>'.$row['et'].'</td>
                                <td>'.$row['ep'].'</td>
                            </tr>';  
                        $dataCSV .=  trim($row['fecha'],"00:00").",".$row['prec'].",".$row['tmax'].",".$row['tmin'].",".$row['tmed'].",".$row['velvmax'].",".$row['velv'].",".TextoDV(number_format($row['dirvvmax'],2,'.','')).",".TextoDV(number_format($row['dirv'],2,'.','')).",".$row['radg'].",".$row['humr'].",".$row['et'].",".$row['ep'].",". "\n";
        }
    }
    // Query Totales del mes
    $query = "select sum(prec) as precS, avg(tmax) as tmaxA, avg(tmin) as tminA, avg(tmed) as tmedA, avg(velvmax) as velvmaxA, avg(velv) as velvA, avg(dirvvmax) as dirvvmaxA, avg(dirv) as dirvA, avg(radg) as radgA, avg(humr) as humrA, sum(et) as etS, sum(ep) as epS from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha1) =".$anio." and extract(month from fecha1) =".$mes;
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
                        echo '<tr>
                                <td><b>Totales</b></td>
                                <td><b>'.number_format($row['precS'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['tmaxA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['tminA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['tmedA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['velvmaxA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['velvA'],2,'.','').'</b></td>
                                <td><b>'.TextoDV(number_format($row['dirvvmaxA'],2,'.','')).'</b></td>
                                <td><b>'.TextoDV(number_format($row['dirvA'],2,'.','')).'</b></td>
                                <td><b>'.number_format($row['radgA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['humrA'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['etS'],2,'.','').'</b></td>
                                <td><b>'.number_format($row['epS'],2,'.','').'</b></td>
                            </tr>';  

                             $dataCSV .=  "Totales".",".$row['precS'].",".$row['tmaxA'].",".$row['tminA'].",".$row['tmedA'].",".$row['velvmaxA'].",".$row['velvA'].",".TextoDV(number_format($row['dirvvmaxA'],2,'.','')).",".TextoDV(number_format($row['dirvA'],2,'.','')).",".$row['radgA'].",".$row['humrA'].",".$row['etS'].",".$row['epS'].",". "\n"; 
        }
    }
    // Save the csv to directory
    $handle = fopen($fileLocation.$fileNameCSV,'w');
    fwrite($handle, $dataCSV);
    fclose($handle);
    // Close table
    echo        '</tbody>
            </table>
        </div>';
    // Echo botón descarga de tabla de datos    
    echo '<div class="container">
             <a target="_blank" href="'.$fileLocation.$fileNameCSV.'" class="btn btn-success" role="button">Descarga</a>
        </div>';
    // Echo tabla de abreviaturas
    echo '<div class="container">
          <h4 class="text-center">Referencia</h4>
               <table class="table  table-striped">
                   <thead>
                        <tr>
                            <th>Abreviatura</th>
                            <th>Significado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pp</td>
                            <td>Precipitación pluvial (mm)</td>
                        </tr>
                        <tr>
                            <td>T. Máx</td>
                            <td>Temperatura máxima (°C)</td>
                        </tr>
                        <tr>
                            <td>T. Mín</td>
                            <td>Temperatura mínima (°C)</td>
                        </tr>
                        <tr>
                            <td>T. Med</td>
                            <td>Temperatura media (°C)</td>
                        </tr>
                        <tr>
                            <td>T. Pro</td>
                            <td>Temperatura promedio (°C)</td>
                        </tr>
                        <tr>
                            <td>VV Máx</td>
                            <td>Velocidad del viento máxima (Km/h)</td>
                        </tr>
                        <tr>
                            <td>DVV Máx</td>
                            <td>Dirección de la velocidad máxima del viento (grados azimut)</td>
                        </tr>
                        <tr>
                            <td>VV</td>
                            <td>Velocidad promedio del viento (Km/h)</td>
                        </tr>
                        <tr>
                            <td>DV</td>
                            <td>Dirección promedio del viento (grados azimut)</td>
                        </tr>
                        <tr>
                            <td>Rad. G</td>
                            <td>Radiación global (W/m²)</td>
                        </tr>
                        <tr>
                            <td>HR</td>
                            <td>HR: Humedad relativa (%)</td>
                        </tr>
                        <tr>
                            <td>ET</td>
                            <td>Evapotranspiración de referencia (mm)</td>
                        </tr>
                        <tr>
                            <td>EP</td>
                            <td>Evaporación potencial (mm)</td>
                        </tr>
                        <tr>
                            <td>Pr</td>
                            <td>Punto de rocío (°C)</td>
                        </tr>
                    </tbody>
                </table>
            </div>';
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
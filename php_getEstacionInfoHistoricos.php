<?php
    include_once('php_dbinfo.php');
    include "libchart/libchart/classes/libchart.php";
    
    // Declare variables
    $lastValueValitation = 0;
    $pp = null;
    $counter = 0;
    // libchart
    $serie1 = new XYDataSet();
    $serie2 = new XYDataSet();
    $serie3 = new XYDataSet();
    $serie4 = new XYDataSet();
    $serie5 = new XYDataSet();
    $serie6 = new XYDataSet();
    $serie7 = new XYDataSet();
    $serie8 = new XYDataSet();
    $serie9 = new XYDataSet();
    $serie10 = new XYDataSet();
    $serie11 = new XYDataSet();
    $serie12 = new XYDataSet();
    // GET Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];
    $anio = $_GET['anio'];
    $mes = $_GET['mes'];
    $dataCSV = "Fecha, Pp, T_Max, T_Min, T_Med, VV_Max, VV, DWW, DV, Rag_G, HR, ET, EP \n";
    $arrayVariables = array("Pp","T_Max", "T_Min", "T_Med", "VV_Max", "VV", "DWW", "DV", "Rag_G", "HR", "ET", "EP");
    $arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $mesNumero = 0;
    // CSV File Name
    $fileLocation = "documentos/downloadHistoricos/";
    $today = date("Y-m-d_H-i-s"); ;
    $fileNameCSV = "historicos_". $today . "__" . $estado . "_" . $estacion . "_" . $anio . "_" . $mes . "__" . rand();
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
    $query = "select * from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha) =".$anio." and extract(month from fecha) =".$mes." order by fecha asc";
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
                        // Data CSV
                        $dataCSV .=  trim($row['fecha'],"00:00").",".$row['prec'].",".$row['tmax'].",".$row['tmin'].",".$row['tmed'].",".$row['velvmax'].",".$row['velv'].",".TextoDV(number_format($row['dirvvmax'],2,'.','')).",".TextoDV(number_format($row['dirv'],2,'.','')).",".$row['radg'].",".$row['humr'].",".$row['et'].",".$row['ep'].",". "\n";
        }
    }
    // Query Totales del mes
    $query = "select sum(prec) as precS, avg(tmax) as tmaxA, avg(tmin) as tminA, avg(tmed) as tmedA, avg(velvmax) as velvmaxA, avg(velv) as velvA, avg(dirvvmax) as dirvvmaxA, avg(dirv) as dirvA, avg(radg) as radgA, avg(humr) as humrA, sum(et) as etS, sum(ep) as epS from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha) =".$anio." and extract(month from fecha) =".$mes;
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
    $handle = fopen($fileLocation.$fileNameCSV.".csv",'w');
    fwrite($handle, $dataCSV);
    fclose($handle);
    // Close table
    echo        '</tbody>
            </table>
        </div>';
    // Echo botón descarga de tabla de datos    
    echo '<div class="container">
             <a target="_blank" href="'.$fileLocation.$fileNameCSV.'.csv" class="btn btn-success" role="button">Descarga</a>
        </div>';
    // Save Search in the DB
    $query = "INSERT INTO consultasWeb (fecha, estado, estacion, anio, mes, name) VALUES (NOW(),'".$estado."','".$estacion."','".$anio."','".$mes."','".$fileNameCSV."')";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
                      
    }
    // Echo tabla de promedios mensuales
    echo '<div class="container">
            <h4 class="text-center">Promedio Mensual</h4>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Año</th>
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
    // Tabla de promedios mensuales
    foreach ($arrayMeses as $value) {
        $query = "select sum(prec) as precS, avg(tmax) as tmaxA, avg(tmin) as tminA, avg(tmed) as tmedA, avg(velvmax) as velvmaxA, avg(velv) as velvA, avg(dirvvmax) as dirvvmaxA, avg(dirv) as dirvA, avg(radg) as radgA, avg(humr) as humrA, sum(et) as etS, sum(ep) as epS from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha) =".$anio." and extract(month from fecha) =".$mesNumero;
            $result = mysql_query($query);
            if (!$result) {
              die('Invalid query: ' . mysql_error());
            }else{
                while ($row = mysql_fetch_array($result)){
                                echo '<tr>
                                        <td>'.$arrayMeses[$mesNumero].'</b></td>
                                        <td>'.$anio.'</b></td>
                                        <td>'.number_format($row['precS'],2,'.','').'</td>
                                        <td>'.number_format($row['tmaxA'],2,'.','').'</td>
                                        <td>'.number_format($row['tminA'],2,'.','').'</td>
                                        <td>'.number_format($row['tmedA'],2,'.','').'</td>
                                        <td>'.number_format($row['velvmaxA'],2,'.','').'</td>
                                        <td>'.number_format($row['velvA'],2,'.','').'</td>
                                        <td>'.TextoDV(number_format($row['dirvvmaxA'],2,'.','')).'</td>
                                        <td>'.TextoDV(number_format($row['dirvA'],2,'.','')).'</td>
                                        <td>'.number_format($row['radgA'],2,'.','').'</td>
                                        <td>'.number_format($row['humrA'],2,'.','').'</td>
                                        <td>'.number_format($row['etS'],2,'.','').'</td>
                                        <td>'.number_format($row['epS'],2,'.','').'</td>
                                    </tr>'; 
                                    $serie1->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['precS'],2,'.','')));
                                    $serie2->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['tmaxA'],2,'.','')));
                                    $serie3->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['tminA'],2,'.','')));
                                    $serie4->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['tmedA'],2,'.','')));
                                    $serie5->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['velvmaxA'],2,'.','')));
                                    $serie6->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['velvA'],2,'.','')));
                                    $serie7->addPoint(new Point($arrayMeses[$mesNumero],TextoDV(number_format($row['dirvvmaxA'],2,'.',''))));
                                    $serie8->addPoint(new Point($arrayMeses[$mesNumero],TextoDV(number_format($row['dirvA'],2,'.',''))));
                                    $serie9->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['radgA'],2,'.','')));
                                    $serie10->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['humrA'],2,'.','')));
                                    $serie11->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['etS'],2,'.','')));
                                    $serie12->addPoint(new Point($arrayMeses[$mesNumero],number_format($row['epS'],2,'.','')));
                }
            }
            $mesNumero = $mesNumero + 1;
    }
    $tempArray = array($serie1, $serie2, $serie3, $serie4, $serie5, $serie6, $serie7, $serie8, $serie9, $serie10, $serie11, $serie12);
    // Close table
    echo        '</tbody>
            </table>
        </div>';
    
    // ZipArchive
    $zip = new ZipArchive();
    $filename = $fileNameCSV.".zip";

    if ($zip->open("documentos/downloadHistoricos/".$fileNameCSV.".zip", ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    $zip->addFile("documentos/downloadHistoricos/".$fileNameCSV.".csv");
    // LibChart
    echo '<div class="container">
            <h4 class="text-center">Gráficas Promedio Mensual</h4>
            <div class="row">';
    foreach ($arrayVariables as $value) {
        $chart = new LineChart(800, 600);
        $dataSet = new XYSeriesDataSet();
        $dataSet->addSerie($arrayVariables[$counter], $tempArray[$counter]);
        $chart ->setDataSet($dataSet);
        $chart->setTitle($arrayVariables[$counter]);
        $chart->render("documentos/downloadHistoricos/".$fileNameCSV."_".$arrayVariables[$counter].".png");
        echo '<div class="col-sm-4">
                <h5 class="text-center">'.$arrayVariables[$counter].'</h5>
                <img src="documentos/downloadHistoricos/'.$fileNameCSV."_".$arrayVariables[$counter].'.png" class="img-thumbnail" alt="Cinque Terre" width="250" height="150">
                <a target="_blank" href="documentos/downloadHistoricos/'.$fileNameCSV."_".$arrayVariables[$counter].'.png" class="btn btn-success btn-xs" role="button">Descarga</a>
                </div>';
        $zip->addFile("documentos/downloadHistoricos/".$fileNameCSV."_".$arrayVariables[$counter].".png"); // Add image to the zip file
        if ($counter == 2 || $counter == 5 || $counter == 8) {
            echo '</div>
                    <div class="row">';
        }
        $counter = $counter + 1;
    }
    echo '</div>
            </div>';
    echo '<br>';

    // Zip Archive
    echo "numfiles: " . $zip->numFiles . "\n";
    echo "status:" . $zip->status . "\n";
    $zip->close();
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
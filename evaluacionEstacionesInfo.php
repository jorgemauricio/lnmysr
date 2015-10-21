<?php
    include_once('php_dbinfo.php');
    session_start();
    
    // Declare variables
    $lastValueValitation = 0;
    $pp = null;
    $counter = null;
    $arrayVariables = array("Pp","Temt","Dirv", "Velv", "Radg", "Humr", "Humh", "Eto");
    $arrayFechas= array();
    $arrayPp = array();
    $arrayTemt = array();
    $arrayDirv= array();
    $arrayVelv = array();
    $arrayRadg = array();
    $arrayHumr= array();
    $arrayHumh = array();
    $arrayEto = array();
    // GET Variables
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $estacion = $_GET['estacion'];
    $noResultados = $_GET['noResultados'];

    // Query to know the Estado
    $query = "select nombre from estados where indice ='".$estado."'";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)) {
            echo '<div class="row">';
            echo '<div class="col-sm-6">';
            echo '<div class="well">';
            echo '<p><b>Estado: </b>';
            echo $row['nombre'];
            echo '</p>';
        }
    }

    // Query to know the Municipio
    $query = "select nombre from municipios where indice ='".$municipio."'";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)) {
            echo '<p><b>Municipio: </b>';
            echo $row['nombre'];
            echo '</p>';
        }
    }

    // Query to know the image
    $query  = "SELECT * FROM estaciones where numero = '".$estacion."'";

    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{

        // Echo Nombre Estación
        while ($row = mysql_fetch_array($result)) {
            echo '<p><b>Estación: </b>';
            echo $row['nombre'];
            echo '</p>';
            // Echo Latitud
            echo '<p><b>Latitud: </b>';
            echo $row['latitud'];
            echo '</p>';
            // Echo Longitud
            echo '<p><b>Longitud: </b>';
            echo $row['longitud'];
            echo '</p>';

            // Echo Activa
            if ($row['activa'] == 1) {
                echo '<p><b>Activa: </b>SI</p>';
            }else{
                echo '<p><b>Activa: </b>NO</p>';
            }
            echo '</div>';
            echo '</div>';

            // Echo Image
            echo '<div class="col-sm-6">';
            echo '<div class="well">';
            echo '<img src="/lnmysr/images/imagenesEstaciones/'.$row['numero'];
            echo '.jpg" class="img-responsive" alt="'.$row['numero'];
            echo '" width="155" height="125">'; 
        }   
    }

        echo '</div>';
        echo '</div>';
        echo '</div>';

    // Echo tabla de valores al momento de la consulta
    // Query Show Last Row Info
    $query  = "SELECT * FROM estado".$estado. " where numero=".$estacion." order by fecha desc limit ".$noResultados;
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
            $arrayFechas[] = $row['fecha'];
            $arrayPp[] = $row['prec'];
            $arrayTemt[] = $row['temt'];
            $arrayDirv[] = $row['dirv'];
            $arrayVelv[] = $row['velv'];
            $arrayRadg[] = $row['radg'];
            $arrayHumr[] = $row['humr'];
            $arrayHumh[] = $row['humh'];
            $arrayEto[] = $row['eto'];
        }
    }

    echo '<div>
            <h4 class="text-center">Rango de Horario</h4>
            <h5 class="text-center">'.$arrayFechas[0].'-'.$arrayFechas[count($arrayFechas)-1].'</h5>
        </div>';
    echo '<div class="container">
          <h4 class="text-center">Media y Desviación Estandar</h4>
               <table class="table  table-striped">
                   <thead>
                        <tr>
                            <th>Variable</th>
                            <th>Media</th>
                            <th>Desviación Estandar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>'.$arrayVariables[0].'</td>
                        <td>'.number_format(meanOfVariable($arrayPp),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayPp),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[1].'</td>
                        <td>'.number_format(meanOfVariable($arrayTemt),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayTemt),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[2].'</td>
                        <td>'.number_format(meanOfVariable($arrayDirv),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayDirv),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[3].'</td>
                        <td>'.number_format(meanOfVariable($arrayVelv),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayVelv),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[4].'</td>
                        <td>'.number_format(meanOfVariable($arrayRadg),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayRadg),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[5].'</td>
                        <td>'.number_format(meanOfVariable($arrayHumr),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayHumr),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[6].'</td>
                        <td>'.number_format(meanOfVariable($arrayHumh),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayHumh),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td>'.$arrayVariables[7].'</td>
                        <td>'.number_format(meanOfVariable($arrayEto),2,'.','').'</td>
                        <td>'.number_format(stDev($arrayEto),2,'.','').'</td>
                    </tr>
                    </tbody>
                </table>
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

    // Functions
    // Mean of Variable
    function meanOfVariable($a){
        $tempCount = count($a);
        $tempSum = 0;
        $tempMean = 0;
        foreach ($a as $value) {
            $tempSum = $tempSum + $value;
        }
        $tempMean = $tempSum / $tempCount;
        return $tempMean;
    }
    // StDev
    function stDev($arr)
    {
        // Calculates the standard deviation for all non-zero items in an array
        $n = count($arr);   // Counts non-zero elements in the array.
        $avg = array_sum($arr) / $n;     // Calculates the arithmetic mean.
        $sum = 0;        
        foreach( $arr as $a )
        {
            $sum = $sum + pow( $a - $avg , 2 );
        }
        $stdev = sqrt($sum/$n);
        return $stdev;
    }
    // Logo Temperatura
    function logoTemperatura($t){
        switch ($t) {
                case ($t < 0):
                    $logoTemp = 'temp_0.png';
                    break;
                case ($t >= 1 && $t <= 10):
                    $logoTemp = 'temp_1.png';
                    break;
                case ($t >= 11 && $t <= 20):
                    $logoTemp = 'temp_2.png';
                    break;
                case ($t >= 21 && $t <= 34):
                    $logoTemp = 'temp_3.png';
                    break;
                case ($t >= 35):
                    $logoTemp = 'temp_4.png';
                    break;
                default:
                    $logoTemp = '';
                    break;
            }
        return $logoTemp;    
    }

    function logoDV($dv){
        switch ($dv) {
                case ($dv >= 0 && $dv <= 44):
                    $logoDv = 'dv_n.png';
                    break;
                case ($dv >= 45 && $dv <= 89):
                    $logoDv = 'dv_ne.png';
                    break;
                case ($dv >= 90 && $dv <= 134):
                    $logoDv = 'dv_e.png';
                    break;
                case ($dv >= 135 && $dv <= 179):
                    $logoDv = 'dv_se.png';
                    break;
                case ($dv >= 180 && $dv <= 224):
                    $logoDv = 'dv_s.png';
                    break;
                case ($dv >= 225 && $dv <= 269):
                    $logoDv = 'dv_so.png';
                    break;
                case ($dv >= 270 && $dv <= 314):
                    $logoDv = 'dv_o.png';
                    break;
                case ($dv >= 315 && $dv <= 359):
                    $logoDv = 'dv_no.png';
                    break;
                case ($dv == 360):
                    $logoDv = 'dv_n.png';
                    break;
                default:
                    $logoDv = '';
                    break;
            }
        return $logoDv;   
    }

    function logoVV($vv){
        switch ($vv) {
                case ($vv == 0):
                    $logoVv = 'wind_0.png';
                    break;
                case ($vv > 0 && $vv < 2):
                    $logoVv = 'wind_0.png';
                    break;
                case ($vv >= 2 && $vv < 10):
                    $logoVv = 'wind_1.png';
                    break;
                case ($vv >= 10 && $vv < 20):
                    $logoVv = 'wind_2.png';
                    break;
                case ($vv >= 20 && $vv < 29):
                    $logoVv = 'wind_3.png';
                    break;
                case ($vv >= 29 && $vv < 38):
                    $logoVv = 'wind_4.png';
                    break;
                case ($vv >= 38 && $vv < 47):
                    $logoVv = 'wind_5.png';
                    break;
                case ($vv >= 47 && $vv < 57):
                    $logoVv = 'wind_6.png';
                    break;
                case ($vv >= 57 && $vv < 66):
                    $logoVv = 'wind_7.png';
                    break;
                case ($vv >= 66 && $vv < 75):
                    $logoVv = 'wind_8.png';
                    break;
                case ($vv >= 75 && $vv < 84):
                    $logoVv = 'wind_9.png';
                    break;
                case ($vv >= 84 && $vv < 94):
                    $logoVv = 'wind_10.png';
                    break;
                case ($vv >= 94 && $vv < 103):
                    $logoVv = 'wind_11.png';
                    break;
                case ($vv >= 103 && $vv < 112):
                    $logoVv = 'wind_12.png';
                    break;
                case ($vv >= 112 && $vv < 121):
                    $logoVv = 'wind_13.png';
                    break;
                case ($vv >= 121 && $vv < 131):
                    $logoVv = 'wind_14.png';
                    break;
                case ($vv >= 131 && $vv < 140):
                    $logoVv = 'wind_15.png';
                    break;
                case ($vv >= 140 && $vv < 150):
                    $logoVv = 'wind_16.png';
                    break;
                case ($vv >= 150 && $vv < 158):
                    $logoVv = 'wind_17.png';
                    break;
                case ($vv >= 158 && $vv < 168):
                    $logoVv = 'wind_18.png';
                    break; 
                case ($vv >= 168 && $vv < 177):
                    $logoVv = 'wind_19.png';
                    break; 
                case ($vv >= 177 && $vv < 186):
                    $logoVv = 'wind_20.png';
                    break; 
                case ($vv >= 186 && $vv < 195):
                    $logoVv = 'wind_21.png';
                    break; 
                case ($vv >= 195 && $vv < 205):
                    $logoVv = 'wind_22.png';
                    break; 
                case ($vv >= 205 && $vv < 214):
                    $logoVv = 'wind_23.png';
                    break;  
                case ($vv >= 214 && $vv < 223):
                    $logoVv = 'wind_24.png';
                    break;  
                case ($vv >= 223 && $vv <= 231):
                    $logoVv = 'wind_25.png';
                    break;     
                default:
                    $logoVv = '';
                    break;
            }
        return $logoVv;   
    }
?>
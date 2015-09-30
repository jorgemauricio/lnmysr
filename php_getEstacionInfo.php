<?php
    include_once('php_dbinfo.php');
    
    // Declare variables
    $lastValueValitation = 0;
    // GET Variables
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $estacion = $_GET['estacion'];

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

    // Echo tabla de valores al momento de la consulta
    // Query Show Last Row Info
    $query  = "SELECT * FROM estado".$estado. " where numero=".$estacion." order by fecha desc limit 1";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)) {
            $lastValueValitation = 1;
            echo '<br>';
            echo '<p><b>Última Lectura: </b>';
            echo $row['fecha'];
            echo '</p>';
            echo '</div>';
            echo '</div>';
            echo '<br>';
            echo '<div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Variables</th>
                                    <th>Valor</th>
                                    <th>Estado Actual</th>
                                    <th>Gráfica</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr>
                                        <td>Temperatura</td>
                                        <td>'.$row['temt'].'</td>
                                        <td><img class="img-responsive" style="width:25px;height:50px" src="/lnmysr/images/icons/'.logoTemperatura($row['temt']).'" alt="'.logoTemperatura($row['temt']).'"></td>
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>Pp</td>
                                        <td>'.$row['prec'].'</td>
                                        <td>'.'</td>
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>HR</td>
                                        <td>'.$row['humr'].'</td>
                                        <td>'.'</td> 
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>Pr</td>
                                        <td>'.$row['humh'].'</td>
                                        <td>'.'</td>
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>Rad. G</td>
                                        <td>'.$row['radg'].'</td>
                                        <td>'.'</td>
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>VV</td>
                                        <td>'.$row['velv'].'</td>
                                        <td>'.'</td>
                                        <td>'.'</td>
                                    </tr>
                                    <tr>
                                        <td>DV</td>
                                        <td>'.$row['dirv'].'</td>
                                        <td><img class="img-responsive" style="width:50px;height:50px" src="/lnmysr/images/icons/'.logoDV($row['dirv']).'" alt="'.logoDV($row['dirv']).'"></td>
                                        <td>'.'</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>';
                }
    }

    if ($lastValueValitation == 0) {
        echo '</div>';
        echo '</div>';
    }
    // Echo tabla de abreviaturas
    echo '<div class="container">
               <table class="table">
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
?>
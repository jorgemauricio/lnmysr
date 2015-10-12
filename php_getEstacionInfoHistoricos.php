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
    // Query
    $query = "select * from estado".$estado."diarios where numero =".$estacion." and extract(year from fecha1) =".$anio." and extract(month from fecha1) =".$mes." order by fecha1 asc";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        while ($row = mysql_fetch_array($result)){
                        echo '<tr>
                                <td>'.$row['fecha'].'</td>
                                <td>'.$row['prec'].'</td>
                                <td>'.$row['tmax'].'</td>
                                <td>'.$row['tmin'].'</td>
                                <td>'.$row['tmed'].'</td>
                                <td>'.$row['velvmax'].'</td>
                                <td>'.$row['velv'].'</td>
                                <td>'.$row['dirvvmax'].'</td>
                                <td>'.$row['dirv'].'</td>
                                <td>'.$row['radg'].'</td>
                                <td>'.$row['humr'].'</td>
                                <td>'.$row['et'].'</td>
                                <td>'.$row['ep'].'</td>
                            </tr>';   
        }
    }

    echo        '</tbody>
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
<?php
    include_once('php_dbinfo.php');
    
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
            echo '</div>';
            echo '</div>';
        }
        
        
        // Echo tabla de datos
        
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
?>
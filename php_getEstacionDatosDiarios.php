<?php
    include_once('php_dbinfo.php');
    
    // GET Variables
    $estado = $_GET['estado'];
    $estacion = $_GET['estacion'];

    // Query to know the Estado
    $query = "select nombre from estados where indice ='".$estado."'";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        echo '<div class="row">';
        echo '<div class="col-sm-6">';
        echo '<p><b>Estado: </b></p>';
        echo $row['nombre'];
        echo '</div>';
    }

    // Query to know the Municipio
    $query = "select municipioid from estaciones where numero ='".$estacion."'";
    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        $queryTemp = "select nombre from municipios where"
        echo '<div class="col-sm-6">';
        echo '<p><b>Estado: </b></p>';
        echo $row['nombre'];
        echo '</div>';
    }

    // Query to know the image
    $query  = "SELECT * FROM estaciones where estadoid ='".$estado."' AND  numero = '".$estacion."'";

    $result = mysql_query($query);
    if (!$result) {
      die('Invalid query: ' . mysql_error());
    }else{
        // Echo image
        echo '<div class="row">';
        echo '<div class="col-sm-6">';
        echo '</div>';
        echo '<div class="col-sm-6">';
        echo '<img src="/images/imagenesEstaciones/'.$row['numero'];
        echo '.jpg" class="img-responsive" alt="'$row['numero'];
        echo '" width="155" height="125">';
        echo '</div>';
        
        
        // Echo tabla de datos
        echo '<table class="table">
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Age</th>
        <th>Hometown</th>
        <th>Job</th>
        </tr>';
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Age'] . "</td>";
            echo "<td>" . $row['Hometown'] . "</td>";
            echo "<td>" . $row['Job'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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
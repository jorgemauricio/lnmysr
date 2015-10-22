<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>LNMySR</title>
    <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php include("includes/header.html");?>
<?php include_once('php_dbinfo.php');?>
    <h1 class="text-center">Reporte Históricos</h1>
    <br>
    <div class="container-fluid">
        <body>    
        <div class="container">     
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Estación</th>
                <th>Año</th>
                <th>Mes</th>
                <th>Información</th>
              </tr>
            </thead>
            <tbody>
                <?php
                            //select all records form tblmember table
                            $query = 'SELECT * FROM consultasWeb';
                            //execute the query using mysql_query
                            $result = mysql_query($query);
                            //then using while loop, it will display all the records inside the table
                            while ($row = mysql_fetch_array($result)) {
                                echo ' <tr> ';
                                echo ' <td> ';
                                echo $row['fecha'];
                                echo ' </td> ';
                                echo ' <td>';
                                echo $row['estado'];
                                echo ' </td>';
                                echo ' <td>';
                                echo $row['estacion'];
                                echo ' </td>';
                                echo ' <td>';
                                echo $row['anio'];
                                echo ' </td>';
                                echo ' <td>';
                                echo $row['mes'];
                                echo ' </td>';
                                echo '<td><a href="/LNMYSR/documentos/downloadHistoricos/';
                                echo $row['name'];
                                echo '.zip" class="btn btn-success" target="_blank" role="button">Ver</a>';
                                echo '</td>';
                            }   
 
                ?>
            </tbody>
          </table>
        </div>
    </div>
</body>
<?php include("includes/footer.html");?> 
</html>


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-38548366-1', 'auto');
    ga('send', 'pageview');
</script>
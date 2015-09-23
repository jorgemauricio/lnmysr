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

    <h1 class="text-center">Artículos Científicos</h1>
    <br>
    <div class="container-fluid">
        <body>    
        <div class="container">     
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Información</th>
              </tr>
            </thead>
            <tbody>
                <?php
                            //select all records form tblmember table
                            $query = 'SELECT * FROM articuloscientificos';
                            //execute the query using mysql_query
                            $result = mysql_query($query);
                            //then using while loop, it will display all the records inside the table
                            while ($row = mysql_fetch_array($result)) {
                                echo ' <tr> ';
                                echo ' <td> ';
                                echo $row['titulo'];
                                echo ' </td> ';
                                echo ' <td>';
                                echo $row['autor'];
                                echo ' </td>';
                                echo '<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal';
                                echo $row['ID'];
                                echo '">Ver</button></td>';
                            }   
 
                ?>
            </tbody>
          </table>
        </div>
    </body>
        
    </div>
</body>

<!-- Modals -->

<?php
                            //select all records form tblmember table
                            $query = 'SELECT * FROM articuloscientificos';
                            //execute the query using mysql_query
                            $result = mysql_query($query);
                            //then using while loop, it will display all the records inside the table
                            while ($row = mysql_fetch_array($result)) {
                                echo '<div class="modal fade" id="myModal';
                                echo $row['ID'];
                                echo '" role="dialog">
                                    <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">';
                                echo $row['poptitulo'];
                                echo '</h4>
                                    </div>
                                    <div class="modal-body">
                                    <p align ="justify">';
                                echo $row['abstract'];
                                echo '</p>
                                    </div>
                                    <div class="modal-footer">
                                    <a href="';
                                echo '/lnmysr/documentos/articulos_cientificos/';
                                echo $row['linkpdf'];
                                echo '" class="btn btn-success" target="_blank" role="button">PDF</a>
                                        </div>
                                        </div>
                                       </div>
                                    </div>';
                            }   
 ?>
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
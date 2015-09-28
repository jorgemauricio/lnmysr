<?php
    require("php_dbinfo.php");

    // Declare Variables
    $arrayErrors = array();
    $errUsr = null;
    $errPwd = null;
    $errEmail = null;
    $errTel = null;
    $errName = null;
    $errProf = null;
    $errInst = null;

    // Check Submit form
    if(isset($_POST["submit"])){

        $estado = $_POST['estado'];
        $estacion = $_POST['estacion'];
          
        // Check if user has been entered
        if (!$usr) {
            $errUsr = 'Introduce un nombre de usuario';
            $arrayErrors[] = $errUsr;
        }else{
            // Select all the rows in the markers table
            $query  = "SELECT * FROM estaciones where estadoid ='".$estado."' AND  numero = '".$estacion."'";
            $result = mysql_query($query);
            $arrayTemp = array();
            while ($row = @mysql_fetch_array($result)) {
                $arrayTemp[] = $row;                
                }
            if (count($arrayTemp) > 0) {
                $errUsr = 'Usuario duplicado';
                $arrayErrors[] = $errUsr;
                unset($arrayTemp);
            }
        }

        // Check if there is a name
        if (!$usr_name) {
            $errName = 'Introduce un nombre valido';
            $arrayErrors[] = $errName;
        }

        // Check if there is a profession
        if (!$profesion) {
            $errProf = 'Introduce una profesión valida';
            $arrayErrors[] = $errProf;
        }

        // Check institution
        if (!$institucion) {
            $errInst = 'Introduce un nombre valido';
            $arrayErrors[] = $errInst;
        }
        
        // Check if password is the same
        if($pwd != $pwd_check){
            $errPwd = 'La contraseña es diferente';
            $arrayErrors[] = $errPwd;
        }

        // Check if email is correct
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errEmail = "Formato de email invalido"; 
        }

        // Check if telephone is correct
        if (!preg_match('/^[0-9]*$/', $telefono)) {
            $errTel = "Teléfono invalido";
        }

        // If there are no errors save in the DB
        if (count($arrayErrors) > 0) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error en el registro</strong></div>';
        }else{
            $query = "INSERT INTO usuarios (user, password, name, profesion, institucion, estado, email, telefono, informacion) VALUES ('".$usr."','".$pwd."','".$usr_name."','".$profesion."','".$institucion."','".$estado."','".$email."',".$telefono.",'".$informacion."')";
            $result = mysql_query($query);
            if (!$result) {
                    die('Invalid query: ' . mysql_error());
            }else{
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Registro Satisfactorio</strong></div>';
                unset($arrayErrors);
            }      
        }
    }
?>
<!DOCTYPE html >
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>LNMySR</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN6x78FkL2djj8DEoG4OSAQBD-57wmcBw"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    // Declare variables
    var map;
    var estado;
    var estacion;
    var urlRequestEstaciones;
    var urlRequestMunicipios;
    var markers = [];
    var xml;
    var statusMarkers = 0;
    var minLat;
    var latMunicipio;
    var lngMunicipio;
    var maxLng;
    var infoWindow = new google.maps.InfoWindow;

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    function selectEstado(str){
        console.log("valor de estado: ");
        console.log(str);
        estado = str;
        urlRequestMunicipios = "php_getEstacionesDatosDiarios.php?estado=" + estado;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Municipio").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", urlRequestMunicipios, true);
        xmlhttp.send();
    }
    //]]>

  </script>
  </head>
    <?php include("includes/header.html");?>
    <h1 class="text-center">Red Nacional de Estaciones Agrometeorológicas Automatizadas INIFAP</h1>
    <br>
    <div class="container-fluid">
        <body>
            <div class="container">
                <form class="form-horizontal" role="form" action="datosDiarios.php" method="post">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" onchange="selectEstado(this.value)" class="form-control" name="estado">
                                <?php include_once('php_getEstados.php');?>
                            </select> 
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Municipio">Municipio</label>
                                <select class="form-control" id="Municipio" name="Municipio">
                                </select> 
                            </div>
                        </div>     
                    </div>
                    <div class="form-group">        
                        <input name="submit" type="submit" value="Información" class="btn btn-success"></input>
                    </div>
                </form>
                <div class="container">
                    <?php
                            //select all records form tblmember table
                            $query  = "SELECT * FROM estaciones where estadoid ='".$estado."' AND  numero = '".$estacion."'";
                            //execute the query using mysql_query
                            $result = mysql_query($query);
                            //then using while loop, it will display all the records inside the table
                            while ($row = mysql_fetch_array($result)) {
                                echo ' <tr> ';
                                echo ' <td> ';
                                echo $row['numero'];
                                echo ' </td> ';
                                echo ' <td> ';
                                echo $row['nombre'];
                                echo ' </td> ';
                                echo ' <td> ';
                                echo $row['titulo'];
                                echo ' </td> ';
                                echo ' <td> ';
                                echo $row['titulo'];
                                echo ' </td> ';
                                echo ' <td>';
                                echo $row['autor'];
                                echo ' </td>';
                                echo '<td><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal';
                                echo $row['id'];
                                echo '">Ver</button></td>';
                            }   
 
                ?>
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
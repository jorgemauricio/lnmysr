<!DOCTYPE html >
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title><?php session_start();?>LNMySR</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN6x78FkL2djj8DEoG4OSAQBD-57wmcBw"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
    // Declare variables
    var estado;
    var estacion;
    var anio;
    var mes;
    var municipio;
    var urlRequestEstaciones;
    var urlRequestMunicipios;

    function selectEstacion(str){
        estado = str;
        console.log(estado);
        urlRequestEstaciones = "php_getEstacionesHistoricos.php?estado=" + estado;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("estacion").innerHTML = xmlhttp.responseText;
                document.getElementById("anio").innerHTML = "";
                document.getElementById("mes").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectAnio(str){
        estacion = str;
        console.log(estacion);
        urlRequestEstaciones = "php_getAnioHistoricos.php?estado=" + estado + "&estacion=" + estacion;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("anio").innerHTML = xmlhttp.responseText;
                document.getElementById("mes").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectMonth(str){
        anio = str;
        console.log(anio);
        urlRequestEstaciones = "php_getMesHistoricos.php?estado=" + estado + "&estacion=" + estacion + "&anio=" + anio;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mes").innerHTML = xmlhttp.responseText;
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function displayInfo(str){
        mes = str;
        urlRequestEstaciones = "php_getEstacionInfoHistoricos.php?estado=" + estado + "&estacion=" + estacion + "&anio=" + anio + "&mes=" + mes;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("answerInfo").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }
    //]]>

  </script>
  </head>
    <?php include("includes/header.html");?>
    <!-- Validación Acceso -->
    <!--
    <?php
        if(!isset($_SESSION['userLogged'])){
            echo '<div class="container-fluid"> 
                    <div class="alert alert-danger">
                        <strong>Acceso Restringido: </strong>Inicia sesión en el sistema para acceder a esta página.
                    </div>
                    <div class="container">   
                        <a href="login.php" class="btn btn-success" role="button">Acceder al sistema</a>
                    </div>
                </div>';
        }else{
                echo '<div class="container-fluid">
        <h1 class="text-center">Red Nacional de Estaciones Agrometeorológicas Automatizadas INIFAP</h1>
        <br>
        <body>
            <div class="container">
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" onchange="selectEstacion(this.value)" class="form-control" name="estado">
                                <?php include_once("php_getEstados.php");?>
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="estacion">Estación:</label>
                            <select onchange="selectAnio(this.value)" class="form-control" id="estacion" name="estacion">
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="anio">Año:</label>
                            <select onchange="selectMonth(this.value)" class="form-control" id="anio" name="anio">
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="mes">Mes:</label>
                            <select onchange="displayInfo(this.value)" class="form-control" id="mes" name="mes">
                            </select> 
                    </div>    
                </form>
                <br>
                <div id="answerInfo" class="container">
                </div>
        </body>';
        }
    ?> 
    
    -->
    <!-- Validación Acceso -->   
    <h1 class="text-center">Red Nacional de Estaciones Agrometeorológicas Automatizadas INIFAP</h1>       
    <div class="container-fluid">
        <body>
            <div class="container">
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" onchange="selectEstacion(this.value)" class="form-control" name="estado">
                                <?php include_once("php_getEstados.php");?>
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="estacion">Estación:</label>
                            <select onchange="selectAnio(this.value)" class="form-control" id="estacion" name="estacion">
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="anio">Año:</label>
                            <select onchange="selectMonth(this.value)" class="form-control" id="anio" name="anio">
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="mes">Mes:</label>
                            <select onchange="displayInfo(this.value)" class="form-control" id="mes" name="mes">
                            </select> 
                    </div>    
                </form>
                <br>
                <div id="p_bar" class="container">
                </div>
                <div id="answerInfo" class="container">
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
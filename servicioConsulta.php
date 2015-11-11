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
    var tipoConsulta;
    var estado;
    var municipio;
    var estacion;
    var anioInicio;
    var anioFin;
    var mesInicio;
    var mesFin; 
    var urlRequestEstaciones;
    var urlRequestMunicipios;

    function tipoDeConsulta(str){
        tipoConsulta = str;
        document.getElementById("estado").innerHTML = '<?php include_once("php_getEstados.php");?>';
        document.getElementById("municipio").innerHTML = "";
        document.getElementById("estacion").innerHTML = "";
        document.getElementById("anioInicio").innerHTML = "";
        document.getElementById("anioFin").innerHTML = "";
        document.getElementById("mesInicio").innerHTML = "";
        document.getElementById("mesFin").innerHTML = "";
        document.getElementById("answerInfo").innerHTML = "";
    }

    function selectMunicipio(str){
        estado = str;
        urlRequestEstaciones = "php_getMunicipios.php?estado=" + estado;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("municipio").innerHTML = xmlhttp.responseText;
                document.getElementById("estacion").innerHTML = "";
                document.getElementById("anioInicio").innerHTML = "";
                document.getElementById("anioFin").innerHTML = "";
                document.getElementById("mesInicio").innerHTML = "";
                document.getElementById("mesFin").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectEstacion(str){
        municipio = str;
        console.log(estado);
        urlRequestEstaciones = "php_getEstacionesServicioConsulta.php?municipio=" + municipio;
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
                document.getElementById("anioInicio").innerHTML = "";
                document.getElementById("anioFin").innerHTML = "";
                document.getElementById("mesInicio").innerHTML = "";
                document.getElementById("mesFin").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectAnioInicio(str){
        estacion = str;
        console.log(estacion);
        urlRequestEstaciones = "php_getAnioServicioConsultaInicio.php?estado=" + estado + "&estacion=" + estacion + "&tipo=" + tipoConsulta;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("anioInicio").innerHTML = xmlhttp.responseText;
                document.getElementById("mesInicio").innerHTML = "";
                document.getElementById("anioFin").innerHTML = "";
                document.getElementById("mesFin").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectMonthInicio(str){
        anioInicio = str;
        console.log(anioInicio);
        urlRequestEstaciones = "php_getMesServicioConsultaInicio.php?estado=" + estado + "&estacion=" + estacion + "&anioInicio=" + anioInicio + "&tipo=" + tipoConsulta;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mesInicio").innerHTML = xmlhttp.responseText;
                document.getElementById("anioFin").innerHTML = "";
                document.getElementById("mesFin").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectAnioFin(str){
        urlRequestEstaciones = "php_getAnioServicioConsultaFin.php?estado=" + estado + "&estacion=" + estacion + "&anioInicio=" + anioInicio + "&tipo=" + tipoConsulta;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("anioFin").innerHTML = xmlhttp.responseText;
                document.getElementById("mesFin").innerHTML = "";
                document.getElementById("answerInfo").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function selectMonthFin(str){
        anioFin = str;
        console.log(anioFin);
        urlRequestEstaciones = "php_getMesServicioConsultaFin.php?estado=" + estado + "&estacion=" + estacion + "&anioFin=" + anioFin + "&tipo=" + tipoConsulta;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("mesFin").innerHTML = xmlhttp.responseText;
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
                            <label for="consulta">Tipo de Consulta:</label>
                            <select id="consulta" onchange="tipoDeConsulta(this.value)" class="form-control" name="consulta">
                                <option value="0">Tipo de Consulta</option>
                                <option value="p_diario">Promedio Diario</option>
                                <option value="v_min">Cada 15 minutos</option>
                            </select> 
                    </div> 
                    <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" onchange="selectMunicipio(this.value)" class="form-control" name="estado">
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="municipio">Municipio:</label>
                            <select id="municipio" onchange="selectEstacion(this.value)" class="form-control" name="municipio">
                                
                            </select> 
                    </div>
                    <div class="form-group">
                            <label for="estacion">Estación:</label>
                            <select onchange="selectAnioInicio(this.value)" class="form-control" id="estacion" name="estacion">
                            </select> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="anioInicio">Año Inicio:</label>
                                <select onchange="selectMonthInicio(this.value)" class="form-control" id="anioInicio" name="anioInicio">
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="mesInicio">Mes Inicio:</label>
                                    <select onchange="selectAnioFin(this.value)" class="form-control" id="mesInicio" name="mesInicio">
                                    </select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="anioFin">Año Fin:</label>
                                    <select onchange="selectMonthFin(this.value)" class="form-control" id="anioFin" name="anioFin">
                                    </select> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                    <label for="mesFin">Mes Fin:</label>
                                    <select onchange="displayInfo(this.value)" class="form-control" id="mesFin" name="mesFin">
                                    </select> 
                            </div>
                        </div>
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
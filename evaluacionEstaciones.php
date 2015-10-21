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
    var municipio;
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

    function selectMunicipio(str){
        console.log("valor de estado: ");
        console.log(str);
        estado = str;
        urlRequestMunicipios = "php_getMunicipios.php?estado=" + estado;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Municipio").innerHTML = xmlhttp.responseText;
                document.getElementById("Estacion").innerHTML = "";
                document.getElementById("answerEstacion").innerHTML = "";
                document.getElementById("noResultados").innerHTML = "";
            }
        }
        xmlhttp.open("GET", urlRequestMunicipios, true);
        xmlhttp.send();
    }

    function selectEstacion(str){
        municipio = str;
        urlRequestEstaciones = "php_getEstacionesDatosDiarios.php?estado=" + estado + "&municipio=" + municipio;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Estacion").innerHTML = xmlhttp.responseText;
                document.getElementById("answerEstacion").innerHTML = "";
                document.getElementById("noResultados").innerHTML = "";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }

    function displayInfo(str){
        estacion = str;
        document.getElementById("noResultados").innerHTML = '<option value="0">Selecciona un horario</option><option value="4">1 hr</option><option value="8">2 hrs</option><option value="12">3 hrs</option><option value="16">4 hrs</option><option value="20">5 hrs</option><option value="24">6 hrs</option><option value="28">7 hrs</option><option value="32">8 hrs</option><option value="36">9 hrs</option><option value="40">10 hrs</option><option value="44">11 hrs</option><option value="48">12 hrs</option>';
        
    }

    function numberOfResultados(str){
        if (str == 0) {
            document.getElementById("answerEstacion").innerHTML = "";
        }else{
            urlRequestEstaciones = "evaluacionEstacionesInfo.php?estado=" + estado + "&municipio=" + municipio + "&estacion=" + estacion + "&noResultados=" + str;
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("answerEstacion").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET",urlRequestEstaciones,true);
            xmlhttp.send();
        }
        
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select id="estado" onchange="selectMunicipio(this.value)" class="form-control" name="estado">
                                <?php include_once('php_getEstados.php');?>
                            </select> 
                        </div>
                    </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="Municipio">Municipio:</label>
                                <select onchange="selectEstacion(this.value)" class="form-control" id="Municipio" name="Municipio">
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="Estacion">Estación:</label>
                                <select onchange="displayInfo(this.value)" class="form-control" id="Estacion" name="Estacion">
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="noResultados">No. Resultados:</label>
                                <select onchange="numberOfResultados(this.value)" class="form-control" id="noResultados" name="noResultados">
                                </select> 
                            </div>
                        </div>     
                    </div>
                </form>
                <br>
                <div id="answerEstacion" class="container">
                    
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
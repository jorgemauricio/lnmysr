<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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
    var nombre;
    var estado;
    var municipio;
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
    var customIcons = {
      1: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      0: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    // Load() Function
    function load() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(22.1, -102.283),
        zoom: 5,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.TERRAIN,
                google.maps.MapTypeId.SATELLITE,
            ]
        }
      });
    }

    // Refresh Map when the user select an Estado
    function refreshMapEstado() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(22.1, -102.283),
        zoom: 5,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.TERRAIN,
                google.maps.MapTypeId.SATELLITE,
            ]
        }
      });
    }

    // Refresh Map when the user select a Municipio
    function refreshMapMunicipio() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(22.1, -102.283),
        zoom: 5,
         mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.TERRAIN,
                google.maps.MapTypeId.SATELLITE,
            ]
        }
      });
    }

    // Start Resize Map
    google.maps.event.addDomListener(window,"resize",function(){
        var center = map.getCenter();
        google.maps.event.trigger(map,"resize");
        map.setCenter(center);
    });
    // End resize Map

    function bindInfoWindow(marker, map, infoWindow, html, numero) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
        document.getElementById("answerReturned").innerHTML = "";
      });
    }

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

    function determineMaxMin(temp_lat, temp_lng, temp_i){
        if (temp_i == 0) {
            latMunicipio = temp_lat;
            lngMunicipio = temp_lng;
        }else{
            if (temp_lat > latMunicipio) {
                latMunicipio = temp_lat;
                console.log(latMunicipio);
            };
            if (temp_lng < lngMunicipio) {
                lngMunicipio = temp_lng;
                console.log(lngMunicipio);
            };
        }
    }

    function selectMunicipio(str){
        console.log("valor de estado: ");
        console.log(str);
        estado = str;
        refreshMapEstado();
        urlRequestEstaciones = "php_getEstaciones.php?estado=" + estado;
        urlRequestMunicipios = "php_getMunicipios.php?estado=" + estado;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Municipio").innerHTML = xmlhttp.responseText;
                document.getElementById("answerReturned").innerHTML = "";
            }
        }
        xmlhttp.open("GET", urlRequestMunicipios, true);
        xmlhttp.send();
        
        downloadUrl(urlRequestEstaciones, function(data) {
            xml = data.responseXML;
            markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
                var nombre = markers[i].getAttribute("nombre");
                var numero = markers[i].getAttribute("numero");
                var municipio = markers[i].getAttribute("municipio");
                var activa = markers[i].getAttribute("activa");
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var lat = parseFloat(markers[i].getAttribute("lat"));
                var lng = parseFloat(markers[i].getAttribute("lng"))
                var html = "<b>" + nombre + "</b> <br>" + "<b>Latitud: </b>" + lat + "<br><b>Longitud: </b>" + lng + "<br>" + "<button id=\"vEstacion\" value=\"" + numero + "\" type=\"button\" onclick=\"displayInfo(this.value)\">Más Información</button>";
                var icon = customIcons[activa] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon: icon.icon
            });
            bindInfoWindow(marker, map, infoWindow, html, numero);
        }
      });
    }


    function selectEstacion(str){
        console.log("valor de municipio: ");
        console.log(str);
        municipio = str;
        refreshMapMunicipio();
        urlRequestEstaciones = "php_getEstacionesMunicipio.php?estado=" + estado + "&municipio=" + municipio;
        document.getElementById("answerReturned").innerHTML = "";
        downloadUrl(urlRequestEstaciones, function(data) {
            xml = data.responseXML;
            console.log("valor xml municipios");
            console.log(xml);
            markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
                var nombre = markers[i].getAttribute("nombre");
                var numero = markers[i].getAttribute("numero");
                var municipio = markers[i].getAttribute("municipio");
                var activa = markers[i].getAttribute("activa");
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var lat = parseFloat(markers[i].getAttribute("lat"));
                var lng = parseFloat(markers[i].getAttribute("lng"))
                var html = "<b>" + nombre + "</b> <br>" + "<b>Latitud: </b>" + lat + "<br><b>Longitud: </b>" + lng + "<br>" + "<button id=\"vEstacion\" value=\"" + numero + "\" type=\"button\" onclick=\"displayInfo(this.value)\">Más Información</button>";
                var icon = customIcons[activa] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon: icon.icon
            });
                console.log(marker);
            bindInfoWindow(marker, map, infoWindow, html, numero);
        }
      });
    }

    function displayInfo(str){
        estacion = str;
        urlRequestEstaciones = "php_getEstacionInfo.php?estado=" + estado + "&municipio=" + municipio + "&estacion=" + estacion;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("answerReturned").innerHTML = xmlhttp.responseText;
                document.getElementById("alertDisplay").innerHTML = "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Consulta con éxito</strong> Los datos de la estación se encuentran debajo del mapa.</div>";
            }
        }
        xmlhttp.open("GET",urlRequestEstaciones,true);
        xmlhttp.send();
    }
    //]]>

  </script>
  </head>
    <?php include("includes/header.html");?>
    <h1 class="text-center">Red Nacional de Estaciones Agrometeorológicas Automatizadas INIFAP</h1>
    <br>
    <div class="container-fluid">
        <body onload="load()">
            <div class="container">
                <form class="form-horizontal" role="form" action="php_getEstaciones.php" method="post">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" onchange="selectMunicipio(this.value)" class="form-control" name="estado">
                                <?php include_once('php_getEstados.php');?>
                            </select> 
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Municipio">Municipio</label>
                                <select onchange="selectEstacion(this.value)" class="form-control" id="Municipio" name="Municipio">
                                </select> 
                            </div>
                        </div>     
                    </div>
                </form>
                <div class="container">
                    <div id="alertDisplay"></div>
                </div>
                <div class="container">
                    <div id="map" style="height: 600px"></div>
                </div>
                <br>
                <div id="answerReturned" class="container">
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
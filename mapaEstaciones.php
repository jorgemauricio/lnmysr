<?php
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

    var map;
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
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(22.1, -102.283),
        zoom: 5,
        mapTypeId: 'roadmap'
      });
    var infoWindow = new google.maps.InfoWindow;

    // Start Resize Map
    google.maps.event.addDomListener(window,"resize",function(){
        var center = map.getCenter();
        google.maps.event.trigger(map,"resize");
        map.setCenter(center);
    });
    // End resize Map

    // Change this depending on the name of your PHP file
    downloadUrl("php_getEstaciones.php", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < markers.length; i++) {
        var nombre = markers[i].getAttribute("nombre");
        var numero = markers[i].getAttribute("numero");
        var activa = markers[i].getAttribute("activa");
        var point = new google.maps.LatLng(
            parseFloat(markers[i].getAttribute("lat")),
            parseFloat(markers[i].getAttribute("lng")));
        var lat = parseFloat(markers[i].getAttribute("lat"));
        var lng = parseFloat(markers[i].getAttribute("lng"))
        var html = "<b>" + nombre + "</b> <br>" + "<b>Latitud: </b>" + lat + "<br><b>Longitud: </b>" + lng;
        var icon = customIcons[activa] || {};
        var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
        });
        bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
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
                            <select onchange="selectEstado()" class="form-control" name="estado">
                                <?php include_once('php_getEstados.php');?>
                            </select> 
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Municipio">Municipio</label>
                                <select class="form-control" name="Municipio">
                                    <?php include_once('php_getMunicipios.php');?>
                                </select> 
                            </div>
                        </div>     
                    </div>
                </form>
            <div id="map" style="height: 600px"></div></div>
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
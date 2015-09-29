<?
    
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
  </head>
    <?php include("includes/header.html");?>
    <h1 class="text-center">Red Nacional de Estaciones Agrometeorológicas Automatizadas INIFAP</h1>
    <br>
    <div class="container-fluid">
        <body>
            <div class="container">
                <form class="form-horizontal" role="form" action="datosDiarios_Estacion.php" method="post">
                    <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" class="form-control" name="estado">
                                <?php include_once('php_getEstados.php');?>
                            </select> 
                    </div>
                    <div class="form-group">        
                        <input name="submit" type="submit" value="Información" class="btn btn-success"></input>
                    </div>
                </form>
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
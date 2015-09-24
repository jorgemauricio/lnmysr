<?php
	// Declare Variables
    //
   
    // Check Submit form
    if(isset($_POST["submit"])){

        $tipo = $_POST['tipo'];
          
        // Switch validation
        switch ($tipo) {
            case 'Artículo Científico':
                header ("Location: uploadArticulo.php");
                break;
            case 'Folleto Técnico':
                header ("Location: uploadFolleto.php");
                break;
            case 'Caso de Estudio':
                header ("Location: uploadCaso.php");
                break;
            case 'Nota':
                header ("Location: uploadNota.php");
                break;
            default:
                break;
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>LNMySR</title>
        <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <?php include("/includes/header.html");?>

    <body>
        <h1 class="text-center">Subir Archivo</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="selectUpload.php" method="post">
                        <div class="form-group">
                            <label for="usr">Seleccione el tipo de archivo a subir</label>
                            <select class="form-control" name="tipo">
                                <option>Artículo Científico</option>
                                <option>Folleto Técnico</option>
                                <option>Caso de Estudio</option>
                                <option>Nota</option>
                            </select>
                        </div>
                        <div class="form-group">        
                            <input name="submit" type="submit" value="Seleccionar" class="btn btn-success"></input>
                        </div> 
                    </form>
                </div>
            </div> 
            </div> 
        </div>
    </body>
    <?php include("/includes/footer.html");?>
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
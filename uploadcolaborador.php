<?php
    require("php_dbinfo.php");

    // Declare Variables
    $arrayErrors = array();
    $errNombre = null;
    $errEstado = null;
    $errCampo = null;
    $errEmail = null;
    $nombre = null;
    $estado = null;
    $campo = null;
    $email = null;

    // Check Submit form
    if(isset($_POST["submit"])){

        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $campo = $_POST['campo'];
        $email = $_POST['email'];
        
          
        // Check Nombre
        if (!$nombre) {
            $errNombre = 'Introduce un nombre de usuario';
            $arrayErrors[] = $errNombre;
        }

        // Check Estado
        if (!$estado) {
            $errEstado = 'Introduce un Estado valido';
            $arrayErrors[] = $errEstado;
        }

        // Check campo
        if (!$campo) {
            $errCampo = 'Introduce un campo valido';
            $arrayErrors[] = $errCampo;
        }

        // Check email
        if (!$email) {
            $errEmail = 'Introduce un email valido';
            $arrayErrors[] = $errEmail;
        }

        // Check if email is correct
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errEmail = "Formato de email invalido"; 
        }


        // If there are no errors save in the DB
        if (count($arrayErrors) > 0) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error en el registro</strong></div>';
        }else{
            $query = "INSERT INTO directoriocol (nombre, estado, campo, email) VALUES ('".$nombre."','".$estado."','".$campo."','".$email."')";
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
        <h1 class="text-center">Subir Colaborador</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <form class="form-horizontal" role="form" action="uploadcolaborador.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                        <?php echo "<p class='text-danger'>$errNombre</p>";?>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado de origen:</label>
                        <select class="form-control" name="estado">
                            <option>Aguascalientes</option>
                            <option>Baja California</option>
                            <option>Baja California Sur</option>
                            <option>Campeche</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="campo">Campo:</label>
                        <input type="text" class="form-control" name="campo"> 
                        <?php echo "<p class='text-danger'>$errCampo</p>";?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email">
                        <?php echo "<p class='text-danger'>$errEmail</p>";?>
                    </div>
                    <div class="form-group">        
                        <input name="submit" type="submit" value="Registrar" class="btn btn-success"></input>
                    </div>
                </form>
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
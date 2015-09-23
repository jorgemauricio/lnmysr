<?php
    require("php_dbinfo.php");

    // Declare Variables
    $arrayErrors = array();
    $errUsr = null;
    $errPwd = null;
   
    // Check Submit form
    if(isset($_POST["submit"])){

        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
          
        // Check if user has been entered
        if (!$usr) {
            $errUsr = 'Introduce un nombre de usuario';
            $arrayErrors[] = $errUsr;
        }else{
            
            // Select all the rows in the markers table
            $query = "SELECT user FROM usuarios WHERE user ='" .$usr. "' AND password ='".$pwd."'";
            $result = mysql_query($query);
            $arrayTemp = array();
            while ($row = @mysql_fetch_array($result)) {
                $arrayTemp[] = $row;                
                }
            // Validate user and pwd
            if (count($arrayTemp) > 0) {
                // Start session 
                $_SESSION['id'] = session_id();
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Bienvenido</strong> Te damos la bienvenida.</div>';
            }else{
            	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            	<strong>Error: </strong>Favor de checar sus datos</div>';
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
        <h1 class="text-center">Inicio de sesión</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="login.php" method="post">
                        <div class="form-group">
                            <label for="usr">Nombre de usuario:</label>
                            <input type="text" class="form-control" name="usr">
                            <?php echo "<p class='text-danger'>$errUsr</p>";?>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Contraseña:</label>
                            <input type="password" class="form-control" name="pwd" placeholder="Contraseña">
                            <?php echo "<p class='text-danger'>$errPwd</p>";?>  
                        </div> 
                        <div class="form-group">        
                            <input name="submit" type="submit" value="Acceder" class="btn btn-success"></input>
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
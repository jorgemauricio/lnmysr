<?php
    require("php_dbinfo.php");

    // var_dump($_POST);
    if(isset($_POST["submit"])){

        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
        $pwd_check = $_POST['pwd_check'];
        $usr_name = $_POST['usr_name'];
        $profesion = $_POST['profesion'];
        $institucion = $_POST['institucion'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $informacion = $_POST['informacion'];
        $arrayErrors = array();
         
        // Check if all the fields have information
        
        if (strlen($usr) > 0) && (strlen($pwd) > 0) && (strlen($pwd_check) > 0) && (strlen($usr_name) > 0) && (strlen($profesion) > 0) && (strlen($institucion) > 0) && (strlen($estado) > 0) && (strlen($email) > 0) && (strlen($telefono) > 0) && (strlen($informacion) > 0){
            
            // Check if name has been entered
            if (!$usr) {
                $errUsr = 'Introduce un nombre de usuario';
                $arrayErrors[] = $errUsr;
            }else{
                // Select all the rows in the markers table
                $query = "SELECT user FROM usuarios WHERE user ='".$usr."'";
                $result = mysql_query($query);
                if ($result) {
                    $usrErrorDuplicado = 'usuario duplicado';
                    $arrayErrors[] = $usrErrorDuplicado;
                }
            }
            
            // Check if password is the same
            if($pwd != $pwd_check){
                $errPwd = 'La contraseña es diferente';
                $arrayErrors[] = $errPwd;
            }
                      
            // If there are no errors, send the email
            if (count($arrayErrors) > 0) {
                echo 'error ';
                print_r($arrayErrors);
            }else{
                $query = "INSERT INTO usuarios (user, password, name, profesion, institucion, estado, email, telefono, informacion) VALUES ('".$usr."','".$pwd."','".$usr_name."','".$profesion."','".$institucion."','".$estado."','".$email."',".$telefono.",'".$informacion."')";
                $result = mysql_query($query);
                if (!$result) {
                        die('Invalid query: ' . mysql_error());
                }else{
                    header('Location: /lnmysr/registro.php');
                }      
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
    <h1 class="text-center">Registro</h1>
    <br>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
            <div class="col-sm-6">
                <form class="form-horizontal" role="form" action="registroUsuario.php" method="post">
                    <div class="form-group">
                        <label for="usr">Nombre de usuario:</label>
                        <input type="text" class="form-control" name="usr">
                        <?php echo $errUsr;?>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Contraseña:</label>
                        <input type="password" class="form-control" name="pwd" placeholder="Contraseña">  
                    </div>
                    <div class="form-group">
                        <label for="pwd_check">Confirmar Contraseña:</label>  
                        <input type="password" class="form-control" name="pwd_check" placeholder="Confirma tu contraseña">
                    </div>
                    <div class="form-group">
                        <label for="usr_name">Nombre completo:</label>
                        <input type="text" class="form-control" name="usr_name"> 
                    </div>
                    <div class="form-group">
                        <label for="profesion">Profesión:</label>
                        <input type="text" class="form-control" name="profesion"> 
                    </div>
                    <div class="form-group">
                        <label for="institucion">Institución, organización ó productor:</label>
                        <input type="text" class="form-control" name="institucion"> 
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
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono"> 
                    </div>
                    <div class="form-group">
                        <label for="informacion">Uso de información:</label>
                        <select class="form-control" name="informacion">
                            <option>Investigación</option>
                            <option>Toma de decisiones</option>
                            <option>Asesoría</option>
                        </select>
                    </div>
                    <div class="form-group">        
                        <input name="submit" type="submit" value="Registrar" class="btn btn-success"></input>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <p align="justify"><b>AVISO DE PRIVACIDAD</b><br>
                    Los datos personales que en su caso nos proporcione serán protegidos conforme a lo dispuesto por la Ley Federal de Transparencia y Acceso a la Información Pública Gubernamental, su Reglamento, los Lineamientos de Protección de Datos Personales, publicados en el D.O.F., el 30 de septiembre de 2005.
                </p>    
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
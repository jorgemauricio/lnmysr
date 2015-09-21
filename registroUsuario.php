<?php
    require("php_dbinfo.php");

    if (isset($_POST["submit"])) {
            
        // Opens a connection to a MySQL server
        $connection=mysql_connect ('localhost', $username, $password);
        if (!$connection) {
          die('Not connected : ' . mysql_error());
        }

        // Set the active MySQL database
        $db_selected = mysql_select_db($database, $connection);
        if (!$db_selected) {
          die ('Can\'t use db : ' . mysql_error());
        }

        $usr = $_POST['usr'];
        $pwd = $POST['pwd'];
        $pwd_check = $POST['pwd_check'];
        $usr_name = $_POST['usr_name'];
        $profesion = $_POST['profesion'];
        $institucion = $_POST['institucion'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $informacion = $_POST['informacion'];
        $arrayErrors = $array();
         
        // check if password is the same
        if($pwd == $pwd_check){
            // Check if name has been entered
            if (!$_POST['usr']) {
                $errUsr = 'Introduce un nombre de usuario';
                $arrayErrors += $errUsr;
            }else{
                // Select all the rows in the markers table
                $query = 'SELECT user FROM usuarios WHERE user ='.$usr;
                $result = mysql_query($query);
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }else{

                }
            }

            // Check if email has been entered and is valid
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errEmail = 'El correo electrónico es inválido';
            }
        }else{
            $errPwd = 'La contraseña es diferente';
            $arrayErrors += $errPwd;
        }            
        
     
    // If there are no errors, send the email
    if (count($arrayErrors) > 0) {
        echo 'error';
    }else{
        echo 'no errors';
    }
    }
?>
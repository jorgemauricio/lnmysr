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
         
        // Check if name has been entered
        if (!$_POST['usr']) {
            $errUsr = 'Introduce un nombre de usuario';
            $arrayErrors = $errUsr;
        }else{
            // Select all the rows in the markers table
            $query = "SELECT * FROM usuarios";
            $result = mysql_query($query);
            if (!$result) {
              die('Invalid query: ' . mysql_error());
            }else{
                
            }
        }

        // Check if passwords are the same
        if ($_POST['pwd'] != $_POST['pwd_check']){
            $errPwd = 'Tu contraseña es diferente';
            $arrayErrors = $errPwd;
        }
        
        // Check if email has been entered and is valid
        if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'El correo electrónico es inválido';
        }
        
     
    // If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail ($to, $subject, $body, $from)) {
            $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
        } else {
            $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
        }
    }
        }
?>
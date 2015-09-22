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
        // check if password is the same
        if($pwd == $pwd_check){
            
        }else{
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
?>
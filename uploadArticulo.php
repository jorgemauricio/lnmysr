<?php
    require("php_dbinfo.php");

    //Declare variables
    
    // Check if image file is a actual image or fake image
    
    if(isset($_POST["submit"])) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $poptitulo = $_POST['poptitulo'];
        $infotext = $_POST['infotext'];

        $target_dir = "/documentos/articulos_cientificos/";
        $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["archivo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "pdf") {
            echo "Lo lamentamos solo puedes subir archivos con extensión .pdf ";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["archivo"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
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
        <h1 class="text-center">Subir Archivo</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="uploadArticulo.php" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="titulo">Título: </label>
                            <input type="text" class="form-control" name="titulo">
                        </div>
                        <div class="form-group"> 
                            <label for="autor">Autor(s): </label>
                            <input type="text" class="form-control" name="autor">
                        </div>
                        <div class="form-group"> 
                            <label for="poptitulo">Tipo de Texto Informativo: </label>
                            <input type="text" class="form-control" name="poptitulo">
                        </div>
                        <div class="form-group"> 
                            <label for="infotext">Texto Informativo: </label>
                            <input type="text" class="form-control" name="infotext">
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo: </label>
                            <input type="file" class="form-control" name="archivo">
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
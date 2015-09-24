<?php
    require("php_dbinfo.php");

    //Declare variables
    $titulo = null;
    $autor = null;
    $isbn = null;
    $poptitulo = null;
    $infotext = null;
    $target_dir = null;
    $target_file = null;
    $link = null;
    $uploadOk = null;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $isbn = $_POST['isbn'];
        $poptitulo = $_POST['poptitulo'];
        $infotext = $_POST['infotext'];
        // Path to save the PDF
        $target_dir = "documentos/folletos_tecnicos/";
        // Complete path
        $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
        $link = basename($_FILES["archivo"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check Variables
        // Check Titulo
        if (!$titulo) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Título</div>';
            $uploadOk = 0;
        }
        // Check Autor
        if (!$autor) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Autor(es)</div>';
            $uploadOk = 0;
        }
        // Check ISBN
        if (!$isbn) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin ISBN</div>';
            $uploadOk = 0;
        }
        // Check Poptitulo
        if (!$poptitulo) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Título Informativo</div>';
            $uploadOk = 0;
        }
        // Check Infotext
        if (!$infotext) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Información Complementaria</div>';
            $uploadOk = 0;
        }

        // Check Archive
        // Check if file already exists
        if (file_exists($target_file)) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> El archivo ya existe</div>';
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "pdf") {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Solo puedes subir archivos con extensión .pdf</div>';
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> El archivo no fue subido al sistema.</div>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO folleto (titulo, autor, isbn, poptitulo, infotext, link) VALUES ('".$titulo."','".$autor."','".$isbn."','".$poptitulo."','".$infotext."','".$link."')";
                $result = mysql_query($query);
                // Validate insert in the sql db
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }else{
                    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Archivo subido correctamente</strong></div>';
                }      
            } else {
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error al momento de subir el archivo, intenta de nuevo</strong></div>';
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="es">
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
        <h1 class="text-center">Subir Folleto Técnico</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="uploadFolleto.php" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="titulo">Título: </label>
                            <input type="text" class="form-control" name="titulo">
                        </div>
                        <div class="form-group"> 
                            <label for="autor">Autor(es): </label>
                            <input type="text" class="form-control" name="autor">
                        </div>
                        <div class="form-group"> 
                            <label for="isbn">ISBN: </label>
                            <input type="text" class="form-control" name="isbn">
                        </div>
                        <div class="form-group"> 
                            <label for="poptitulo">Tipo de Texto Informativo: </label>
                            <input type="text" class="form-control" name="poptitulo">
                        </div>
                        <div class="form-group"> 
                            <label for="infotext">Texto Informativo: </label>
                            <textarea type="text" class="form-control" name="infotext"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo: </label>
                            <input type="file" class="form-control" name="archivo">
                        </div>
                        <div class="form-group">        
                            <input name="submit" type="submit" value="Subir" class="btn btn-success"></input>
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
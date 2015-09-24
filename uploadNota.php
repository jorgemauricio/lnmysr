<?php
    require("php_dbinfo.php");

    //Declare variables
    $titulo = null;
    $portada = null;
    $linkimagen = null;
    $linkpdf = null;
    $target_dir_imagen = null;
    $target_file_imagen = null;
    $target_dir_pdf = null;
    $target_file_pdf = null;
    $uploadOk_image = null;
    $uploadOk_pdf = null;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $titulo = $_POST['titulo'];
        $portada =$_POST['portada'];
        
        // Path to save the PDF
        $target_dir_imagen = "documentos/notas/";
        $target_dir_pdf =  "documentos/notas/";
        // Complete path
        $target_file_imagen = $target_dir_imagen . basename($_FILES["archivoimagen"]["name"]);
        $target_file_pdf = $target_dir_imagen . basename($_FILES["archivopdf"]["name"]);
        $linkimagen = basename($_FILES["archivoimagen"]["name"]);
        $linkpdf = basename($_FILES["archivopdf"]["name"]);
        $uploadOk_image = 1;
        $uploadOk_pdf = 1;
        $FileType_image = pathinfo($target_file_imagen,PATHINFO_EXTENSION);
        $FileType_pdf = pathinfo($target_file_pdf,PATHINFO_EXTENSION);
        
        // Check for IMAGE //
        // Check if file already exists
        if (file_exists($target_file_imagen)) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> La imagen ya existe</div>';
            $uploadOk_image = 0;
        }
        
        // Allow certain file formats
        if($FileType_image != "png") {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Solo puedes subir imagenes con extensión .pdf</div>';
            $uploadOk_image = 0;
        }

        // Check for PDF //
        // Check if file already exists
        if (file_exists($target_file_pdf)) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> El archivo ya existe</div>';
            $uploadOk_pdf = 0;
        }
        
        // Allow certain file formats
        if($FileType_pdf != "pdf") {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Solo puedes subier archivos con extensión .pdf</div>';
            $uploadOk_pdf = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if (($uploadOk_image == 0) && ($uploadOk_pdf == 0)) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> La imagen y el PDF no fueron subidos al sistema.</div>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["archivoimagen"]["tmp_name"], $target_file_imagen) && move_uploaded_file($_FILES["archivopdf"]["tmp_name"], $target_file_pdf)) {
                $query = "INSERT INTO notasportada (titulo, linkpdf, linkimagen , portada) VALUES ('".$titulo."','".$linkpdf."','".$linkimagen."','".$portada."')";
                $result = mysql_query($query);
                // Validate insert in the sql db
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }else{
                    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Imagen y PDF almacenados correctamente</strong></div>';
                }      
            } else {
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error al momento de subir la imagen y el PDF, intenta de nuevo</strong></div>';
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
        <h1 class="text-center">Subir Nota</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="uploadNota.php" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="titulo">Título: </label>
                            <input type="text" class="form-control" name="titulo">
                        </div>
                        <div class="form-group"> 
                            <label for="portada">Portada: </label>
                            <select class="form-control" name="portada">
                            <option>NO</option>
                            <option>SI</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="archivoimagen">Archivo Imagen: </label>
                            <input type="file" class="form-control" name="archivoimagen">
                        </div>
                        <div class="form-group">
                            <label for="archivopdf">Archivo PDF: </label>
                            <input type="file" class="form-control" name="archivopdf">
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
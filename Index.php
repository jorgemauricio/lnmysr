<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>LNMySR</title>
    <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("includes/header.html");?>
    <?php
    include_once('php_dbinfo.php');
     
    $query  = "select * from notas order by no_imagen desc limit 7";
    $result = mysql_query($query);
    if(!$result){
        die('Invalid query: ' . mysql_error());
    }

    $count  =   mysql_num_rows($result);
    $slides='';
    $Indicators='';
    $counter=0;
     
        while($row= mysql_fetch_array($result))
        {
     
            $title = $row['titulo'];
            $image = $row['no_imagen'];
            $nomdoc = $row['nomdoc'];
            if($counter == 0)
            {
                $Indicators .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'" class="active"></li>';
                $slides .= '<div class="item active">
                <img src="/lnmysr/documentos/notas/'.$image.'.png" alt="'.$title.'" />
                <div class="carousel-caption">
                  <h3>'.$title.'</h3>
                  <p><a href="/lnmysr/documentos/notas/doc_'.$image.'_'.$nomdoc.'.pdf" target="_blank" >Ver nota</a></p>       
                </div>
              </div>';
     
            }
            else
            {
                $Indicators .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'"></li>';
                $slides .= '<div class="item">
                <img src="/lnmysr/documentos/notas/'.$image.'.png" alt="'.$title.'" />
                <div class="carousel-caption">
                  <h3>'.$title.'</h3>
                  <p><a href="/lnmysr/documentos/notas/doc_'.$image.'_'.$nomdoc.'.pdf" target="_blank" >Ver nota</a></p>       
                </div>
              </div>';
            }
            $counter++;
        }
     
    ?>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width:  80%;
            margin: auto;
        }
     </style>
        <h1 class="text-center">Bienvenido</h1>
        <br>
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-inteval="7000">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php echo $Indicators;?>
                </ol>

                <!-- Wrapper for slides -->

                <div class="carousel-inner">
                    <?php echo $slides;?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
<?php include("includes/footer.html");?>

</body>   
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
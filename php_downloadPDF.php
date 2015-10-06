<?php 
	include_once('fpdf17/fpdf.php');
    // PDF Class
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header(){
            // Logo
            $this->Image('fpdf17/header_4.png',10,8,33);
            // Arial bold 15
            $this->SetFont('Arial','B',12);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,10,'FORMATO PARA LA SOLICITUD DE INFORMACIÓN CLIMATOLÓGICA DEL INIFAP',1,0,'C');
            // Salto de línea
            $this->Ln(20);
        }
        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    for($i=1;$i<=40;$i++)
        $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
    //Determinar un nombre temporal de fichero en el directorio actual
	$file = basename(tempnam('.', 'tmp'));
	rename($file, $file.'.pdf');
	$file .= '.pdf';
	//Guardar el PDF en un fichero
	$pdf->Output($file, 'F');
	//Redirección
	header('Location: '.$file);
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
    <body>
    	<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>La solicitud de información se realizó satisfactoriamente.</strong>
        </div>'
    </body>
</html>
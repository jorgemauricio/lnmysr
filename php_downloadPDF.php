<?php
	include_once('php_dbinfo.php'); 
	include_once('fpdf17/fpdf.php');
    // Declare Variables
    $nombre = utf8_decode($_GET['nombre']);
    $apaterno = utf8_decode($_GET['apaterno']);
    $amaterno = utf8_decode($_GET['amaterno']);
    $sexo = utf8_decode($_GET['sexo']);
    $dateBirth = utf8_decode($_GET['dateBirth']);
    $pais = utf8_decode($_GET['pais']);
    $estado = utf8_decode($_GET['estado']);
    $municipio = utf8_decode($_GET['municipio']);
    $email = utf8_decode($_GET['email']);
    $escolaridad = utf8_decode($_GET['escolaridad']);
    $ocupacion = utf8_decode($_GET['ocupacion']);
    $empresa = utf8_decode($_GET['empresa']);
    $cargo = utf8_decode($_GET['cargo']);
    $usoInformacion = utf8_decode($_GET['usoInformacion']);
    $tipoInformacion = utf8_decode($_GET['tipoInformacion']);
    $nombreProyecto = utf8_decode($_GET['nombreProyecto']);
    $informacionSolicitada = utf8_decode($_GET['informacionSolicitada']);
    $noSolicitud = utf8_decode($_GET['noSolicitud']);
    // PDF Class
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header(){
            // Logo
            $this->Image('fpdf17/header_4.png',5,8,200);
            // Arial bold 12
            $this->SetFont('Arial','B',12);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,50,'FORMATO PARA LA SOLICITUD DE INFORMACIÓN CLIMATOLÓGICA DEL INIFAP',0,0,'C');
            // Salto de línea
            $this->Ln(30);
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
        function PrintAviso()
		{
		    $this->SetFont('Times','',12);
		    $this->Cell(80);
		    // Acuerdo
		    $this->Cell(30,10,'Está de acuerdo con las condiciones de uso de información de la Red de Estaciones Agroclimatológicas:',0,0,'C');
		    $this->Ln(10);
		    $this->Cell(80);
		    // SI
		    $this->Cell(30,10,'SI',1,0,'C');
		    $this->Ln(10);
		    $this->Cell(80);
		    $this->SetFont('Times','',6);
		    // Title Acuerdo para el solicitante
		    $this->Cell(30,10,'ACUERDO PARA EL SOLICITANTE',0,0,'C');
		    $this->Ln(10);
		    // Body Acuerdo para el solicitante
		    // Read text file
		    $txt = utf8_decode(file_get_contents('fpdf17/aviso.txt'));
		    // Times 12
		    $this->SetFont('Times','',6);
		    // Output justified text
		    $this->MultiCell(0,3,$txt);
		    // Line break
		    $this->Ln();
		}
    }
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cell(80);
    $pdf->Cell(30,20,'No. Solicitud: '.$noSolicitud,0,0,'C');
    $pdf->Ln(10);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'Datos del solicitante',0,0,'C');
	$pdf->Ln(15);
    $pdf->SetFont('Times','',10);
    $pdf->Cell(0,5,'Nombre(s): '.$nombre,0,1);
    $pdf->Cell(0,5,'Apellido Paterno: '.$apaterno,0,1);
    $pdf->Cell(0,5,'Apellido Materno: '.$amaterno,0,1);
    $pdf->Cell(0,5,'Sexo: '.$sexo,0,1);
    $pdf->Cell(0,5,'Fecha de Nacimiento: '.$dateBirth,0,1);
    $pdf->Cell(0,5,'País: '.$pais,0,1);
    $pdf->Cell(0,5,'Estado: '.$estado,0,1);
    $pdf->Cell(0,5,'Municipio: '.$municipio,0,1);
    $pdf->Cell(0,5,'Email: '.$email,0,1);
    $pdf->Cell(0,5,'Escolaridad: '.$escolaridad,0,1);
    $pdf->Cell(0,5,'Ocupación: '.$ocupacion,0,1);
    $pdf->Cell(0,5,'Institución o Empresa: '.$empresa,0,1);
    $pdf->Cell(0,5,'Cargo: '.$cargo,0,1);
    $pdf->Cell(0,5,'Uso de la información: '.$usoInformacion,0,1);
    $pdf->Cell(0,5,'Fines de uso: '.$tipoInformacion,0,1);
    $pdf->Cell(0,5,'Nombre del Proyecto: '.$nombreProyecto,0,1);
    $pdf->MultiCell(0,5,'Información que solicita: '.$informacionSolicitada,0,1);
    $pdf->Ln(10);
    $pdf->PrintAviso();
    // $pdf->Output('/lnmysr/documentos/solicitudes/'.$noSolicitud.'.pdf','I');
    //Determinar un nombre temporal de fichero en el directorio actual
	$file = '../lnmysr/documentos/solicitudes/'.$noSolicitud.'.pdf';
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
<?php 
	include_once('fpdf17/fpdf.php');
    // Declare Variables
    $nombre = $_GET['nombre'];
    $apaterno = $_GET['apaterno'];
    $amaterno = $_GET['amaterno'];
    $sexo = $_GET['sexo'];
    $dateBirth = $_GET['dateBirth'];
    $pais = $_GET['pais'];
    $estado = $_GET['estado'];
    $municipio = $_GET['municipio'];
    $email = $_GET['email'];
    $escolaridad = $_GET['escolaridad'];
    $ocupacion = $_GET['ocupacion'];
    $empresa = $_GET['empresa'];
    $cargo = $_GET['cargo'];
    $usoInformacion = $_GET['usoInformacion'];
    $tipoInformacion = $_GET['tipoInformacion'];
    $nombreProyecto = $_GET['nombreProyecto'];
    $informacionSolicitada = $_GET['informacionSolicitada'];
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
            // Num de solicitud
            $this->Cell(0,0, "Numero de solicitud:", 0, 0 , 'C');
            // Salto de línea
            $this->Ln(5);
            // Datos del solicitante
            $this->Cell(0,0, "Datos del solicitante", 0, 0 , 'C');
            // Salto de línea
            $this->Ln(5);
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
		    $this->Cell(30,20,'Está de acuerdo con las condiciones de uso de información de la Red de Estaciones Agroclimatológicas:',0,0,'C');
		    $this->Ln(10);
		    $this->Cell(80);
		    // SI
		    $this->Cell(30,20,'SI',0,0,'C');
		    $this->Ln(10);
		    $this->Cell(80);
		    // Title Acuerdo para el solicitante
		    $this->Cell(30,20,'ACUERDO PARA EL SOLICITANTE',0,0,'C');
		    $this->Ln(20);
		    // Body Acuerdo para el solicitante
		    // Read text file
		    $txt = file_get_contents('fpdf17/aviso.txt');
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
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0,10,'Nombre(s): '.$nombre,0,1);
    $pdf->Cell(0,10,'Apellido Paterno: '.$apaterno,0,1);
    $pdf->Cell(0,10,'Apellido Materno: '.$amaterno,0,1);
    $pdf->Cell(0,10,'Sexo: '.$sexo,0,1);
    $pdf->Cell(0,10,'Fecha de Nacimiento: '.$dateBirth,0,1);
    $pdf->Cell(0,10,'País: '.$pais,0,1);
    $pdf->Cell(0,10,'Estado: '.$estado,0,1);
    $pdf->Cell(0,10,'Municipio: '.$municipio,0,1);
    $pdf->Cell(0,10,'Email: '.$email,0,1);
    $pdf->Cell(0,10,'Escolaridad: '.$escolaridad,0,1);
    $pdf->Cell(0,10,'Ocupación: '.$ocupacion,0,1);
    $pdf->Cell(0,10,'Institución o Empresa: '.$empresa,0,1);
    $pdf->Cell(0,10,'Cargo: '.$cargo,0,1);
    $pdf->Cell(0,10,'Uso de la información: '.$usoInformacion,0,1);
    $pdf->Cell(0,10,'Fines de uso: '.$tipoInformacion,0,1);
    $pdf->Cell(0,10,'Nombre del Proyecto: '.$nombreProyecto,0,1);
    $pdf->MultiCell(0,10,'Información que solicita: '.$informacionSolicitada,0,1);
    $pdf->Ln(10);
    $pdf->PrintAviso();
    $pdf->Output();
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
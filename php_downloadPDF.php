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
    $fsolicitud = utf8_decode($_GET['fsolicitud']);
    $noSolicitud = utf8_decode($_GET['noSolicitud']);
    // PDF Class
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header(){
            if($this->PageNo()==1)
		    {
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
		    else
		    {
		        
		    }
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
    $pdf->Cell(30,20,'Fecha de Solicitud: '.$fsolicitud,0,0,'C');
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
    $pdf->SetFont('Times','',10);
    $pdf->Ln(20);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'_____________________________________________',0,0,'C');
    $pdf->Ln(10);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'Nombre y firma de quien recibe la información',0,0,'C');
    $pdf->Ln(20);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'Fecha: '.$fsolicitud,0,0,'C');
    $pdf->Ln(20);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'_____________________________________________',0,0,'C');
    $pdf->Ln(10);
    $pdf->Cell(80);
    $pdf->Cell(30,20,'Nombre y firma de quien entrega la información',0,0,'C');
    // $pdf->Output('/lnmysr/documentos/solicitudes/'.$noSolicitud.'.pdf','I');
    //Determinar un nombre temporal de fichero en el directorio actual
	$file = '../lnmysr/documentos/solicitudes/'.$noSolicitud.'.pdf';
	//Guardar el PDF en un fichero
	$pdf->Output($file, 'F');
	//Redirección
	header('Location: '.$file);
?>
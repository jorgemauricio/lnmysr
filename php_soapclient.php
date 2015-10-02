<?php 

// Get Variables
//$numero = $_GET['numero'];
//$estado = $_GET['estado'];
// Create the client object
$soapclient = new SoapClient('http://clima.inifap.gob.mx/data/webservice.asmx?WSDL');

//Use the functions of the client, the params of the function are in 
//the associative array
$params = array('latitud' => '22', 'longi' => '102');
$response = $soapclient->GPSEstaciones($params);

var_dump($response);

?>
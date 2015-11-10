<?php
/* Nombre del servidor. */
$serverName = "10.20.55.34";
/* Usuario y clave.  */
$uid = "intranet";
$pwd = "Newl@b0ratorio";
/* Array asociativo con la información de la conexion */
$connectionInfo = array( "UID"=>$uid,
"PWD"=>$pwd,
"Database"=>"BLOG");
 
/* Nos conectamos mediante la autenticación de SQL Server . */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
echo "No es posible conectarse al servidor.</br>";
die( print_r( sqlsrv_errors(), true));
}
 
/* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
$tsql = "SELECT CONVERT(varchar(32), SUSER_SNAME())";
$stmt = sqlsrv_query( $conn, $tsql);
if( $stmt === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
/* Mostramos el resultado. */
$row = sqlsrv_fetch_array($stmt);
echo "User login: ".$row[0]."</br>";
/* Cerramos la conexión, muy importante. */
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>
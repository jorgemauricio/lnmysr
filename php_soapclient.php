<?php
$serverName = "10.20.55.34\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"redclima", "UID"=>"intranet", "PWD"=>"Newl@b0ratorio");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
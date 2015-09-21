<?php
	include_once('php_dbinfo.php');
	 
	$image = mysql_real_escape_string($connection,$_POST['image']);
	$title = mysql_real_escape_string($connection,$_POST['title']);
	$desc = mysql_real_escape_string($connection,$_POST['desc']);
	 
	$query = "insert into notas (no_imagen, titulo, nomdoc) VALUES ('".$title."', '".$desc."', '".$image."')";
	mysql_query($query);
	header("location: index.php");
?>
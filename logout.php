<?php
	session_start();
	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 

	// Go to Index.php
	header("Location: Index.php");
?>
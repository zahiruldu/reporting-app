<?php 

session_start();

require_once ('functions.php');

authenticate();


	if (logout()) {

		

		header('location:login.php');
	}else{
		header('location:index.php');
	}


?>
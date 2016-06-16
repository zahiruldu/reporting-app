<?php

/////////////////////////
 // Database configuration for customer table //
 ////////////////////////
$host ="localhost";
$user ="root";
$pass ="root";
$dbname = "verizone";



// server configuration

$domain_name = "http://204.151.28.155";    // enter the domian name of your project, don't put any "/" at the end

$logo_url = "http://204.151.28.155/images/verizon-logo.png";   // enter the logo url of your project for email sending


////////////////////////////
// SMTP Configuration
////////////////////////////

$smtp_host="smtp.gmail.com";
$smtp_user="verizoncloudservice@gmail.com";
$smtp_pass="z1111111111";
$smtp_secure="tls";
$smtp_port="587";



/////////////////////////
 // Customer Database connection function //
 ////////////////////////

function dbconnect(){
	global $host, $user, $pass, $dbname;

	$conn = mysqli_connect($host,$user,$pass,$dbname);

	return $conn;
}




// getting domain function
function get_domain(){

	global $domain_name;

	$domain= $domain_name;

	return $domain;
}


//getting logo function
function get_logo(){

	global $logo_url;

	$logo = $logo_url;

	return $logo;
}

function get_smtp_host(){

	GLOBAL $smtp_host;
	return $smtp_host;
}

function get_smtp_user(){

	GLOBAL $smtp_user;
	return $smtp_user;
}

function get_smtp_pass(){

	GLOBAL $smtp_pass;
	return $smtp_pass;
}

function get_smtp_secure(){

	GLOBAL $smtp_secure;
	return $smtp_secure;
}

function get_smtp_port(){

	GLOBAL $smtp_port;
	return $smtp_port;
}


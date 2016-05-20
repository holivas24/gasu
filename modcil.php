<?php
require('config.php');
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location:index.php");
		die();
	}

	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$ciudad = "Chihuahua";
	$pais = "Mexico";	
	$tanque=prepare($_REQUEST['tanque']);
	$direccion=prepare($_REQUEST['direccion']);
	$capacidad=prepare($_REQUEST['capacidad']);
	$nombreTanque=prepare($_REQUEST['nombreTanque']);

	$dlocation = $direccion." ".$ciudad." ".$pais;

	$address = $dlocation; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
	
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "UPDATE cilindros SET direccion='$direccion', capacidad='$capacidad', 
	alias='$nombreTanque',latitud='$latitude', longitud='$longitude' WHERE id='$tanque'";
	$result = $conn->query($sql);
	$conn->close();
	?>
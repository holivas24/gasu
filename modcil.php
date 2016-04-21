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
	
	$tanque=prepare($_REQUEST['tanque']);
	$direccion=prepare($_REQUEST['direccion']);
	$capacidad=prepare($_REQUEST['capacidad']);
	$nombreTanque=prepare($_REQUEST['nombreTanque']);
	
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "UPDATE cilindros SET direccion='$direccion', capacidad='$capacidad', 
	alias='$nombreTanque' WHERE id='$tanque'";
	$result = $conn->query($sql);
	$conn->close();
	?>
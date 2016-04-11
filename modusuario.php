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
	$userid = $_SESSION['id'];
	$nombres=prepare($_REQUEST['nombres']);
	$apPaterno=prepare($_REQUEST['apPaterno']);
	$apMaterno=prepare($_REQUEST['apMaterno']);
	$email=prepare($_REQUEST['email']);


	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "UPDATE usuarios SET nombres='$nombres', apPaterno='$apPaterno', 
	apMaterno='$apMaterno',	email='$email' WHERE id='$userid'";
	$result = $conn->query($sql);
	$conn->close();
	?>
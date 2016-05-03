<?php
	session_start();
	if(!isset($_SESSION['username']) && $_SESSION['nivel'] !=2){
		header("Location:login.php");
		die();
	}
	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$idPedido = prepare($_REQUEST['pedidoId']);
	$operadorNew = prepare($_REQUEST['asOperador']);

	require('config.php');
	$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	$sql = "UPDATE pedidosTanque 
			SET operador=$operadorNew, estado=2 WHERE id=$idPedido";
	$result = $conn->query($sql);
	$conn->close();

	header("Location:index.php");

?>
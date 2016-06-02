<?php
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

	function nuevo()
	{	
		require('config.php');
		$clave=$_REQUEST['clave'];
		$cypher=md5($clave);
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$sql = "INSERT INTO modulos (id,clave,cypher)
		VALUES (0,'$clave','$cypher')";
		$result = $conn->query($sql);
		$conn->close();
		echo 'OK';
	}

	function asignar()
	{
		require('config.php');
		$idModulo=$_REQUEST['idModulo'];
		$idContenedor=$_REQUEST['idContenedor'];
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$sql = "UPDATE modulos SET contenedor='$idContenedor' WHERE id='$idModulo'";
		$result = $conn->query($sql);
		$conn->close();
		echo 'OK';
	}


	$opcion=$_REQUEST['opcion'];

	if($opcion=='nuevo')
		nuevo();
	elseif($opcion=='asignar')
		asignar();
?>
<?php
	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	if(isset($_REQUEST['username']))
	{
		$username = prepare($_REQUEST['username']);
		$contrasenia = prepare($_REQUEST['contrasenia']);
		$usuario = new stdClass();
		require('config.php');
		$connection = mysql_connect($host,$user,$passwd);
		$query = "SELECT * FROM usuarios where username='$username' and contrasenia='$contrasenia'";
		mysql_select_db($db,$connection) or die();
	    $result = mysql_query($query);
	    mysql_close();

	    $row  = mysql_fetch_array($result);
		if($row!=null)
		{
			$usuario->id = $row['id'];
			$usuario->username = $row['username'];
			$usuario->nombres = $row['nombres'];
			$usuario->apPaterno = $row['apPaterno'];
			$usuario->apMaterno = $row['apMaterno'];
			$usuario->nivel = $row['nivel'];

			print_r(json_encode($usuario));
 		} 

		else 
			$message = "Usuario o contraseña invalido";
	}
?>
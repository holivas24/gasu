<?php
	require('config.php');
	date_default_timezone_set('America/Chihuahua');
	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	function getaddress($lat,$lng)
	{
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
		$json = @file_get_contents($url);
		$data=json_decode($json);
		$status = $data->status;
		if($status=="OK")
		return $data->results[0]->formatted_address;
		else
		return false;
	}

	if(isset($_REQUEST['contenedor']) && isset($_REQUEST['porcentaje']))
	{
		$contenedor = prepare($_REQUEST['contenedor']);
		$porcentaje = prepare($_REQUEST['porcentaje']);
		$latitud = prepare($_REQUEST['latitud']);
		$longitud = prepare($_REQUEST['longitud']);
		$address= getaddress($latitud,$longitud);
		if($address)
		{
		$addarr = split(",",$address);
		$direccion = $addarr[0];
		//echo $direccion;
		}
		else
		{
		echo "No se encontró dirección";
		}


		$conn = new mysqli($host, $user, $passwd, $db);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
		$sql = "INSERT INTO registrosContenedores 
		(id,fecha,contenedor,porcentaje,latitud,longitud) 
		VALUES (0,now(),'$contenedor','$porcentaje','$latitud','$longitud')";

		$result = $conn->query($sql);
		$conn->close();

		$conn = new mysqli($host, $user, $passwd, $db);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
		$sql = "UPDATE contenedores
		SET direccion='$direccion', latitud = '$latitud', longitud = '$longitud', porcentaje='$porcentaje'
		WHERE id='$contenedor'";

		$result = $conn->query($sql);
		$conn->close();
		echo 'OK';	
	}	
?>
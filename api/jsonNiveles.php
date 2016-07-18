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
	header("Content-type: application/json");
	$idcontenedor = prepare($_REQUEST['contenedor']);
	if(isset($_REQUEST['fecha']))
		$fechaConsulta = date_create(prepare($_REQUEST['fecha']));
	else
		$fechaConsulta=date_create(date("Y-m-d"));

	$date=date_format($fechaConsulta,'Y-m-d');
	$hours = array();
	$porcentajes = array();
	$datos = array();
	$dato = new stdClass();	
	$fechain =$date." 00:00:01";
	$fechafin = $date." 23:59:59";

	// Create connection
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT convert(fecha,TIME) as hora, porcentaje, latitud,longitud
		FROM registrosContenedores 
		WHERE contenedor = '$idcontenedor'	 
		AND fecha BETWEEN '$fechain' AND '$fechafin'";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			$i=0;
		    // output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		    	$dato = new stdClass();

		        $hours[$i] = $row['hora'];
		        $porcentajes[$i] = $row['porcentaje']*100;
		        $dato->hora= $row['hora'];
		        $dato->porcentaje = $row['porcentaje']*100;
		        $dato->latitud = $row['latitud'];
		        $dato->longitud = $row['longitud'];
		        $dato->posiscion = $i+1;
		        $datos[$i]=$dato;
		        $i++;
		    }
		} 
		else 
		{
		  	$hours[0] = "00:00:00";
	        $porcentajes[0] = 0;
	        $dato->hora= "00:00:00";
	        $dato->porcentaje = 0;
	        $dato->latitud = 28.632996;
	        $dato->longitud = -106.069100;
	        $dato->posiscion = 0;
	        $datos[0]=$dato;  
		}
		$conn->close();
	
	$resultado = array($datos,$hours,$porcentajes);
	print_r(json_encode($resultado));


?>

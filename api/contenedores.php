<?php
		header("Content-type: application/json");
		$opcion = $_REQUEST['opcion'];
		$resultado = array();
		switch($opcion)
		{
			case 1:
				$tipo = 'Estacion';
				break;
			case 2:
				$tipo = 'Salchicha';
				break;
			case 3:
				$tipo = 'Pipa';
				break;
			default:
				$tipo = '*';
		}

		require('config.php');
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		if($tipo == '*')
			$sql = "SELECT * from contenedores";
		else
			$sql = "SELECT * from contenedores WHERE tipo LIKE '$tipo'";	
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			$i=0;
		    // output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		    	$object = new stdClass();
		    	$object->id = $row['id'];
		    	$object->tipo = $row['tipo'];
		    	$object->alias = $row['alias'];
		    	$object->direccion = $row['direccion'];
		    	$object->capacidad = $row['capacidad'];
		    	$object->latitud = $row['latitud'];
		    	$object->longitud = $row['longitud'];
		    	$object->porcentaje = $row['porcentaje'];

		    	$resultado[$i] = $object;
		    	$i++;

		    }
		} 
		else 
		{
		  	
		}
		$conn->close();

		print_r(json_encode($resultado));

?>
<?php
	
	require('config.php');
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	header("Content-type: application/json");

	$date=date_create(date("Y-m-d"));
	$dates = array();
	$datos = array();
	$hour = " 23:59:59";
	$userid = prepare($_REQUEST['userid']);
	date_add($date,date_interval_create_from_date_string("-8 days"));

	for($i=0;$i<7;$i++)
		$dates[$i] =date_format(date_add($date,date_interval_create_from_date_string("1 days")),"Y-m-d");
		
	for($i=0;$i<7;$i++)
	{
		//echo $dates[$i].$hour."<br>";
		$actual = $dates[$i].$hour;
		// Create connection
		$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM registros WHERE tanque = 
		(SELECT id FROM tanques WHERE usuario = '$userid') AND fecha <= '$actual'
	 	ORDER BY fecha DESC LIMIT 1";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $datos[$i] = $row['porcentaje'] * 100;
		        //echo $datos[$i]."<br>";
		    }
		} else {
		    $datos[$i] = 0.00;
		    //echo $datos[$i]."<br>";
		}
		$conn->close();
	}
	$resultado = array($dates,$datos);
	print_r(json_encode($resultado));

?>
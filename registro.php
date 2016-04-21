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

$tanque = prepare($_REQUEST['tanque']);
$porcentaje = prepare($_REQUEST['porcentaje']);

$conn = new mysqli($host, $user, $passwd, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
$sql = "INSERT INTO registros (id,fecha,tanque,porcentaje) VALUES (0,now(),'$tanque','$porcentaje')";

$result = $conn->query($sql);
$conn->close();
echo 'OK';
?>
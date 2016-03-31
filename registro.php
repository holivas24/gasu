<?php
require('config.php');

function prepare($data) 
{
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$tanque = prepare($_REQUEST['tanque']);
$porcentaje = prepare($_REQUEST['porcentaje']);

$connection = mysql_connect($host,$user,$passwd);
$query = "INSERT INTO registros (fecha,tanque,porcentaje) VALUES (now(),'$tanque','$porcentaje')";

$connection = mysql_connect($host,$user,$passwd);
mysql_select_db($db,$connection) or die();    
$result = mysql_query($query);
mysql_close();


?>
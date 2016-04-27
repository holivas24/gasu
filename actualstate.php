<?php
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
    require('config.php');
    date_default_timezone_set('America/Chihuahua');
    // Create connection
    $lastvalue = 0.0;
    $idtanque = prepare($_REQUEST['tanque']);
    $conn = new mysqli($host, $user, $passwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM registros where tanque = '$idtanque' 
            order by fecha desc LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            $lastvalue = $row['porcentaje'];
        }
    }

    else
    {
        $lastvalue = 0.0;
    }

    print_r(json_encode($lastvalue));
?>
<?php
	require('config.php');
	session_start();
	$message ="";
	if(isset($_SESSION["username"])){
		header("Location:index.php");
	}

	function prepare($data) 
	{
	  $data = trim($data);
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	if(isset($_POST['username']))
	{
		$username = prepare($_POST['username']);
		$contrasenia = prepare($_POST['contrasenia']);
		$connection = mysql_connect($host,$user,$passwd);
		$query = "SELECT * FROM usuarios where username='$username' and contrasenia='$contrasenia'";
		mysql_select_db($db,$connection) or die();
	    $result = mysql_query($query);
	    mysql_close();

	    $row  = mysql_fetch_array($result);
		if($row!=null)
		{
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['nombres'] = $row['nombres'];
			$_SESSION['apPaterno'] = $row['apPaterno'];
			$_SESSION['apMaterno'] = $row['apMaterno'];
			$_SESSION['nivel'] = $row['nivel'];
 		} 

		else $message = "Usuario o contraseña invalido";
		
		if(isset($_SESSION['id'])) {
		header("Location:index.php");
		}
	}
?>
<!Doctype html>
<html>
<head>
	<title>GasU | Iniciar Sesión</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Styles -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="bootstrap/css/signin.css">
	<link rel="stylesheet" href="media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="editable/css/bootstrap-editable.css">  

	<!-- Scripts-->
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	


</head>
<body>

    <div class="container">
      <div class="message" style="color:#FF0000"><?php if($message!="") { echo $message; } ?></div>
      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading"><center><h4>GasU</h4></center></h2>
        <label for="username" class="sr-only">Usuario</label>
        <input type="text" name="username" class="form-control" placeholder="Usuario" required autofocus>
        <label for="passwd" class="sr-only">Contraseña</label>
        <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> 
  </body>
</html>
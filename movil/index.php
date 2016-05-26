<!DOCTYPE HTML>
<?php
	require('config.php');
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
	date_default_timezone_set('America/Chihuahua');
	$date = date('d/m/Y');
    $hour = date('H:i');
?>
<html>
<head>
	<title>GasU</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Styles -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../pace/corner.css">
	

	<!-- Scripts-->
	<script src="../pace/pace.min.js"></script>
	<script src="../bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../routes/sync.js"></script>
    <script>
    	$(document).ready(function(){
    		<?php
    		if($_SESSION['nivel']==1)
    			echo 'send();';
    		?>
    	});
    </script>

</head>
<body>
<!--Navbar -->
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="#" OnClick="niveles()">GasU</a>
	</div>
		<div class="navbar-collapse collapse">
	   		<ul class="nav navbar-nav">
		        </li>
		        <li>
		            <a href="out.php">
		                Salir
		            </a>
		        </li>
		        <li style="float: right !important;">
		        	<a href="#"><?php echo $_SESSION['nombres']." ".$_SESSION['apPaterno']." ".$_SESSION['apMaterno'];?></a>
		        </li>
	        </ul>
        </div>      
    </div>
  </div>
<!--End Navbar -->
<div class="container-fluid">
	<div id="results" class="display row">
		<!--El contenido va aqui -->
	</div>
	
</div>
</body>
</html>
<style>
.title{
	text-align:center;
}

.nivel{
	min-width: 310px; 
	max-width: 400px; 
	height: 300px; 
	margin: 0 auto;
}

.mes{
	min-width: 310px; 
	height: 400px; 
	margin: 0 auto;
}

/*body {
    background-image: url('images/gasu_bn.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: auto;
}*/
</style>
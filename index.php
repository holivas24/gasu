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
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="editable/css/bootstrap-editable.css">  
	<link rel="stylesheet" href="pace/radar.css">
	<!-- Scripts-->
	<script src="pace/pace.min.js"></script>
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="routes/sync.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="editable/js/bootstrap-editable.min.js"></script>
	<script src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
	<!--Highcharts scripts -->
	<script src="highcharts/js/highcharts.js"></script>
    <script src="highcharts/js/highcharts-more.js"></script>
    <script src="highcharts/js/modules/exporting.js"></script>
    <script>
    	$(document).ready(function(){
    		<?php
    		if($_SESSION['nivel']==1)
    			echo 'info();';
    		else if($_SESSION['nivel']==2)
    			echo 'admin();';
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
    <?php
    if($_SESSION['nivel']>=2)
		echo '<a class="navbar-brand" href="#" OnClick="info()">GasU Admin</a>';
	else
		echo '<a class="navbar-brand" href="#" OnClick="info()"><img src="images/gasu.png" height="40" width="130" style="margin-top:0px;"></a>';
	?>
	</div>
		<div class="navbar-collapse collapse">
	   		<ul class="nav navbar-nav">
		        <li>
		            <a href="#" OnClick="info()">Inicio</a>
		        </li>

<?php 
		        if($_SESSION['nivel']>=2){
echo ' 
		    	<li>
		            <a href="#" onClick="nuevoUsuario()">Crear Usuario</a>
		        </li>
';
}
?>
				<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			            <li><a href="#" OnClick="configuracion()">Configuración</a></li>
			            <li><a href="#">Ayuda</a></li>
			        </ul>
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
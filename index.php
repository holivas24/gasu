<!DOCTYPE HTML>
<?php
	require('config.php');
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
?>
<html>
<head>
	<title>Inicio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Styles -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="editable/css/bootstrap-editable.css">  
	<!-- Scripts-->
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/myscript.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="editable/js/bootstrap-editable.min.js"></script>
	<!--Highcharts scripts -->
	<script src="highcharts/js/highcharts.js"></script>
    <script src="highcharts/js/highcharts-more.js"></script>
    <script src="highcharts/js/modules/exporting.js"></script>
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
		echo '<a class="navbar-brand" href="index.php">GasU Admin</a>';
	else
		echo '<a class="navbar-brand" href="index.php"><img src="images/gasu.png" height="50" width="120" style="margin-top:0px;"></a>';
	?>
	</div>
		<div class="navbar-collapse collapse">
	   		<ul class="nav navbar-nav">
		        <li>
		            <a href="index.php">Inicio</a>
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
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">One more separated link</a></li>
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
<div class="container">
	<div id="wrapper" class="center" style="margin:10px;">
<?php
//Pantalla Admin
if($_SESSION['nivel'] >=2)
echo '
			<div id="search" class="row">

				<h3>Buscar Usuario</h3>
				<form>
					<label>Nombre : </label><input type="text" id="nombre">
					<label>Apellido Paterno: </label><input type="text" id="apPaterno">
					<label>Apellido Materno: </label><input type="text" id="apMaterno">
					<button class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar</button>
				</form>
			</div>
		
		';
?>
	<div id="informacion" class="row">
		<div class="col-sm-4">
	      <h3 class="title">Nivel actual</h3>
	      <div id="nivel"></div>
	    </div>
	    <div class="col-sm-8">
	      <h3 class="title">Nivel mensual diario</h3>
	      <div id="consumomes"></div>
	    </div>
	</div>
	<div id="results" class="display"></div>
	</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
<?php
	// Create connection
	$userid = $_SESSION['id'];
	$conn = new mysqli($host, $user, $passwd, $db);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM registros where tanque = (SELECT id FROM tanques where usuario = '$userid') order by fecha desc LIMIT 1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo 'nivel(' . $row['porcentaje'] .');';
	    }
	} else {
	    echo 'nivel(0)';
	}
	$conn->close();
?>
		$.getJSON('dataweek.php?userid=<?php echo $_SESSION['id'];?>',
		function(data){
			consumo(data[0],data[1]);
		});
	});

function nivel(porcentaje) {

    $('#nivel').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Porcentaje <?php echo date("Y/m/d");?>'
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Porcentaje'
            },
            plotBands: [{
                from: 50,
                to: 100,
                color: '#55BF3B' // green
            }, {
                from: 20,
                to: 50,
                color: '#DDDF0D' // yellow
            }, {
                from: 10,
                to: 20,
                color: '#FF8000' // orange
            }, {
                from: 0,
                to: 10,
                color: '#DF5353' // red
            }]
        },
        credits: {
            enabled: false
        },

        series: [{
            name: 'Porcentaje',
            data: [80],
            tooltip: {
                valueSuffix: '%'
            }
        }]

    },
    // Add some life
    function (chart) {
       if (!chart.renderer.forExport) {
            
                var point = chart.series[0].points[0],
                    newVal,
                    inc = Math.floor(porcentaje * 100);

                newVal =inc;        

                point.update(newVal);
        }
    });
}

function consumo(fechas, datos) {
    $('#consumomes').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Porcentaje diario'
        },
        subtitle: {
            text: 'GasU'
        },
        xAxis: {
            categories: fechas
        },
        yAxis: {
            title: {
                text: 'Porcentaje (%)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Porcentaje',
            data: datos,
            color:'#55BF3B'
        }
        ]
    });
}
</script>
<style>
.title{
	text-align:center;
}

</style>